<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{	
	/**
	 * profile
	 *
	 * @return void
	 */
	public function profile()
	{
		$user = Auth::user();

		return view('user.profile', compact('user'));
	}
	
	/**
	 * updateProfile
	 *
	 * @param  mixed $user
	 * @param  mixed $request
	 * @return void
	 */
	public function updateProfile(User $user, Request $request)
	{
		if (Auth::user()->id != $user->id) {
			$authUser = Auth::user();
			$authUser->spam_count += 1;
			$authUser->update();
			return back()->with('error', 'Permission denied.');
		}

		$request->validate([
			'name' => 'required',
			'mobile' => 'required',
			'email' => 'required|email|max:255|exists:users',
            'profile_pic' => 'nullable|image:jpg,jpeg,bmp,gif,svg'
		]);

		$user->name = $request->name;
		$user->mobile = $request->mobile;
		$user->address = $request->address;
		$user->gender = $request->gender;
		if ($request->hasFile('profile_pic')) {
			if (Storage::exists($user->profile_pic)) {
				Storage::delete($user->profile_pic);
			}
			$imagePath = Storage::putFile(config('constants.user.image_dir'), $request->file('profile_pic'));
			$user->profile_pic = $imagePath;
		}
		$user->update();

		return back()->with('success', 'Profile updated successfully.');
	}
}
