@extends('admin.layouts.master')
@section('title') Edit Profile Setting @endsection

@section('admin-content')
<!-- page title area end -->			
  <div class="container-xxl flex-grow-1 container-p-y">
  
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span> Profile Edit</h4>
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-12">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Profile</h5>
					  
                    </div>
					
					
					
                    <div class="card-body">
			   @include('admin.layouts.partials.messages')
			
                <form action="{{ route('update.profile') }}" class="p-3 modal-form" method="POST" autocomplete="off">
                    @method('PUT')
                    @csrf
				    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fist Name <span class="asterisk">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{old('first_name', $profile->first_name)}}"  maxlength="50" placeholder="Enter first name">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name <span class="asterisk">*</span></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{old('last_name', $profile->last_name)}}" maxlength="50" placeholder="Enter last name">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  						
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control" value="{{$profile->email}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{$profile->username}}" readonly>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <a class="btn btn-secondary me-2" href="{{route('admin.dashboard')}}">Cancel</a>
				            <button type="submit" class="btn btn-primary">Update</button>
						</div>
					</div>
                </form>
	          </div>
                  </div>
                </div>
               
                </div>
              </div>
@endsection
