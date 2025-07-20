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
<div class="bg-white p-4 mb-5">
    <div class="bg-white rounded-1">
        <div class="card">
            <div class="card-header bg-dark">
                <span class="text-white h6 fw-normal">Create New Staff</span>
            </div>
            <div>     
                             
                <form action="https://dev.littlesteps.sg/admin/staffs" class="p-3 modal-form" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" value="Tr8xFK6b6hHg5cOzQHlDsVqn43I3qKkly8i3mTQ5" autocomplete="off">				    <div class="row">
                        <div class="col-md-6">
                             <div class="mb-3">
                                <label class="form-label">First Name <span class="asterisk">*</span></label>
                                <input type="text" class="form-control " id="first_name" value="" name="first_name" placeholder="Enter First Name">
								
                            </div>
                        </div>  

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name<span class="asterisk">*</span></label>
                                <input type="text" class="form-control " id="last_name" name="last_name" value="" placeholder="Enter Last Name">
								
                            </div>
                        </div>  						
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Staff Email<span class="asterisk">*</span></label>
                                <input type="email" class="form-control " value="" id="email" name="email" placeholder="Enter Email">
								                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <div class="mb-3">
                                <label for="username">Username<span class="asterisk">*</span></label>
                                <input type="text" class="form-control " id="username" value="" name="username" placeholder="Enter Username">
                                                            </div>
                        </div>
						
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password<span class="asterisk">*</span></label>
                                <input type="password" class="control-copy-paste form-control " id="password" value="" name="password" placeholder="Enter Password" autocomplete="new-password">
                                <span toggle="#password" class="bi bi-eye password-field-icon toggle-password"></span>
								                            </div>
                        </div>   
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Confirm Password<span class="asterisk">*</span></label>
                                <input type="password" class="control-copy-paste form-control " value="" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
									                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="roles mb-3">Assign Roles<span class="asterisk">*</span></label>
                                <select name="roles" id="roles" class="form-select mt-2 ">
								<option value="">Select Role</option>
                                                                            <option value="10">role for staff</option>
                                                                            <option value="11">Ops Team</option>
                                                                    </select>
							                                </div>
						</div>
                        <div class="col-md-6">
                            <div class="mb-3">
    							<label for="report_to">Department</label>
                            <select name="department_id" id="department_id" class="form-select mt-2 ">
								<option value="">Select Department</option>
                                                                    </select>
							                                  <input type="hidden" class="form-control" id="organization" name="organization" value="2">
                            </div>
						</div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reported_to">Report To</label>
                                <select name="reported_to" id="reported_to" class="form-select ">
                                <option value="">Select Report To</option>
                                                                         <option value="19">test1 test  test1@sp.com</option>
                                                                            <option value="20">test2 test  test2@sp.com</option>
                                                                  </select>
                                                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="is_active" id="is_active">
                                                                            <option value="yes" selected="">
                                            ACTIVE
                                        </option>
                                                                            <option value="no">
                                            INACTIVE
                                        </option>
                                                                    </select>
                            </div>
                        </div>
                        <div class="col-12 text-end">
				            <a class="btn btn-secondary me-2" href="https://dev.littlesteps.sg/admin/staffs">Cancel</a>
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
                </div>
               
                </div>
              </div>
@endsection
