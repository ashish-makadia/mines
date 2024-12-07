@extends('layout.dashboard.app')

@section('content')
<div class="dashboard-content">

	<!-- Titlebar -->
	<div id="titlebar">
		<div class="row">
			<div class="col-md-12">
				<h2>My Profile</h2>
				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{route('index')}}">Home</a></li>
						<li><a href="{{route('dashboard')}}">Dashboard</a></li>
						<li>My Profile</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<div class="row">

		<!-- Profile -->
		<div class="col-lg-6 col-md-12">
			<div class="dashboard-list-box margin-top-0">
				<h4 class="gray">Profile Details</h4>
				<div class="dashboard-list-box-static">
					<form action="{{route('storeprofile')}}" method="post" enctype="multipart/form-data">
						@csrf
						<!-- Avatar -->
						<div class="edit-profile-photo">

							@if($userdetails->profile_img != null)
							<img id="imgPreview" src="{{asset('profileimg/' .$userdetails->profile_img)}}" alt="Image Preview">
							@else
							<img src="{{asset('assets/images/user.pn.png')}}" id="imgPreview" alt="">

							@endif
						


							<div class="change-photo-btn">
								<div class="photoUpload">
									<span><i class="fa fa-upload"></i> Upload Photo</span>
									<input type="file" name="profile_img" class="upload" />
								</div>
							</div>
						</div>

						<!-- Details -->
						<div class="my-profile">



							<input type="hidden" name="editid" id="" value="{{$userdetails->id}}">
							<label>Your Name</label>
							<input value="{{$userdetails->name}}" type="text" name="name" placeholder="Enter name">

							<label>Title</label>
							<input value="{{$userdetails->title}}" type="text" name="title" placeholder="Enter title">
                             
							<label>Address</label>
							<input value="{{$userdetails->address}}" type="text" name="address" placeholder="Enter address">

							<label>Tage</label>
							<input value="{{$userdetails->tage}}" type="text" name="tage" placeholder="Enter tage">

							<label>Description</label>
							<textarea name="description" id="notes" cols="5" rows="5">{{$userdetails->description}}</textarea>
						</div>

						<button class="button margin-top-15">Changes</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Change Password -->
		<div class="col-lg-6 col-md-12">
			<div class="dashboard-list-box margin-top-0">
				<h4 class="gray">Social Details</h4>
				<div class="dashboard-list-box-static">
					<form action="{{route('storesocial')}}" id="changepassword" method="post">
						@csrf
						<input type="hidden" name="editid" id="" value="{{$userdetails->id}}">
						<!-- Change Password -->
						<div class="my-profile">
				
						<label>Phone</label>
							<input value="{{$userdetails->moblie_no}}" type="text" name="moblie_no" placeholder="Enter Phone Number">

							<label>Email</label>
							<input value="{{$userdetails->email}}" type="text" name="email" placeholder="Enter Email">

							
							<label><i class="fa fa-twitter"></i> Twitter</label>
							<input placeholder="Enter twitter link" type="text" value="{{$userdetails->twitter_link}}" name="twitter_link">

							<label><i class="fa fa-facebook-square"></i> Facebook</label>
							<input placeholder="Enter Facebook link" type="text" value="{{$userdetails->facebook_link}}" name="facebook_link">

							<label><i class="fa fa-google-plus"></i> Google+</label>
							<input placeholder="Enter Google+ link"  type="text" value="{{$userdetails->google_link}}" name="google_link">

							<label><i class="fa fa-linkedin"></i> Linkedin Link</label>
							<input placeholder="Enter Linkedin Link "  type="text" value="{{$userdetails->linkedin_link}}" name="linkedin_link">
							<button class="button margin-top-15" type="submit">Change</button>
						</div>
					</form>
				</div>
			</div>
		</div>


		@endsection
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			// Wait for the DOM to be ready
			$(document).ready(function() {
				// Attach the change event handler to the input field
				$('input[name=profile_img]').change(function() {
					const file = this.files[0];
					if (file) {
						let reader = new FileReader();
						reader.onload = function(event) {
							// Set the preview image source
							$('#imgPreview').attr('src', event.target.result);
						}
						// Read the selected file as a data URL
						reader.readAsDataURL(file);
					}
				});
			});
		</script>
		