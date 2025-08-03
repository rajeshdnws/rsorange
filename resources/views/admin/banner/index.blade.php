@extends('admin.layouts.master')
@section('title') Edit Profile Setting @endsection

@section('admin-content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="fw-bold py-3"><span class="text-muted fw-light">CMS/</span>All Banner And Sliders</h4>
        <a href="{{ route('banner.create') }}" class="btn add-page">+ Add New Page</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     <div class="table-responsive rounded shadow">
    <table class="table cms-table-header table-bordered table-striped">
        <thead class="table-dark ">
            <tr>
                <th>#</th>
                 <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @forelse($banners as $banner)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $banner->title }}</td>
                    <td>{{ ucfirst($banner->type) }}</td>
                    <td><a href="{{ route('banner.toggle', $banner->id) }}">
                        {{ $banner->is_active ? 'Active' : 'Inactive' }}
                        </a>
                    </td>                    
                    <td><img src="{{ asset('uploads/banners/'.$banner->image) }}" width="100"></td>

                    
                   <td><a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-sm btn-primary">Edit</a>
    
                   <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
