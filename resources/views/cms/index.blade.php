@extends('admin.layouts.master')
@section('title') Edit Profile Setting @endsection

@section('admin-content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">CMS/</span>All CMS Pages</h4>
        <a href="{{ route('cms-pages.create') }}" class="btn add-page">+ Add New Page</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     <div class="table-responsive rounded shadow">
    <table class="table table-bordered table-striped">
        <thead class="table-dark cms-table-header">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Alias</th>
                <th>Status</th>
                <th>Banner</th>
                <th nowrap>Meta Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $index => $page)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->alias }}</td>
                    <td>
                        <span class="badge {{ $page->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $page->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
    @if($page->banner)
        <img src="{{ asset('storage/' . $page->banner) }}" alt="Banner" width="80" height="50" style="object-fit: cover;">
    @else
        <span class="text-muted">N/A</span>
    @endif
</td>
                    <td>{{ $page->meta_title ?? 'N/A' }}</td>
                   <td>
    <a href="{{ route('cms-pages.edit', $page->id) }}" class="btn btn-sm btn-primary">Edit</a>
    
    <form action="{{ route('cms-pages.destroy', $page->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">Delete</button>
    </form>
</td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-dark">No pages found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>
@endsection
