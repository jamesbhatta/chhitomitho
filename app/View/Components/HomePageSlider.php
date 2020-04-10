<?php

namespace App\View\Components;

use App\Slider;
use Illuminate\View\Component;

class HomePageSlider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $sliders = Slider::ordered()->get();
        $sliderSettings = Slider::withoutGlobalScopes()->sliderSettings()->get()->first();
        $sliderSettings = json_decode($sliderSettings->data);

        return view('components.home-page-slider', [
            'sliders' => $sliders,
            'sliderSettings' => $sliderSettings
        ]);
    }
}
