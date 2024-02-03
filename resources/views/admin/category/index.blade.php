@extends('admin.layouts.app')
@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-header text-black-50">
                <div class="card-title">Create Category</div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.createCategory') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryTitle" class="form-label">Category Name</label>
                        <input type="text" name="categoryName"
                            class="form-control @error('categoryName') is-invalid
                        @enderror"
                            placeholder="Enter Category Name">
                        @error('categoryName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('categoryDescription') is-invalid @enderror" name="categoryDescription"
                            rows="6" placeholder="Enter Description"></textarea>
                        @error('categoryDescription')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category Lists</h3>
                <div class="card-tools">
                    <form action="{{ route('admin.categorySearch') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="categorySearch" class="form-control float-right"
                                placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- alert start --}}
            @if (Session::has('categorySuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('categorySuccess') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('deleteSuccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('deleteSuccess') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('categoryUpdated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('categoryUpdated') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- alert end --}}
            <!-- /.card-header -->
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
