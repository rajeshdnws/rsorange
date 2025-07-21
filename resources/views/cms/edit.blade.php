@extends('admin.layouts.master')
@section('title') Edit Profile Setting @endsection 
 @section('admin-content')

<div class="container mt-5">
    <h2>Edit CMS Page</h2>
    <form action="{{ route('cms-pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="form-group mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
        </div>

        <!-- Alias -->
        <div class="form-group mb-3">
            <label>Alias</label>
            <input type="text" name="alias" class="form-control" value="{{ old('alias', $page->alias) }}" required>
        </div>

        <!-- Status -->
        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $page->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$page->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Banner -->
        <div class="form-group mb-3">
            <label>Banner Image</label><br>
            @if($page->banner)
                <img src="{{ asset('storage/' . $page->banner) }}" width="100"><br>
            @endif
            <input type="file" name="banner" class="form-control mt-2">
        </div>

        <!-- Content -->
        <div class="form-group mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="5">{{ old('content', $page->content) }}</textarea>
        </div>

        <!-- Meta Info -->
        <div class="form-group mb-3">
            <label>Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title) }}">
        </div>

        <div class="form-group mb-3">
            <label>Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description', $page->meta_description) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label>Meta Keyword</label>
            <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword', $page->meta_keyword) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Page</button>
    </form>
</div>
@endsection
