{{-- resources/views/admin/profile/admin.blade.php --}}

@extends('admin.layouts.master')

@section('title') Create New Admin @endsection

@section('admin-content')
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span> Create New Add</h4>
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-12">
                    <div class="bg-white rounded-1">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <span class="text-white h5
                                 fw-normal">Create New User</span>
                            </div>
                            <div>
                             

								{{-- Form for creating a new admin --}}
								<form action="{{ $admin->id ? route('user.update', $admin->id) : route('user.store') }}" class="p-3 modal-form" method="POST" autocomplete="off">
								@if($admin->id)
								@method('PUT')
								@endif
                                    @csrf {{-- CSRF token for security --}}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name <span class="asterisk">*</span></label>
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{old('first_name', $admin->first_name)}}" name="first_name" placeholder="Enter First Name" required>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name<span class="asterisk">*</span></label>
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Staff Email<span class="asterisk">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="Enter Email" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6">
                                            <div class="mb-3">
                                                <label for="username">Username</label> {{-- Username is nullable in controller validation --}}
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" name="username" placeholder="Enter Username">
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Password<span class="asterisk">*</span></label>
                                                <input type="password" class="control-copy-paste form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" autocomplete="new-password" required>
                                                <span toggle="#password" class="bi bi-eye password-field-icon toggle-password"></span>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password<span class="asterisk">*</span></label>
                                                <input type="password" class="control-copy-paste form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-select @error('is_active') is-invalid @enderror" name="is_active" id="is_active" required>
                                                    <option value="yes" {{ old('is_active') == 'yes' ? 'selected' : '' }}>ACTIVE</option>
                                                    <option value="no" {{ old('is_active') == 'no' ? 'selected' : '' }}>INACTIVE</option>
                                                </select>
                                                @error('is_active')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 text-end">
                                            <a class="btn btn-secondary me-2" href="{{ route('admin.dashboard') }}">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
