@extends('backend.layouts.master')
@section('title') Edit Password @endsection

@section('admin-content')
<!-- page title area end -->			
<div class="bg-white p-4 mb-5">
    <div class="bg-white rounded-1">
        @include('backend.layouts.partials.messages')
        <div class="card">
            <div class="card-header bg-dark">
                <span class="text-white h6 fw-normal">Edit Password</span>
            </div>
            <div>	
                <form action="{{ route('admin.update.password') }}" class="p-3 modal-form" method="POST" autocomplete="off">
                    @method('PUT')
                    @csrf
				    <div class="row">  						
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="control-copy-paste form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password"  minlength="6" maxlength="15" placeholder="Enter current password" autocomplete="new-password">
                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="control-copy-paste form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="6" maxlength="15" placeholder="Enter new password" autocomplete="new-password">
                                <span toggle="#password" class="bi bi-eye password-field-icon toggle-password"></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>   
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="control-copy-paste form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" minlength="6" maxlength="15" placeholder="Enter new password again"  autocomplete="new-password">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <a class="btn btn-secondary me-2" href="{{route('admin.dashboard')}}">Cancel</a>
				            <button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
                </form>
                <!-- data table end -->
        
            </div>
        </div>
    </div>
</div>
@endsection
