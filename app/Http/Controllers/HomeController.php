<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function profile()
    {
        return view('auth.profile');
    }
    public function passwordEdit()
    {
        return view('auth.changepassword');
    }
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        if (strcmp($request->get('current_password'), $request->get('password')) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }
    public function edit()
    {
        return view('auth.edit');
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('profile')) {

            // $path = $request->file('profile')->store('profile');
            // $filename = basename($path);
            // $user->image = $filename;

            if (Storage::exists('profile/thumb/' . $user->image)) {
                Storage::disk()->delete('profile/thumb/' . $user->image);
            }
            if (Storage::exists('profile/' . $user->image)) {
                Storage::disk()->delete('profile/' . $user->image);
                $user->image = null;
                $user->save();
            }

            $image = $request->file('profile')->store('profile');
            $filename = basename($image);
            $img = Image::make($request->file('profile'))->resize(150, 150, function ($const) {
                $const->aspectRatio();
            })->save();
            Storage::disk()->put('profile/thumb/' . $filename, $img);

            // $image = $request->file('profile');
            // $filename = time() . '.' . $image->extension();
            // $request->file('profile')->storeAs('Profile1', $filename);
            // $img = Image::make($image->path());
            // $img->resize(110, 110, function ($const) {
            //     $const->aspectRatio();
            // })->save();
            // $filePath = storage_path('app/public/Profile1/Thumbnails');
            // $image->move($filePath, $filename);

            $user->name = $request['name'];
            $user->username = $request['username'];
            $user->image = $filename;
            $user->save();

            return redirect('home')->with('message', 'Profile Updated Successfully');
        }
    }
}
