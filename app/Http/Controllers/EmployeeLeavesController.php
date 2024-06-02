<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeave;
use Illuminate\Http\Request;

class EmployeeLeavesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
