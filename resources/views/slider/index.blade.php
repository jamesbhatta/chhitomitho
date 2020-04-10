@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="page-title align-self-center">Sliders</h5>
                </div>
                @include('partials.alerts')
            </div>
        </div>
        <div>
            <div class="text-muted font-italic">Preview:</div>
            <x-home-page-slider :sliders="$sliders"></x-home-page-slider>
        </div>
        <div class="white p-3 card-shadow my-4">
            <div class="mdb-color-text">Slider Settings</div>
            <form action="{{ route('sliders.settings.update') }}" method="POST" class="form">
                @csrf
                @method('put')
                <div class="form-row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="show_indicators" class="custom-control-input" id="show-indicators-checkbox" @if($sliderSettings->show_indicators) checked @endif>
                            <label class="custom-control-label" for="show-indicators-checkbox">Show Indicators</label>
                        </div>
                    </div>
                    
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="show_controls" class="custom-control-input" id="show-controls-checkbox" @if($sliderSettings->show_controls) checked @endif>
                            <label class="custom-control-label" for="show-controls-checkbox">Show Controls</label>
                        </div>
                    </div>
                    
                    <div class="col-auto">
                        <button type="submit" class="btn btn-info btn-sm card-shadow my-1">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-shadow rounded-0">
                    <div class="card-body">
                        <p class="card-text">
                            Slider Details can be managed here.
                        </p>
                    </div>
                    <div class="p-3">
                        <h5>Add a new Slider</h5>
                        <hr>
                        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="image" class="">
                            </div>
                            <div class="form-group">
                                <label for="">Alternative Text</label>
                                <input type="text" name="alt_text" class="form-control rounded-0" value="{{ old('alt_text') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Order</label>
                                <input type="number" name="order" class="form-control rounded-0" min="1" value="{{ old('order') }}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary rounded-0 card-shadow">Add New Sldier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <table class="table custom-table white card-shadow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Alt Text</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($sliders))
                        @foreach ($sliders as $slider)
                        <tr id="cat-{{ $loop->iteration }}" class="category-list-row">
                            <td>{{ $slider->order }}</td>
                            <td>
                                <img src="{{ $slider->imageUrl }}" alt="{{ $slider->alt_text }}" style="height: 50px; max-width: 150px;">
                            </td>
                            <td>{{ $slider->alt_text }}</td>
                            <td>
                                <button type="button" data-id="{{ $loop->iteration }}" class="quick-edit-btn border-0 bg-transparent text-primary"><i class="far fa-edit"></i></button> | 
                                <form action="{{ route('sliders.destroy', $slider) }}" method="POST" class="form d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="del-slider-btn del-btn" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        <tr id="edit-{{ $loop->iteration }}" class="d-none">
                            <td colspan="4">
                                <form action="{{ route('sliders.update', $slider) }}" method="POST" enctype="multipart/form-data" class="form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $slider->id }}" hidden>
                                    <h6 class="font-weight-bolder text- text-muted mb-3">Edit Slider</h6>
                                    <div class="form-group form-row">
                                        <label class="col-sm-1"><i>New Image</i></label>
                                        <div class="col-sm-10">
                                            <input type="file" name="image" class="mr-3">
                                            <br>
                                            <small>(Leave it to unchange)</small>
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <div class="col-md-1">
                                            <label><i>Alt Text</i></label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" name="alt_text" class="form-control form-control-sm rounded-0 mr-3" value="{{ $slider->alt_text }}">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <div class="col-md-1">
                                            <label><i>Order</i></label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="number" name="order" class="form-control form-control-sm rounded-0 mr-3" min="1" value="{{ $slider->order }}">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <button type="button" data-id="{{ $loop->iteration }}" class="cancel-quick-edit-btn btn btn-outline-danger btn-sm z-depth-0 rounded-0">Cancel</button>
                                        <button type="submit" class="ml-auto btn btn-primary btn-sm z-depth-0 rounded-0">Update</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4">The Sliders Image list is empty. Please add some first.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('.category-list-row').hover(function() {
            $(this).find('.list-options').removeClass('invisible');
        }, function () {
            $(this).find('.list-options').addClass('invisible');
        });
        
        $('.quick-edit-btn').click(function () {
            var listId = $(this).data('id');
            $('#cat-' + listId).toggleClass('d-none');
            $('#edit-' + listId).toggleClass('d-none');
        });
        
        $('.cancel-quick-edit-btn').click(function () {
            var listId = $(this).data('id');
            $('#cat-' + listId +  ', #edit-' + listId).toggleClass('d-none');
            // $('#edit-' + listId).toggleClass('d-none');
        });
        
        $('.del-slider-btn').click(function () {
            var ch = confirm ('Are you absolutely sure you want to delete?');
            if(ch == true) {
                return true;
            }
            return false;
        });
        
    });
    
</script>
@endpush