@extends('backend.layouts.master')
@section('title') {{ $admin->id ? 'Edit' : 'Create New' }} Admin @endsection

@section('admin-content')
<!-- page title area end -->			
<div class="bg-white p-4 mb-5">
    <div class="bg-white rounded-1">
        @include('backend.layouts.partials.messages')
        <div class="card">
            <div class="card-header bg-dark">
                <span class="text-white h6 fw-normal">{{ $admin->id ? 'Edit' : 'Create New' }} Admin </span>
            </div>
            <div>	
                <form action="{{ $admin->id ? route('admin.admins.update', $admin->id) : route('admin.admins.store') }}" class="p-3 modal-form" method="POST" autocomplete="off">
                   @if($admin->id)
                        @method('PUT')
                    @endif
                    @csrf
				    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fist Name <span class="asterisk">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{old('first_name', $admin->first_name)}}"  maxlength="50" placeholder="Enter first name">
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
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{old('last_name', $admin->last_name)}}" maxlength="50" placeholder="Enter last name">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  						
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email Address<span class="asterisk">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $admin->email)}}" maxlength="200" placeholder="Enter email address">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{old('username', $admin->username)}}" maxlength="200" placeholder="Enter username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')}}" minlength="6" maxlength="15" placeholder="Enter password" autocomplete="new-password">
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
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" minlength="6" maxlength="15" placeholder="Enter password again"  autocomplete="new-password">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
                                   @foreach(Helper::$status_label as $value => $label)
                                        <option value="{{$value}}"  @selected($value== old('is_active', $admin->is_active ?? Helper::$status_yes))>
                                            {{$label}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <a class="btn btn-secondary me-2" href="{{route('admin.admins.index')}}">Cancel</a>
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
