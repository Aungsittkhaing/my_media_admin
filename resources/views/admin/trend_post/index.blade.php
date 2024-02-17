@extends('admin.layouts.app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trend Post Lists</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Image</th>
                            <th>View Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($post as $product)
                            <tr>
                                <td>{{ $product->post_id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>
                                    <img class="rounded shadow-sm" width="100px"
                                         @if ($product->image == null) src="{{ asset('defaultImage/default.png') }}"
                                         @else
                                         src="{{ asset('postImage/' . $product->image) }}" @endif>
                                </td>
                                <td><i class="fas fa-eye"></i>{{ $product->post_count }}</td>
                                <td>
                                    <a href="{{ route('admin.trendPostDetails', $product->post_id) }}" class="btn btn-sm bg-dark text-white"><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
{{--                {{ $post->links() }}--}}

            </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
