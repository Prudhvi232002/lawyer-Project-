<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Events\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\EventsImport;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Lawyer;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawyerEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.add_event');
        $this->middleware('permission:lawyer.add_event', ['only' => ['store']]);
        $this->middleware('permission:lawyer.add_event', ['only' => ['update']]);
        $this->middleware('permission:lawyer.add_event', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.add_event', ['only' => ['export']]);
        $this->middleware('permission:lawyer.add_event', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $lawyer)
    {
        if ($req != null) {
            $lawyer_events =  $lawyer->lawyer_events();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_events =  $lawyer_events->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_events =  $lawyer_events->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_events = $lawyer_events->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_events = $lawyer_events->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_events = $lawyer_events->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_events = $lawyer_events->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_events = $lawyer_events->get();
                return $lawyer_events;
            }
            $lawyer_events = $lawyer_events->get();
            return $lawyer_events;
        }
        $lawyer_events = $lawyer->lawyer_events()->withAll()->orderBy('id', 'desc')->get();
        return $lawyer_events;
    }


    /*********View All Events  ***********/
    public function index(Request $request, Lawyer $lawyer)
    {
        $lawyer_events = $this->getter($request, null, $lawyer);
        return view('super_admins.lawyers.lawyer_events.index', compact('lawyer_events', 'lawyer'));
    }

    /*********View Create Form of Event  ***********/
    public function create(Lawyer $lawyer)
    {
        $tags = Tag::active()->get();
        $event_categories = EventCategory::active()->get();
        return view('super_admins.lawyers.lawyer_events.create', compact('lawyer', 'tags', 'event_categories'));
    }

    /*********Store Event  ***********/
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
            $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_events');
            $lawyer_event = $lawyer->lawyer_events()->create($data);
            $lawyer_event->slug = Str::slug($lawyer_event->name . ' ' . $lawyer_event->id, '-');
            $lawyer_event->save();
            foreach ($request->sponsers as $sponser) {
                $image_url = uploadArrayFile($sponser, 'image', 'event_sponsers');
                $lawyer_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
            }
            $lawyer_event->tags()->sync($request->tag_ids);
            $lawyer_event = $lawyer->lawyer_events()->withAll()->find($lawyer_event->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_events.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_events.index', $lawyer->id)->with('message', 'Event Created Successfully')->with('message_type', 'success');
    }

    /*********View Event  ***********/
    public function show(Lawyer $lawyer, Event $lawyer_event)
    {
        if ($lawyer->id != $lawyer_event->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_events.show', compact('lawyer_event', 'lawyer'));
    }

    /*********View Edit Form of Event  ***********/
    public function edit(Lawyer $lawyer, Event $lawyer_event)
    {
        if ($lawyer->id != $lawyer_event->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $tags = Tag::active()->get();
        $event_categories = EventCategory::active()->get();
        return view('super_admins.lawyers.lawyer_events.edit', compact('lawyer_event', 'lawyer', 'tags', 'event_categories'));
    }

    /*********Update Event  ***********/
    public function update(CreateRequest $request, Lawyer $lawyer, Event $lawyer_event)
    {
        if ($lawyer->id != $lawyer_event->lawyer_id) {
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
                $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_events', $lawyer_event->image);
            } else {
                $data['image'] = $lawyer_event->image;
            }
            $lawyer_event->sponsers()->delete();
            foreach ($request->sponsers as $sponser) {
                if (isset($sponser['image'])) {
                    if (is_string($sponser['image']) && $sponser['image'] != 'undefined') {
                        $image_url = $sponser['previous_image'];
                    } else {
                        $image_url = uploadArrayFile($sponser, 'image', 'event_sponsers');
                    }
                }
                $lawyer_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
            }
            $lawyer_event->update($data);
            $lawyer_event = Event::find($lawyer_event->id);
            $slug = Str::slug($lawyer_event->name . ' ' . $lawyer_event->id, '-');
            $lawyer_event->update([
                'slug' => $slug
            ]);
            $lawyer_event->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_events.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_events.index', $lawyer->id)->with('message', 'Event Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_events = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_events." . $extension;
        return Excel::download(new EventsExport($lawyer_events), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new EventsImport, $file);
        return redirect()->back()->with('message', 'Event Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Event ***********/
    public function destroy(Lawyer $lawyer, Event $lawyer_event)
    {
        if ($lawyer->id != $lawyer_event->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $lawyer_event->delete();
        return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Event ***********/
    public function destroyPermanently(Request $request, Lawyer $lawyer, $lawyer_event)
    {
        if ($lawyer->id != $lawyer_event->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $lawyer_event = Event::withTrashed()->find($lawyer_event);
        if ($lawyer_event) {
            if ($lawyer_event->trashed()) {
                if ($lawyer_event->image && file_exists(public_path($lawyer_event->image))) {
                    unlink(public_path($lawyer_event->image));
                }
                $lawyer_event->forceDelete();
                return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Event is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Event***********/
    public function restore(Request $request, Lawyer $lawyer, $lawyer_event)
    {
        if ($lawyer->id != $lawyer_event->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $lawyer_event = Event::withTrashed()->find($lawyer_event);
        if ($lawyer_event->trashed()) {
            $lawyer_event->restore();
            return redirect()->back()->with('message', 'Event Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
}
