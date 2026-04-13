@extends('admin.layouts.master')

@section('title') {{ isset($banner) ? 'Edit Banner' : 'Create Banner' }} @endsection

@section('admin-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Banner /</span>
        {{ isset($banner) ? 'Edit' : 'Create' }}
    </h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header bg-dark">
                    <span class="text-white h5 fw-normal">{{ isset($banner) ? 'Edit Banner' : 'Create New Banner' }}</span>
                </div>
                <div class="card-body">
                    <form action="{{ isset($banner) ? route('banner.update', $banner->id) : route('banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($banner)) @method('PUT') @endif

                        {{-- Row 1: Type & Slug --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Banner Type <span class="asterisk">*</span></label>
                                <select name="type" class="form-select" id="bannerType" required>
                                    <option value="banner" {{ old('type', $banner->type ?? '') == 'banner' ? 'selected' : '' }}>Banner</option>
                                    <option value="slider" {{ old('type', $banner->type ?? '') == 'slider' ? 'selected' : '' }}>Slider</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Slug <span class="asterisk">*</span></label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug', $banner->slug ?? '') }}" required>
                            </div>
                        </div>

                        {{-- Row 2: Title & Active --}}
                        <div class="row" id="singleRow1">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Active</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ old('is_active', $banner->is_active ?? 1) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('is_active', $banner->is_active ?? 1) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        {{-- Row 3: Description & Image --}}
                        <div class="row" id="singleRow2">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="5" style="min-height: 120px;">{{ old('description', $banner->description ?? '') }}</textarea>

                            </div>
                            <div class="col-md-6 mb-3">
                                  <label class="form-label">Image</label><br>
                                    @if(isset($banner) && $banner->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('uploads/banners/' . $banner->image) }}" class="img-fluid rounded" style="max-height: 180px;" id="singlePreviewOld">
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control" onchange="previewImage(event, 'singlePreview')">
                                    <div class="mt-2">
                                        <img id="singlePreview" style="max-height: 180px; display: none;" class="img-fluid rounded" />
                                    </div>

                                    
                            </div>
                        </div>

                        {{-- Slider Fields --}}
                        <div id="sliderFields" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Number of Slides</label>
                                    <input type="number" class="form-control" id="sliderCount" min="1" max="10">
                                </div>
                                <div class="col-md-6 mb-3" id="sliderActiveField">
                                    <label class="form-label">Active</label>
                                    <select name="is_active" class="form-select">
                                        <option value="1" {{ old('is_active', $banner->is_active ?? 1) == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_active', $banner->is_active ?? 1) == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <div id="sliderInputs"></div>
                        </div>

                        {{-- Hidden Fields for Slider --}}

                        <div class="text-end">
                            <a class="btn btn-secondary me-2" href="{{ route('banner.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($banner) ? 'Update' : 'Create' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript to show/hide fields --}}
{{-- JavaScript to show/hide fields and preview images --}}
<script>
    function toggleFields(type) {
        const isBanner = type === 'banner';
        document.getElementById('singleRow1').style.display = isBanner ? 'flex' : 'none';
        document.getElementById('singleRow2').style.display = isBanner ? 'flex' : 'none';
        document.getElementById('sliderFields').style.display = !isBanner ? 'block' : 'none';
    }

    function previewImage(event, previewId) {
        const reader = new FileReader();
        const preview = document.getElementById(previewId);

        reader.onload = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
        };

        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('bannerType');
        toggleFields(typeSelect.value);

        typeSelect.addEventListener('change', function () {
            toggleFields(this.value);
        });

        document.getElementById('sliderCount')?.addEventListener('input', function () {
            const count = parseInt(this.value);
            const container = document.getElementById('sliderInputs');
            container.innerHTML = '';

            for (let i = 0; i < count; i++) {
                container.innerHTML += `
                    <div class="card p-3 mb-3">
                        <h6>Slide ${i + 1}</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Title</label>
                                <input type="text" name="slider_data[${i}][title]" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Description</label>
                                <textarea name="slider_data[${i}][description]" class="form-control" style="min-height: 120px;"></textarea>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label>Image</label>
                            <input type="file" name="slider_data[${i}][image]" class="form-control" onchange="previewImage(event, 'sliderPreview${i}')">
                            <div class="mt-2">
                                <img id="sliderPreview${i}" style="max-height: 180px; display: none;" class="img-fluid rounded" />
                            </div>
                        </div>
                    </div>
                `;
            }
        });
    });
</script>

@endsection
