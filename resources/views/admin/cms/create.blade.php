{{-- resources/views/cms/create.blade.php --}}

@extends('admin.layouts.master')

@section('title') {{ isset($page) ? 'Edit CMS Page' : 'Create CMS Page' }} @endsection

@section('admin-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">CMS /</span>
        {{ isset($page) ? 'Edit Page' : 'Create Page' }}
    </h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header bg-orenge mb-3">
                    <span class="text-white h5 fw-normal">{{ isset($page) ? 'Edit Page' : 'Create New Page' }}</span>
                </div>
                <div class="card-body">
                    <form action="{{ isset($page) ? route('cms-pages.update', $page->id) : route('cms-pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($page))
                            @method('PUT')
                        @endif

                       <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label class="form-label">Title <span class="asterisk">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $page->title ?? '') }}" required>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 mb-3">
                                <label class="form-label">Status <span class="asterisk">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                <option value="1" {{ old('status', $page->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $page->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        
                               
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alias <span class="asterisk">*</span></label>
                                <input type="text" class="form-control @error('alias') is-invalid @enderror" name="alias" value="{{ old('alias', $page->alias ?? '') }}" required>
                                @error('alias') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                        <div class="row">
                                {{-- Left: Content --}}
                                <div class="col-md-8 col-sm-12 mb-3">
                                    <!-- <label class="form-label">Content</label>
                                     <div class="mb-3"> -->
    <label class="form-label">Content</label>

    <!-- Toolbar -->
    <div class="toolbar mb-2">
        <select onchange="execCmdWithArg('formatBlock', this.value)">
            <option value="p">Normal</option>
            <option value="h1">Heading 1</option>
            <option value="h2">Heading 2</option>
            <option value="h3">Heading 3</option>
        </select>

        <select onchange="execCmdWithArg('fontName', this.value)">
            <option value="Arial">Arial</option>
            <option value="Georgia">Georgia</option>
            <option value="Verdana">Verdana</option>
            <option value="Times New Roman">Times New Roman</option>
        </select>

        <select onchange="execCmdWithArg('fontSize', this.value)">
            <option value="1">Small</option>
            <option value="3" selected>Normal</option>
            <option value="5">Large</option>
            <option value="7">Huge</option>
        </select>

        <input type="color" onchange="execCmdWithArg('foreColor', this.value)" title="Text Color">
        <input type="color" onchange="execCmdWithArg('hiliteColor', this.value)" title="Highlight">

        <button type="button" onclick="execCmd('bold')"><b>B</b></button>
        <button type="button" onclick="execCmd('italic')"><i>I</i></button>
        <button type="button" onclick="execCmd('underline')"><u>U</u></button>

        <button type="button" onclick="execCmd('insertUnorderedList')">• Bullet</button>

        <button type="button" onclick="execCmdWithArg('justifyLeft')">Left</button>
        <button type="button" onclick="execCmdWithArg('justifyCenter')">Center</button>
        <button type="button" onclick="execCmdWithArg('justifyRight')">Right</button>
    </div>

    <!-- Editor -->
    <div id="editor" contenteditable="true" style="border:1px solid #ccc; padding:10px; min-height:250px;">
        {!! old('content', $page->content ?? '') !!}
    </div>

    <!-- Hidden input for saving content -->
    <input type="hidden" name="content" id="content">
                                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Right: Banner --}}
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label class="form-label">Banner Image</label><br>
                                    @if(isset($page) && $page->banner)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $page->banner) }}" alt="Banner Preview" class="img-fluid rounded" style="max-height: 180px;">
                                        </div>
                                    @endif
                                    <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror">
                                    @error('banner') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>


                       <div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}">
            @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="1">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
            @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Meta Keyword</label>
            <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" value="{{ old('meta_keyword', $page->meta_keyword ?? '') }}">
            @error('meta_keyword') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

                        <div class="text-end">
                            <a class="btn btn-secondary me-2" href="{{ route('cms-pages.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($page) ? 'Update' : 'Create' }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
