<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.createaccount');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
         // Get the authenticated user's email
         $email = Auth::user()->email;

         // Pass the email to the view
         return view('client.forgotPassword',['email'=>$email]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'حقل كلمة المرور مطلوب.',
            'password.min' => 'حقل كلمة المرور يجب أن تحتوي على الأقل :min أحرف.',
            'password.confirmed' => 'حقل تأكيد كلمة المرور لا يتطابق مع حقل كلمة المرور.',
        ]);

        // Find the authenticated user by their email
        $user = User::where('email', Auth::user()->email)->first();

        // Update the user's password with the new password
        $user->password = Hash::make($request->password);
        $user->save();
        Alert::success('تم تغير كلمه المرور');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'تم تغير كلمه المرور');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
