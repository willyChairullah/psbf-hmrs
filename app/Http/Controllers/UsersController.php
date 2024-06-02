<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->middleware('auth');  
        
        $this->users = resolve(User::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->paginate();
        return view('pages.users', compact('users'));
    }

    public function print()
    {
        $users = User::with('role')->latest()->get();
        return view('pages.users_print', compact('users'));
    }
}
