<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\EventsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Events\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\EventsImport;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\LawFirm;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawFirmEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm.add_event');
        $this->middleware('permission:law_firm.add_event', ['only' => ['store']]);
        $this->middleware('permission:law_firm.add_event', ['only' => ['update']]);
        $this->middleware('permission:law_firm.add_event', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm.add_event', ['only' => ['export']]);
        $this->middleware('permission:law_firm.add_event', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $law_firm)
    {
        if ($req != null) {
            $law_firm_events =  $law_firm->law_firm_events();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_events =  $law_firm_events->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_events =  $law_firm_events->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_events = $law_firm_events->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_events = $law_firm_events->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firm_events = $law_firm_events->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firm_events = $law_firm_events->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_events = $law_firm_events->get();
                return $law_firm_events;
            }
            $law_firm_events = $law_firm_events->get();
            return $law_firm_events;
        }
        $law_firm_events = $law_firm->law_firm_events()->withAll()->orderBy('id', 'desc')->get();
        return $law_firm_events;
    }


    /*********View All Events  ***********/
    public function index(Request $request, LawFirm $law_firm)
    {
        $law_firm_events = $this->getter($request, null, $law_firm);
        return view('super_admins.law_firms.law_firm_events.index', compact('law_firm_events', 'law_firm'));
    }

    /*********View Create Form of Event  ***********/
    public function create(LawFirm $law_firm)
    {
        $tags = Tag::active()->get();
        $event_categories = EventCategory::active()->get();
        return view('super_admins.law_firms.law_firm_events.create', compact('law_firm', 'tags', 'event_categories'));
    }

    /*********Store Event  ***********/
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
            $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_events');
            $law_firm_event = $law_firm->law_firm_events()->create($data);
            $law_firm_event->slug = Str::slug($law_firm_event->name . ' ' . $law_firm_event->id, '-');
            $law_firm_event->save();
            foreach ($request->sponsers as $sponser) {
                $image_url = uploadArrayFile($sponser, 'image', 'event_sponsers');
                $law_firm_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
            }
            $law_firm_event->tags()->sync($request->tag_ids);
            $law_firm_event = $law_firm->law_firm_events()->withAll()->find($law_firm_event->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_events.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_events.index', $law_firm->id)->with('message', 'Event Created Successfully')->with('message_type', 'success');
    }

    /*********View Event  ***********/
    public function show(LawFirm $law_firm, Event $law_firm_event)
    {
        if ($law_firm->id != $law_firm_event->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_events.show', compact('law_firm_event', 'law_firm'));
    }

    /*********View Edit Form of Event  ***********/
    public function edit(LawFirm $law_firm, Event $law_firm_event)
    {
        if ($law_firm->id != $law_firm_event->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $tags = Tag::active()->get();
        $event_categories = EventCategory::active()->get();
        return view('super_admins.law_firms.law_firm_events.edit', compact('law_firm_event', 'law_firm', 'tags', 'event_categories'));
    }

    /*********Update Event  ***********/
    public function update(CreateRequest $request, LawFirm $law_firm, Event $law_firm_event)
    {
        if ($law_firm->id != $law_firm_event->law_firm_id) {
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
                $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_events', $law_firm_event->image);
            } else {
                $data['image'] = $law_firm_event->image;
            }
            $law_firm_event->sponsers()->delete();
            foreach ($request->sponsers as $sponser) {
                if (isset($sponser['image'])) {
                    if (is_string($sponser['image']) && $sponser['image'] != 'undefined') {
                        $image_url = $sponser['previous_image'];
                    } else {
                        $image_url = uploadArrayFile($sponser, 'image', 'event_sponsers');
                    }
                }
                $law_firm_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
            }
            $law_firm_event->update($data);
            $law_firm_event = Event::find($law_firm_event->id);
            $slug = Str::slug($law_firm_event->name . ' ' . $law_firm_event->id, '-');
            $law_firm_event->update([
                'slug' => $slug
            ]);
            $law_firm_event->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_events.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_events.index', $law_firm->id)->with('message', 'Event Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firm_events = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firm_events." . $extension;
        return Excel::download(new EventsExport($law_firm_events), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new EventsImport, $file);
        return redirect()->back()->with('message', 'Event Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Event ***********/
    public function destroy(LawFirm $law_firm, Event $law_firm_event)
    {
        if ($law_firm->id != $law_firm_event->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $law_firm_event->delete();
        return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Event ***********/
    public function destroyPermanently(Request $request, LawFirm $law_firm, $law_firm_event)
    {
        if ($law_firm->id != $law_firm_event->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $law_firm_event = Event::withTrashed()->find($law_firm_event);
        if ($law_firm_event) {
            if ($law_firm_event->trashed()) {
                if ($law_firm_event->image && file_exists(public_path($law_firm_event->image))) {
                    unlink(public_path($law_firm_event->image));
                }
                $law_firm_event->forceDelete();
                return redirect()->back()->with('message', 'Event Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Event is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Event***********/
    public function restore(Request $request, LawFirm $law_firm, $law_firm_event)
    {
        if ($law_firm->id != $law_firm_event->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $law_firm_event = Event::withTrashed()->find($law_firm_event);
        if ($law_firm_event->trashed()) {
            $law_firm_event->restore();
            return redirect()->back()->with('message', 'Event Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Event Not Found')->with('message_type', 'error');
        }
    }
}
