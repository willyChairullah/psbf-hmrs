<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->middleware('auth');

        $this->users = resolve(User::class);
    }

    public function index()
    {
        $profile = $this->users->getProfile();
        return view('pages.profile', compact('profile'));
    }

    public function update(StoreProfileRequest $request, User $user)
    {
        User::whereId($user->id)
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);

        $employee = Employee::whereUserId($user->id)->first();
        $employee->update([
            'name' => $request->input('name'),
        ]);

        $updateArray = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ];

        if ($request->has('profile')) {
            $updateArray["photo"] = $request->file('profile')->store('photos', 'public');
        }

        EmployeeDetail::whereEmployeeId($employee->id)->update($updateArray);

        Log::create([
            'description' => auth()->user()->employee->name . " updated profile"
        ]);

        return redirect()->route('profile')->with('status', 'Successfully updated the profile.');
    }
}
