<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\PostsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Posts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\PostsImport;
use App\Models\Post;
use App\Models\LawFirm;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawFirmPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm.add_blog');
        $this->middleware('permission:law_firm.add_blog', ['only' => ['store']]);
        $this->middleware('permission:law_firm.add_blog', ['only' => ['update']]);
        $this->middleware('permission:law_firm.add_blog', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm.add_blog', ['only' => ['export']]);
        $this->middleware('permission:law_firm.add_blog', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $law_firm)
    {
        if ($req != null) {
            $law_firm_posts =  $law_firm->law_firm_posts();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_posts =  $law_firm_posts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_posts =  $law_firm_posts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_posts = $law_firm_posts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_posts = $law_firm_posts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firm_posts = $law_firm_posts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firm_posts = $law_firm_posts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_posts = $law_firm_posts->get();
                return $law_firm_posts;
            }
            $law_firm_posts = $law_firm_posts->get();
            return $law_firm_posts;
        }
        $law_firm_posts = $law_firm->law_firm_posts()->withAll()->orderBy('id', 'desc')->get();
        return $law_firm_posts;
    }


    /*********View All Posts  ***********/
    public function index(Request $request, LawFirm $law_firm)
    {
        $law_firm_posts = $this->getter($request, null, $law_firm);
        return view('super_admins.law_firms.law_firm_posts.index', compact('law_firm_posts', 'law_firm'));
    }

    /*********View Create Form of Post  ***********/
    public function create(LawFirm $law_firm)
    {
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();

        return view('super_admins.law_firms.law_firm_posts.create', compact('blog_categories', 'law_firm', 'tags'));
    }

    /*********Store Post  ***********/
    public function store(CreateRequest $request, LawFirm $law_firm)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_posts');
            $law_firm_post = $law_firm->law_firm_posts()->create($data);
            $law_firm_post->slug = Str::slug($law_firm_post->name . ' ' . $law_firm_post->id, '-');
            $law_firm_post->save();
            $law_firm_post = $law_firm->law_firm_posts()->withAll()->find($law_firm_post->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_posts.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_posts.index', $law_firm->id)->with('message', 'Post Created Successfully')->with('message_type', 'success');
    }

    /*********View Post  ***********/
    public function show(LawFirm $law_firm, Post $law_firm_post)
    {
        if ($law_firm->id != $law_firm_post->law_firm_id) {
            return redirect()->back()->with('message', 'LawFirmEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_posts.show', compact('law_firm_post', 'law_firm'));
    }

    /*********View Edit Form of Post  ***********/
    public function edit(LawFirm $law_firm, Post $law_firm_post)
    {
        if ($law_firm->id != $law_firm_post->law_firm_id) {
            return redirect()->back()->with('message', 'LawFirmEducation Not Found')->with('message_type', 'error');
        }
        $blog_categories = BlogCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.law_firms.law_firm_posts.edit', compact('law_firm_post', 'blog_categories', 'law_firm', 'tags'));
    }

    /*********Update Post  ***********/
    public function update(CreateRequest $request, LawFirm $law_firm, Post $law_firm_post)
    {
        if ($law_firm->id != $law_firm_post->law_firm_id) {
            return redirect()->back()->with('message', 'LawFirmEducation Not Found')->with('message_type', 'error');
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
                $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_posts', $law_firm_post->image);
            } else {
                $data['image'] = $law_firm_post->image;
            }
            $law_firm_post->update($data);
            $law_firm_post = Post::find($law_firm_post->id);
            $slug = Str::slug($law_firm_post->name . ' ' . $law_firm_post->id, '-');
            $law_firm_post->update([
                'slug' => $slug
            ]);
            $law_firm_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_posts.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_posts.index', $law_firm->id)->with('message', 'Post Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firm_posts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firm_posts." . $extension;
        return Excel::download(new PostsExport($law_firm_posts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new PostsImport, $file);
        return redirect()->back()->with('message', 'Post Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Post ***********/
    public function destroy(LawFirm $law_firm, Post $law_firm_post)
    {
        if ($law_firm->id != $law_firm_post->law_firm_id) {
            return redirect()->back()->with('message', 'LawFirmEducation Not Found')->with('message_type', 'error');
        }
        $law_firm_post->delete();
        return redirect()->back()->with('message', 'Post Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Post ***********/
    public function destroyPermanently(Request $request, LawFirm $law_firm, $law_firm_post)
    {
        if ($law_firm->id != $law_firm_post->law_firm_id) {
            return redirect()->back()->with('message', 'LawFirmEducation Not Found')->with('message_type', 'error');
        }
        $law_firm_post = Post::withTrashed()->find($law_firm_post);
        if ($law_firm_post) {
            if ($law_firm_post->trashed()) {
                if ($law_firm_post->image && file_exists(public_path($law_firm_post->image))) {
                    unlink(public_path($law_firm_post->image));
                }
                $law_firm_post->forceDelete();
                return redirect()->back()->with('message', 'Post Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Post Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Post***********/
    public function restore(Request $request, LawFirm $law_firm, $law_firm_post)
    {
        if ($law_firm->id != $law_firm_post->law_firm_id) {
            return redirect()->back()->with('message', 'LawFirmEducation Not Found')->with('message_type', 'error');
        }
        $law_firm_post = Post::withTrashed()->find($law_firm_post);
        if ($law_firm_post->trashed()) {
            $law_firm_post->restore();
            return redirect()->back()->with('message', 'Post Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Post Category Not Found')->with('message_type', 'error');
        }
    }
}
