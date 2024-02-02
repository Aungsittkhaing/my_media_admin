@extends('admin.layouts.app')
@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-header text-black-50">
                <div class="card-title">Edit Category</div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categoryUpdate', $updateCategory->category_id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryTitle" class="form-label">Category Name</label>
                        <input type="text" name="categoryName"
                            class="form-control @error('categoryName') is-invalid
                        @enderror"
                            value="{{ old('categoryName', $updateCategory->title) }}" placeholder="Enter Category Name">
                        @error('categoryName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('categoryDescription') is-invalid @enderror" name="categoryDescription"
                            rows="6" placeholder="Enter Description">{{ old('categoryDescription', $updateCategory->description) }}</textarea>
                        @error('categoryDescription')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-warning" type="submit">Update</button>
                    <a href="{{ route('admin.createCategory') }}" class="btn btn-primary">Create</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-gray">Category Lists</div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Category_ID</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $product)
                            <tr>
                                <td>{{ $product->category_id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <a href="{{ route('admin.categoryEditPage', $product->category_id) }}"
                                        class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.deleteCategory', $product->category_id) }}"
                                        class="btn btn-sm bg-danger text-white"
                                        onclick="return confirm('Are you sure to delete?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
@endsection
