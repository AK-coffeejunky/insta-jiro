@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        placeholder="Add a category" autofocus>
                    @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Add</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if (session('error_message'))
                <div class="alert alert-danger">
                    {{ session('error_message') }}
                </div>
            @endif
            <table class="table table-hover align-middle">
                <thead class="thead-light table-warning">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Count</th>
                        <th>Last Updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($all_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->category_post_count }}</td>
                            <td>{{ optional($category->updated_at)->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edit-category-{{ $category->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete-category-{{ $category->id }}" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        <tr>

                        </tr>

                        </tr>

                        @include('admin.categories.modals.status')
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No categories found.</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td></td>
                        <td>
                            Uncategorized
                            <div class="fw-light fs-6">
                                <p>Hidden posts are not included.</p>
                            </div>
                        </td>
                        <td>{{ $uncategorized_count ?? 0 }}</td>
                        <td>-</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
