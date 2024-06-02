<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $logs = Log::latest()->paginate(10);

        return view('pages.logs', compact('logs'));
    }

    public function print()
    {
        $logs = Log::all();
        return view('pages.logs_print', compact('logs'));
    }
}
