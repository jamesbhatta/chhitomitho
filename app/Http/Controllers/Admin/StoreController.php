<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::with('owner')->get();
        $partners = User::partners()->get();

        return view('store.index', compact('stores', 'partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $store = new Store($request->except('logo'));

        if ($request->hasFile('logo')) {
            $logoPath = Storage::putFile(config('constants.store.image_dir'), $request->file('logo'));
            $store->fill(['logo' => $logoPath]);
        }
        $store->save();

        return redirect()->back()->with('success', 'Store has been added to list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
        // $request->validate([
        //     'name'  => 'required|string',
        //     'user_id' => 'required|unique:stores,user_id,' . $store->id  . '|exists:users,id',
        //     ]);

        if ($request->hasFile('logo')) {
            Storage::delete($store->logo);
            $logoPath = Storage::putFile(config('constants.store.image_dir'), $request->file('logo'));
            $store->fill(['logo' => $logoPath]);
        }
        $store->fill($request->except('logo'))->save();

        return redirect()->back()->with('success', 'Store has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->back()->with('success', 'Store has been delted successfully');
    }
}
