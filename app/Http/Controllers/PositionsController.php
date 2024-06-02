<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Models\Log;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    private $positions;

    public function __construct()
    {
        $this->middleware('auth');  
        
        $this->positions = resolve(Position::class);
    }

    public function index()
    {
        $positions = $this->positions->paginate();
        return view('pages.positions-data', compact('positions'));
    }

    public function create()
    {
        return view('pages.positions-data_create');
    }

    public function store(StorePositionRequest $request)
    {
        Position::create($request->validated());

        Log::create([
            'description' => auth()->user()->employee->name . " created a position named '" . $request->input('name') . "'"
        ]);

        return redirect()->route('positions-data')->with('status', 'Successfully created a position.');
    }

    public function show(Position $position)
    {
        return view('pages.positions-data_show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('pages.positions-data_edit', compact('position'));
    }

    public function update(StorePositionRequest $request, Position $position)
    {
        Position::where('id', $position->id)->update($request->validated());

        Log::create([
            'description' => auth()->user()->employee->name . " updated a position's detail named '" . $position->name . "'"
        ]);

        return redirect()->route('positions-data')->with('status', 'Successfully updated position.');
    }

    public function destroy(Position $position)
    {
        Position::where('id', $position->id)->delete();

        Log::create([
            'description' => auth()->user()->employee->name . " deleted a position named '" . $position->name . "'"
        ]);

        return redirect()->route('positions-data')->with('status', 'Successfully deleted a position.');
    }

    public function print() {
        $positions = Position::all();

        return view('pages.positions-data_print', compact('positions'));
    }
}
