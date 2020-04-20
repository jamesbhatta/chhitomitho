@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
	<div class="card rounded-0 p-4 card-shadow">
		@include('partials.alerts')
		<form action="{{ route('user.profile.update', Auth::user()) }}" method="POST" enctype="multipart/form-data" class="form">
			@csrf
			@method('put')
			<div class="row">
				<div class="col-md-4">
					<div class="profile-pic-container text-center" style="width: 100%; height: 300px;">
						<img id="profilePicPreview" class="img-fluid img-thumbnail" src="{{ Auth::user()->gravatar }}" alt="{{ Auth::user()->name }}" style="max-height: 300px;">
					</div>
					<div class="text-center">
						<input type="file" id="profilePic" name="profile_pic" hidden>
						<div class="p-3">
							<label for="profilePic" class="btn btn-primary rounded-0 card-shadow text-white text-capitalize" for="">Select Image</label>
						</div>
					</div>
				</div>
				<div class="col-md-8 text-muted">
					<h2 class="h2-responsive font-weight-lighter">User Information</h2>
					<div class="p-3">
						<div class="row">
							<div class="col-md-6 form-group">
								<div class="md-form">
									<i class="far fa-user prefix"></i>
									<input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}">
									<label for="name">Name</label>
								</div>
								{{-- <label for="">Name</label> --}}
								{{-- <input typend="text" name="nme" class="form-control border-top-0 border-right-0 border-left-0" value="{{ Auth::user()->name }}"> --}}
							</div>
							<div class="col-md-6 form-group">
								<div class="md-form">
									<i class="far fa-envelope prefix"></i>
									<input type="text" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly="true">
									<label for="email">Email</label>
								</div>
								{{-- <label for="">Email</label> --}}
								{{-- <input type="email" name="email" class="form-control border-top-0 border-right-0 border-left-0" value="{{ Auth::user()->email }}" readonly="readonly"> --}}
							</div>
							<div class="col-md-6 form-group">
								<div class="md-form">
									<i class="fas fa-mobile-alt prefix"></i>
									<input type="text" id="mobile" name="mobile" class="form-control" value="{{ old('mobile', Auth::user()->mobile) }}" placeholder="98xxxxxxxx">
									<label for="mobile">Mobile</label>
								</div>
								{{-- <label for="">Mobile</label> --}}
								{{-- <input type="text" name="mobile" class="form-control border-top-0 border-right-0 border-left-0" value="{{ old('mobile', Auth::user()->mobile) }}" placeholder="98xxxxxxxx"> --}}
							</div>
							<div class="col-md-6 form-group">
								<div class="md-form">
									<i class="fas fa-map-marker-alt prefix"></i>
									<input type="text" id="address" name="address" class="form-control is-invalid" value="{{ old('address', Auth::user()->address) }}">
									<label for="address">Address</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<label for="" class="small">Gender</label>
								<br>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="gender" class="custom-control-input" id="radio-male"  value="male" @if(Auth::user()->gender == 'male') checked @endif>
									<label class="custom-control-label" for="radio-male">Male</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="gender" class="custom-control-input" id="radio-female" value="male" @if(Auth::user()->gender == 'female') checked @endif>
									<label class="custom-control-label" for="radio-female">Female</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="gender" class="custom-control-input" id="radio-other" value="male" @if(Auth::user()->gender == 'other') checked @endif>
									<label class="custom-control-label" for="radio-other">Other</label>
								</div>
								
								{{-- <label class="form-check-label mb-2" for="">Gender</label>
								<br>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="radio" name="gender" class="form-check-input" value="male" @if(Auth::user()->gender == 'male') checked @endif>Male
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="radio" name="gender" class="form-check-input" value="female" @if(Auth::user()->gender == 'female') checked @endif>Female
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="radio" name="gender" class="form-check-input" value="other" @if(Auth::user()->gender == 'other') checked @endif>Other
									</label>
								</div> --}}
							</div>
							
							<div class="col-md-12 d-flex">
								<button type="submit" class="btn btn-outline-success btn-lg rounded-0 card-shadow text-capitalize">Update</button>
								<button class="btn btn-secondary btn-lg rounded-0 card-shadow ml-auto text-capitalize">Account Verification</button>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@push('scripts')
<script>
	$(function () {
		function readProfilePicURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#profilePicPreview').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$("#profilePic").change(function(){
			readProfilePicURL(this);
		});
	});
</script>
@endpush