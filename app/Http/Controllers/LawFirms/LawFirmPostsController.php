<?php

namespace App\Http\Controllers\LawFirms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\LawFirms\LawFirmPosts\CreateRequest;
use App\Http\Resources\Web\PostsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawFirmPostsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('law_firm');
        // $this->middleware('permission:law_firm_posts.index');
        // $this->middleware('permission:law_firm_posts.create',['only' => ['store']]);
        // $this->middleware('permission:law_firm_posts.update',['only' => ['update']]);
        // $this->middleware('permission:law_firm_posts.delete',['only' => ['destroy']]);
        // $this->middleware('permission:law_firm_posts.export',['only' => ['export']]);
        // $this->middleware('permission:law_firm_posts.import',['only' => ['import']])
        // $this->middleware('permission:law_firm_posts.update|law_firm_posts.is_active',['only' => ['updateStatus']]);
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        $law_firm = auth()->user()->law_firm;
        if ($req != null) {
            $law_firm_posts =  $law_firm->law_firm_posts()->withAll();
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
            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $law_firm_posts = $law_firm_posts->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $law_firm_posts = $law_firm_posts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_posts = $law_firm_posts->get();
                return $law_firm_posts;
            }
            $totalLawFirmPosts = $law_firm_posts->count();
            $law_firm_posts = $law_firm_posts->paginate($req->perPage);
            $law_firm_posts = PostsResource::collection($law_firm_posts)->response()->getData(true);

            return $law_firm_posts;
        }
        $law_firm_posts = PostsResource::collection($law_firm->law_firm_posts()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $law_firm_posts;
    }

    /********* FETCH ALL LawFirmPosts ***********/
    public function index()
    {
        $law_firm_posts =  $this->getter();
        $response = generateResponse($law_firm_posts, count($law_firm_posts['data']) > 0 ? true : false, 'LawFirmPosts Fetched Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* FILTER LawFirmPosts FOR Search ***********/
    public function filter(Request $request)
    {
        $law_firm_posts = $this->getter($request);
        $response = generateResponse($law_firm_posts, count($law_firm_posts['data']) > 0 ? true : false, 'Filter LawFirmPosts Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* ADD NEW LawFirmPost ***********/
    public function store(CreateRequest $request)
    {
        $law_firm = auth()->user()->law_firm;
        try {
            DB::beginTransaction();
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_posts');
            $law_firm_post = $law_firm->law_firm_posts()->create($data);
            $law_firm_post->slug = Str::slug($law_firm_post->name . ' ' . $law_firm_post->id, '-');
            $law_firm_post->save();
            $law_firm_post = $law_firm->law_firm_posts()->withAll()->find($law_firm_post->id);
            $law_firm_post = new PostsResource($law_firm_post);
            $law_firm_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show($law_firm_post)
    {
        $law_firm = auth()->user()->law_firm;
        if ($law_firm_post->law_firm_id != $law_firm->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_post = $law_firm->law_firm_posts()->withAll()->find($law_firm_post);
        if ($law_firm_post) {
            $law_firm_post = new PostsResource($law_firm_post);
            $response = generateResponse($law_firm_post, true, 'LawFirmPost Fetched Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'LawFirmPost Not FOund', null, 'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawFirmPost ***********/
    public function update(CreateRequest $request, Post $law_firm_post)
    {
        // dd($request->all());
        $law_firm = auth()->user()->law_firm;
        if ($law_firm_post->law_firm_id != $law_firm->id) {
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
                $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_posts', $law_firm_post->image);
            } else {
                $data['image'] = $law_firm_post->image;
            }
            $law_firm_post->update($data);
            $law_firm_post = $law_firm_post->find($law_firm_post->id);
            $slug = Str::slug($law_firm_post['name'] . ' ' . $law_firm_post->id, '-');
            $law_firm_post->update(
                [
                    'slug' => $slug
                ]
            );
            $law_firm_post->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* UPDATE LawFirmPost Status***********/
    public function updateStatus(Request $request, Post $law_firm_post)
    {
        $law_firm = auth()->user()->law_firm;
        if ($law_firm_post->law_firm_id != $law_firm->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_post->update([
            'is_active' => $law_firm_post->is_active == 1 ? 0 : 1
        ]);
        $response = generateResponse(null, true, 'LawFirmPost Status Updated Successfully', null, 'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawFirmPost ***********/
    public function destroy(Request $request, Post $law_firm_post)
    {
        $law_firm = auth()->user()->law_firm;
        if ($law_firm_post->law_firm_id != $law_firm->id) {
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back();
        }
        if ($law_firm_post->trashed()) {
            request()->session()->flash('alert', ['message' => 'Already in Trash', 'type' => 'error']);
        } else {
            $law_firm_post->delete();
        }
        return redirect()->back();
    }
    /*********Permanently DELETE LawFirmPost ***********/
    public function destroyPermanently(Request $request, $law_firm_post)
    {
        $law_firm = auth()->user()->law_firm;
        $law_firm_post = $law_firm->law_firm_posts()->withTrashed()->find($law_firm_post);
        if ($law_firm_post) {
            if ($law_firm_post->law_firm_id != $law_firm->id) {
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
            if ($law_firm_post->trashed()) {
                $law_firm_post->forceDelete();
                $response = generateResponse(null, true, 'LawFirmPost Deleted Successfully', null, 'object');
            } else {
                $response = generateResponse(null, false, 'LawFirmPost is not in trash to delete permanently', null, 'object');
            }
        } else {
            $response = generateResponse(null, false, 'LawFirmPost not found', null, 'object');
        }
        return response()->json($response, 200);
    }
    /********* Restore LawFirmPost ***********/
    public function restore(Request $request, $law_firm_post)
    {
        $law_firm = auth()->user()->law_firm;
        $law_firm_post = $law_firm->law_firm_posts()->withTrashed()->find($law_firm_post);
        if ($law_firm_post->trashed()) {
            $law_firm_post->restore();
            $response = generateResponse(null, true, 'LawFirmPost Restored Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'LawFirmPost is not trashed', null, 'object');
        }
        return response()->json($response, 200);
    }
}
