<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\PostsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Posts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\PostsImport;
use App\Models\Post;
use App\Models\Lawyer;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawyerPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.add_blog');
        $this->middleware('permission:lawyer.add_blog', ['only' => ['store']]);
        $this->middleware('permission:lawyer.add_blog', ['only' => ['update']]);
        $this->middleware('permission:lawyer.add_blog', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.add_blog', ['only' => ['export']]);
        $this->middleware('permission:lawyer.add_blog', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $lawyer)
    {
        if ($req != null) {
            $lawyer_posts =  $lawyer->lawyer_posts();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_posts =  $lawyer_posts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_posts =  $lawyer_posts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_posts = $lawyer_posts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_posts = $lawyer_posts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_posts = $lawyer_posts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_posts = $lawyer_posts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_posts = $lawyer_posts->get();
                return $lawyer_posts;
            }
            $lawyer_posts = $lawyer_posts->get();
            return $lawyer_posts;
        }
        $lawyer_posts = $lawyer->lawyer_posts()->withAll()->orderBy('id', 'desc')->get();
        return $lawyer_posts;
    }


    /*********View All Posts  ***********/
    public function index(Request $request, Lawyer $lawyer)
    {
        $lawyer_posts = $this->getter($request, null, $lawyer);
        return view('super_admins.lawyers.lawyer_posts.index', compact('lawyer_posts', 'lawyer'));
    }

    /*********View Create Form of Post  ***********/
    public function create(Lawyer $lawyer)
    {
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();

        return view('super_admins.lawyers.lawyer_posts.create', compact('blog_categories', 'lawyer', 'tags'));
    }

    /*********Store Post  ***********/
    public function store(CreateRequest $request, Lawyer $lawyer)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_posts');
            $lawyer_post = $lawyer->lawyer_posts()->create($data);
            $lawyer_post->slug = Str::slug($lawyer_post->name . ' ' . $lawyer_post->id, '-');
            $lawyer_post->save();
            $lawyer_post = $lawyer->lawyer_posts()->withAll()->find($lawyer_post->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_posts.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_posts.index', $lawyer->id)->with('message', 'Post Created Successfully')->with('message_type', 'success');
    }

    /*********View Post  ***********/
    public function show(Lawyer $lawyer, Post $lawyer_post)
    {
        if ($lawyer->id != $lawyer_post->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_posts.show', compact('lawyer_post', 'lawyer'));
    }

    /*********View Edit Form of Post  ***********/
    public function edit(Lawyer $lawyer, Post $lawyer_post)
    {
        if ($lawyer->id != $lawyer_post->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.lawyers.lawyer_posts.edit', compact('lawyer_post', 'blog_categories', 'lawyer', 'tags'));
    }

    /*********Update Post  ***********/
    public function update(CreateRequest $request, Lawyer $lawyer, Post $lawyer_post)
    {
        if ($lawyer->id != $lawyer_post->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['last_updated_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_posts', $lawyer_post->image);
            } else {
                $data['image'] = $lawyer_post->image;
            }
            $lawyer_post->update($data);
            $lawyer_post = Post::find($lawyer_post->id);
            $slug = Str::slug($lawyer_post->name . ' ' . $lawyer_post->id, '-');
            $lawyer_post->update([
                'slug' => $slug
            ]);
            $lawyer_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_posts.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_posts.index', $lawyer->id)->with('message', 'Post Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_posts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_posts." . $extension;
        return Excel::download(new PostsExport($lawyer_posts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new PostsImport, $file);
        return redirect()->back()->with('message', 'Post Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Post ***********/
    public function destroy(Lawyer $lawyer, Post $lawyer_post)
    {
        if ($lawyer->id != $lawyer_post->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $lawyer_post->delete();
        return redirect()->back()->with('message', 'Post Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Post ***********/
    public function destroyPermanently(Request $request, Lawyer $lawyer, $lawyer_post)
    {
        if ($lawyer->id != $lawyer_post->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $lawyer_post = Post::withTrashed()->find($lawyer_post);
        if ($lawyer_post) {
            if ($lawyer_post->trashed()) {
                if ($lawyer_post->image && file_exists(public_path($lawyer_post->image))) {
                    unlink(public_path($lawyer_post->image));
                }
                $lawyer_post->forceDelete();
                return redirect()->back()->with('message', 'Post Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Post Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Post***********/
    public function restore(Request $request, Lawyer $lawyer, $lawyer_post)
    {
        if ($lawyer->id != $lawyer_post->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $lawyer_post = Post::withTrashed()->find($lawyer_post);
        if ($lawyer_post->trashed()) {
            $lawyer_post->restore();
            return redirect()->back()->with('message', 'Post Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
}
