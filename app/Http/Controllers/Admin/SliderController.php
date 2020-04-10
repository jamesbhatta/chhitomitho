<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        $sliderSettings = Slider::withoutGlobalScopes()->sliderSettings()->get()->first();
        $sliderSettings = json_decode($sliderSettings->data);
        return view('slider.index', compact('sliders', 'sliderSettings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $imagePath = Storage::putFile(config('constants.slider.image_dir'), $request->file('image'));
        Slider::create([
            'image' => $imagePath,
            'alt_text' => $request->alt_text,
            'order' => $request->order
        ]);
        
        return redirect()->route('sliders.index')->with('success', 'Slider has been added.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        if ($request->hasFile('image')) {
            Storage::delete($slider->image);
            $imagePath = Storage::putFile(config('constants.slider.image_dir'), $request->file('image'));
            $slider->fill(['image' => $imagePath]);
        }

        $slider->fill([
            'alt_text' => $request->alt_text,
            'order' => $request->order
        ])->update();
        
        return redirect()->route('sliders.index')->with('success', 'Slider has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if (Storage::exists($slider->image)) {
            Storage::delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider has been deleted.');
    }
    
    /**
     * Save slider settings
     *
     * @return void
     */
    public function saveSettings(Request $request)
    {
        $settings = Slider::withoutGlobalScopes()->sliderSettings()->get()->first();

        if (empty($settings)) {
            $settings = new Slider();
        }
        $data = array(
            'show_controls' => $request->boolean('show_controls'),
            'show_indicators' => $request->boolean('show_indicators'),
        );

        $settings->fill([
            'is_setting' => true,
            'data' => json_encode($data)
        ])->save();

        return redirect()->back()->with('success', 'Slider settings have been saved');
    }
}
