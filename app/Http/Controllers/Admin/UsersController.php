<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->has('search_term') ? $request->search_term : null;
        if ($searchTerm) {
            $users = User::where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                ->orWhere('mobile', 'LIKE', "%{$searchTerm}%")->paginate(config('constants.user.items_per_page', 15));
        } else {
            $role = $request->get('role');
            $users = User::filterByRole($role)->latest()->paginate(config('constants.user.items_per_page', 15));
        }

        return view('user.index', compact('users', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'mobile'        => $request->mobile,
            'address'       => $request->address,
            'gender'        => $request->gender,
            'role'          => $request->role,
        ]);

        if ($user->hasRole('courier')) {
            if (empty($user->meta)) {
                $userMeta = new \App\UserMeta();
                $userMeta->user_id = $user->id;
            } else {
                $userMeta = $user->meta;
            }
            $userMeta->commission_percentage = $request->commission_percentage;
            $userMeta->credit_limit = $request->credit_limit;
            $userMeta->save();
        }

        return redirect()->route('users.edit', $user)->with('success', 'User has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill([
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'address'       => $request->address,
            'gender'        => $request->gender,
            'role'          => $request->role,
        ]);

        if ($request->hasFile('profile_pic')) {
            if (Storage::exists($user->profile_pic)) {
                Storage::delete($user->profile_pic);
            }
            $imagePath = Storage::putFile(config('constants.user.image_dir'), $request->file('profile_pic'));
            $user->fill(['profile_pic' => $imagePath]);
        }

        if ($request->filled('password')) {
            $user->fill(['password' => Hash::make($request->password)]);
        }

        $user->update();

        if ($user->hasRole('courier')) {
            if (empty($user->meta)) {
                $userMeta = new \App\UserMeta();
                $userMeta->user_id = $user->id;
            } else {
                $userMeta = $user->meta;
            }
            $userMeta->commission_percentage = $request->commission_percentage;
            $userMeta->credit_limit = $request->credit_limit;
            $userMeta->save();
        }

        return redirect()->back()->with(['success' => 'User has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Storage::exists($user->profile_pic)) {
            Storage::delete($user->profile_pic);
        }
        $user->delete();

        return redirect()->route('users.index')->with(['success' => 'User has been deleted.']);
    }
}
