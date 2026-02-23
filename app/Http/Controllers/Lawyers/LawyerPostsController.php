<?php

namespace App\Http\Controllers\Lawyers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Lawyers\LawyerPosts\CreateRequest;
use App\Http\Resources\Web\PostsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawyerPostsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lawyer');
        // $this->middleware('permission:lawyer_posts.index');
        // $this->middleware('permission:lawyer_posts.create',['only' => ['store']]);
        // $this->middleware('permission:lawyer_posts.update',['only' => ['update']]);
        // $this->middleware('permission:lawyer_posts.delete',['only' => ['destroy']]);
        // $this->middleware('permission:lawyer_posts.export',['only' => ['export']]);
        // $this->middleware('permission:lawyer_posts.import',['only' => ['import']])
        // $this->middleware('permission:lawyer_posts.update|lawyer_posts.is_active',['only' => ['updateStatus']]);
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        $lawyer = auth()->user()->lawyer;
        if ($req != null) {
            $lawyer_posts =  $lawyer->lawyer_posts()->withAll();
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
            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $lawyer_posts = $lawyer_posts->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $lawyer_posts = $lawyer_posts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_posts = $lawyer_posts->get();
                return $lawyer_posts;
            }
            $totalLawyerPosts = $lawyer_posts->count();
            $lawyer_posts = $lawyer_posts->paginate($req->perPage);
            $lawyer_posts = PostsResource::collection($lawyer_posts)->response()->getData(true);

            return $lawyer_posts;
        }
        $lawyer_posts = PostsResource::collection($lawyer->lawyer_posts()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $lawyer_posts;
    }

    /********* FETCH ALL LawyerPosts ***********/
    public function index()
    {
        $lawyer_posts =  $this->getter();
        $response = generateResponse($lawyer_posts, count($lawyer_posts['data']) > 0 ? true : false, 'LawyerPosts Fetched Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* FILTER LawyerPosts FOR Search ***********/
    public function filter(Request $request)
    {
        $lawyer_posts = $this->getter($request);
        $response = generateResponse($lawyer_posts, count($lawyer_posts['data']) > 0 ? true : false, 'Filter LawyerPosts Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* ADD NEW LawyerPost ***********/
    public function store(CreateRequest $request)
    {
        $lawyer = auth()->user()->lawyer;
        try {
            DB::beginTransaction();
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_posts');
            $lawyer_post = $lawyer->lawyer_posts()->create($data);
            $lawyer_post->slug = Str::slug($lawyer_post->name . ' ' . $lawyer_post->id, '-');
            $lawyer_post->save();
            $lawyer_post = $lawyer->lawyer_posts()->withAll()->find($lawyer_post->id);
            $lawyer_post = new PostsResource($lawyer_post);
            $lawyer_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show($lawyer_post)
    {
        $lawyer = auth()->user()->lawyer;
        if ($lawyer_post->lawyer_id != $lawyer->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_post = $lawyer->lawyer_posts()->withAll()->find($lawyer_post);
        if ($lawyer_post) {
            $lawyer_post = new PostsResource($lawyer_post);
            $response = generateResponse($lawyer_post, true, 'LawyerPost Fetched Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'LawyerPost Not FOund', null, 'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawyerPost ***********/
    public function update(CreateRequest $request, Post $lawyer_post)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if ($lawyer_post->lawyer_id != $lawyer->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        try {
            DB::beginTransaction();
            $request->merge(['last_updated_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_posts', $lawyer_post->image);
            } else {
                $data['image'] = $lawyer_post->image;
            }
            $lawyer_post->update($data);
            $lawyer_post = $lawyer_post->find($lawyer_post->id);
            $slug = Str::slug($lawyer_post['name'] . ' ' . $lawyer_post->id, '-');
            $lawyer_post->update(
                [
                    'slug' => $slug
                ]
            );
            $lawyer_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* UPDATE LawyerPost Status***********/
    public function updateStatus(Request $request, Post $lawyer_post)
    {
        $lawyer = auth()->user()->lawyer;
        if ($lawyer_post->lawyer_id != $lawyer->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_post->update([
            'is_active' => $lawyer_post->is_active == 1 ? 0 : 1
        ]);
        $response = generateResponse(null, true, 'LawyerPost Status Updated Successfully', null, 'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawyerPost ***********/
    public function destroy(Request $request, Post $lawyer_post)
    {
        $lawyer = auth()->user()->lawyer;
        if ($lawyer_post->lawyer_id != $lawyer->id) {
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back();
        }
        if ($lawyer_post->trashed()) {
            request()->session()->flash('alert', ['message' => 'Already in Trash', 'type' => 'error']);
        } else {
            $lawyer_post->delete();
        }
        return redirect()->back();
    }
    /*********Permanently DELETE LawyerPost ***********/
    public function destroyPermanently(Request $request, $lawyer_post)
    {
        $lawyer = auth()->user()->lawyer;
        $lawyer_post = $lawyer->lawyer_posts()->withTrashed()->find($lawyer_post);
        if ($lawyer_post) {
            if ($lawyer_post->lawyer_id != $lawyer->id) {
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
            if ($lawyer_post->trashed()) {
                $lawyer_post->forceDelete();
                $response = generateResponse(null, true, 'LawyerPost Deleted Successfully', null, 'object');
            } else {
                $response = generateResponse(null, false, 'LawyerPost is not in trash to delete permanently', null, 'object');
            }
        } else {
            $response = generateResponse(null, false, 'LawyerPost not found', null, 'object');
        }
        return response()->json($response, 200);
    }
    /********* Restore LawyerPost ***********/
    public function restore(Request $request, $lawyer_post)
    {
        $lawyer = auth()->user()->lawyer;
        $lawyer_post = $lawyer->lawyer_posts()->withTrashed()->find($lawyer_post);
        if ($lawyer_post->trashed()) {
            $lawyer_post->restore();
            $response = generateResponse(null, true, 'LawyerPost Restored Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'LawyerPost is not trashed', null, 'object');
        }
        return response()->json($response, 200);
    }
}
