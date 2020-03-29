@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.css">
@endpush

@section('content')
<div class="container">
	<div class="card rounded-0 p-4 z-depth-1">
		@include('partials.alerts')
		<div class="row">
			<div class="col-md-4">
				<div class="profile-pic-container text-center" style="width: 100%; height: 300px;">
					<img class="img-fluid rounded-circle" src="{{ Auth::user()->gravatar }}" alt="{{ Auth::user()->name }}">
				</div>
			</div>
			<div class="col-md-8 text-muted">
				<h2 class="h2-responsive font-weight-lighter">User Information</h2>
				<div class="p-3">
					<form action="{{ route('user.profile.update', Auth::user()) }}" method="POST" class="form">
						@csrf
						@method('put')
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
										<input type="radio" name="gender" class="form-check-input" value="male">Male
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="radio" name="gender" class="form-check-input" value="female">Female
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="radio" name="gender" class="form-check-input" value="other">Other
									</label>
								</div>
							</div>
							
							<div class="col-md-12">
								<button type="submit" class="btn btn-success btn-lg rounded-0">Update</button>
							</div>
							
						</div>
					</form>
				</div>
			</div>
		</div>
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