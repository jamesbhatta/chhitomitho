@if(!empty($sliders))
<div id="carousel-slider" class="carousel slide carousel-fade mb-4" data-ride="carousel">
    {{-- Indicators --}}
    @if($sliderSettings->show_indicators)
    <ol class="carousel-indicators">
        @foreach($sliders as $slider)
        <li data-target="#carousel-slider" data-slide-to="{{ $loop->index }}" class="@if($loop->iteration == 1 ) active @endif""></li>
        @endforeach
    </ol>
    @endif
    {{-- End of indicators --}}
    
    {{-- Slides --}}
    <div class="carousel-inner" role="listbox">
        @foreach($sliders as $slider)
        <div class="carousel-item @if($loop->iteration == 1 ) active @endif">
            <img class="d-block w-100" src="{{ $slider->imageUrl }}" alt="{{ $slider->alt_text }}">
        </div>
        @endforeach
    </div>
    {{-- End of slides --}}
    
    {{-- Controls --}}
    @if($sliderSettings->show_controls)
    <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    @endif
    {{-- End of Controls --}}
</div>
@endif