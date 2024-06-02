<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Models\Announcement;
use App\Models\Department;
use App\Models\Log;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    private $announcements;

    public function __construct()
    {
        $this->middleware('auth');  
        
        $this->announcements = resolve(Announcement::class);
    }

    public function index()
    {
        $announcements = $this->announcements->paginate();
        return view('pages.announcements', compact('announcements'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('pages.announcements_create', compact('departments'));
    }

    public function store(StoreAnnouncementRequest $request)
    {
        $createArray = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'department_id' => $request->input('department_id'),
            'created_by' => auth()->user()->employee->id,
        ];

        if($request->has('attachment') && $request->file('attachment') !== null) {
            $createArray["attachment"] = $request->file('attachment')->store('attachments', 'public');
        }

        Announcement::create($createArray);

        Log::create([
            'description' => auth()->user()->employee->name . " created an announcement titled '" . $request->input('title') . "'"
        ]);

        return redirect()->route('announcements')->with('status', 'Successfully created an announcement.');
    }

    public function show(Announcement $announcement)
    {
        return view('pages.announcements_show', compact('announcement'));
    }
    
    public function edit(Announcement $announcement)
    {
        $departments = Department::all();
        return view('pages.announcements_edit', compact('announcement', 'departments'));
    }

    public function update(StoreAnnouncementRequest $request, Announcement $announcement)
    {
        $updateArray = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'department_id' => $request->input('department_id'),
        ];

        if($request->has('attachment') && $request->file('attachment') !== null) {
            $updateArray["attachment"] = $request->file('attachment')->store('attachments', 'public');
        }

        Announcement::where([
            ['id', '=', $announcement->id],
            ['created_by', '=', auth()->user()->employee->id]
        ])->update($updateArray);

        Log::create([
            'description' => auth()->user()->employee->name . " updated an announcement titled '" . $announcement->title . "'"
        ]);

        return redirect()->route('announcements')->with('status', 'Successfully updated announcement.');
    }

    public function destroy(Announcement $announcement)
    {
        Announcement::where([
            ['id', '=', $announcement->id],
            ['created_by', '=', auth()->user()->employee->id]
        ])->delete();

        Log::create([
            'description' => auth()->user()->employee->name . " deleted an announcement titled '" . $announcement->title . "'"
        ]);

        return redirect()->route('announcements')->with('status', 'Successfully deleted announcement.');
    }

    public function print() 
    {
        $announcements = Announcement::all();
        return view('pages.announcements_print', compact('announcements'));
    }
}
