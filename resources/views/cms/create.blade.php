{{-- resources/views/cms/create.blade.php --}}
@extends('admin.layouts.master')
@section('admin-content')
 <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">CMS/</span> Create CMS Page</h4>
    <div class="row">
        <!-- Basic Layout -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <span class="text-white h5
                                 fw-normal">Create CMS Page</span>
                            </div>
                                <form action="{{ route('cms-pages.store') }}" class="p-3 modal-form" method="POST">
                                   @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Title <span class="asterisk">*</span></label>
                                                <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Alias<span class="asterisk">*</span></label>
                                                <input type="text" class="form-control" name="alias" placeholder="Enter Alias" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status<span class="asterisk">*</span></label>
                                               <select class="form-select cursor" name="status" required>
                                                    <option value="1">ACTIVE</option>
                                                    <option value="0">INACTIVE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="banner">Banner</label>
                                                <input type="file" class="form-control" name="banner" placeholder="Enter Banner" required>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Content<span class="asterisk">*</span></label>
                                                <input type="text" class="form-control" name="content" placeholder="Enter Content" required>
                                            </div>
                                        </div>
                                            <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Meta Title<span class="asterisk">*</span></label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta Title" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Meta Description<span class="asterisk">*</span></label>
                                                <input type="text" class="form-control" name="meta_keyword" placeholder="Enter Meta Description" required>
                                            </div>
                                        </div>
                                            <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Meta Keyword<span class="asterisk">*</span></label>
                                                <input type="text" class="form-control" name="meta_keyword" placeholder="Enter Meta Keyword" required>
                                            </div>
                                        </div>
                                        <div class="col-12 text-end">
                                            <a class="btn btn-secondary me-2" href="{{ route('admin.dashboard') }}">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    @endsection