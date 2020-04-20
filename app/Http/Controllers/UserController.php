<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
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
		]);

		$user->name = $request->name;
		$user->mobile = $request->mobile;
		$user->address = $request->address;
		$user->gender = $request->gender;
		$user->update();

		return back()->with('success', 'Profile updated successfully.');
	}
	
	/**
	 * changePassword
	 *
	 * @param  mixed $request
	 * @param  mixed $user
	 * @return void
	 */
	public function changePassword(Request $request, User $user)
	{
		$request->validate([
			'old_password' => 'required',
			'password' => 'required|confirmed|min:8'
		]);

		if (Hash::check($request->old_password, $user->password)) {
			$user->fill(['password' => Hash::make($request->password)])->save();

			return redirect()->back()->with('success', 'Password has been changed');
		}

		return redirect()->back()->with('error', 'Error! Invalid old password.');
	}

	public function changeProfilePic(Request $request, User $user)
	{
		$request->validate([
			'profile_pic' => 'required|image:jpg,jpeg,bmp,gif,svg'
		]);

		if ($request->hasFile('profile_pic')) {
			if (Storage::exists($user->profile_pic)) {
				Storage::delete($user->profile_pic);
			}
			$imagePath = Storage::putFile(config('constants.user.image_dir'), $request->file('profile_pic'));
			$user->fill(['profile_pic' => $imagePath])->save();
		};

		$url = $user->gravatar;

		return response()->json(['status' => 200, 'url' => $url]);
	}
}
