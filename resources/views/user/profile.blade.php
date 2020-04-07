@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.css">
@endpush

@section('content')
<div class="container">
	<div class="card rounded-0 p-4 z-depth-1">
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
							<label for="profilePic" class="btn btn-primary rounded-0 z-depth-0 text-white" for="">Select Image</label>
						</div>
					</div>
				</div>
				<div class="col-md-8 text-muted">
					<h2 class="h2-responsive font-weight-lighter">User Information</h2>
					<div class="p-3">
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="">Name</label>
								<input type="text" name="name" class="form-control border-top-0 border-right-0 border-left-0" value="{{ Auth::user()->name }}">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Name</label>
								<input type="email" name="email" class="form-control border-top-0 border-right-0 border-left-0" value="{{ Auth::user()->email }}" readonly="readonly">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Mobile</label>
								<input type="text" name="mobile" class="form-control border-top-0 border-right-0 border-left-0" value="{{ old('mobile', Auth::user()->mobile) }}" placeholder="98xxxxxxxx">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Address</label>
								<input type="text" name="address" class="form-control border-top-0 border-right-0 border-left-0" value="{{ old('address', Auth::user()->address) }}" placeholder="Address">
							</div>
							<div class="col-md-6 form-group">
								<label class="form-check-label mb-2" for="">Gender</label>
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
								</div>
							</div>
							
							<div class="col-md-12">
								<button type="submit" class="btn btn-success btn-lg rounded-0">Update</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script>
<script>
	$(function() {
		$('#croppieProfilePic').croppie({
			viewport: { width: 260, height: 260, type: 'square' },
		});
	});
</script>
@endpush