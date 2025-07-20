@extends('admin.layouts.master')
@section('title') Edit Profile Setting @endsection

@section('admin-content')
<!-- page title area end -->			
  <div class="container-xxl flex-grow-1 container-p-y">
  
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span> User List</h4>
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-12">
                    <!-- <div class="card-header d-flex align-items-center justify-content-between">
                    @include('admin.layouts.partials.messages')
					  
                    </div> -->
				
			     <div class="card">
                    <div class="d-flex justify-content-between align-items-center">
                      <h4 class="mb-0 card-header text-dark">Admin user List</h4>
                      <a class="btn fs-5 p-0 mx-2" href="{{ route('admin.new') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-html="true" data-bs-original-title="Add New Admin">
                        <i class="bi bi-person-add fs-3 text-dark"></i>
                    </a>
                    </div>
                <div class="table-responsive user-list text-nowrap">
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>UserName</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($admins as $admin)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$admin->first_name}}</strong></td>
                     
                        <td>{{$admin->last_name}}</td>
                        <td>
                         {{$admin->email}}
                        </td>
                        <td>{{$admin->username}}</td>
                        <td><span class="badge bg-label-primary me-1">{{$admin?->is_active=='no' ? 'Inactive':'Active'}}</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                     
                    </tbody>
                  </table>
                </div>
              </div>
                  </div>
                </div>
               
                </div>
              </div>
@endsection
