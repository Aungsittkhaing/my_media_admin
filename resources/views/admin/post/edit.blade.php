@extends('admin.layouts.app')
@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-header text-black-50">
                <div class="card-title">Edit Post</div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.updatePost', $postDetail->post_id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Post Name</label>
                        <input type="text" value="{{ old('postName', $postDetail->title) }}" name="postName"
                            class="form-control @error('postName') is-invalid
                        @enderror"
                            placeholder="Enter Post Name...">
                        @error('postName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('postDescription') is-invalid @enderror" name="postDescription" rows="6"
                            placeholder="Enter Description...">{{ old('postDescription', $postDetail->description) }}</textarea>
                        @error('postDescription')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label><br>
                        {{-- <input type="file" name="imageName" value="{{ old('imageName') }}" class="form-control"
                            placeholder="Enter Image..."> --}}

                        <img width="100%" class="rounded shadow"
                            @if ($postDetail->image == null) src="{{ asset('defaultImage/default.png') }}"
                                        @else
                                        src="{{ asset('postImage/' . $postDetail->image) }}" @endif>
                        <input type="file" class="form-control" name="imageName">
                    </div>
                    <div class="mb-3">
                        <label for="postCategory" class="form-label">Cateogry Name</label>
                        <select name="postCategory"
                            class="form-control @error('postCategory') is-invalid
                        @enderror">
                            <option value="">Choose Category</option>
                            @foreach ($category as $product)
                                <option value="{{ $product->category_id }}"
                                    @if ($product->category_id == $postDetail->category_id) selected @endif>{{ $product->title }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-warning" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Post Lists</h3>
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
            @if (Session::has('postSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('postSuccess') }}
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
                            <th>Post_ID</th>
                            <th>Post Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $product)
                            <tr>
                                <td>{{ $product->post_id }}</td>
                                <td>{{ $product->title }}</td>
                                <td><img class="rounded shadow-sm" width="100px"
                                        @if ($product->image == null) src="{{ asset('defaultImage/default.png') }}"
                                        @else
                                        src="{{ asset('postImage/' . $product->image) }}" @endif>
                                </td>
                                <td>
                                    <a href="{{ route('admin.updatePostEdit', $product->post_id) }}"
                                        class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.deletePost', $product->post_id) }}"
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
