@extends('admin.layouts.app')
@section('content')
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admin Lists</h3>
                @if (request()->has('keyword'))
                    [Search result by '{{ request()->keyword }}']
                @endif
                <div class="card-tools">
                    <form action="{{ route('admin.listSearch') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="adminSearchKey" class="form-control float-right"
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
            @if (Session::has('deleteSuccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('deleteSuccess') }}
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
                            <th>User_ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userData as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>
                                    @if (auth()->user()->id != $user->id)
                                        <a @if (count($userData) == 1) href="#"
                                    @else
                                    href="{{ route('admin.accountDelete', $user->id) }}" @endif
                                            class="btn btn-sm bg-danger text-white"
                                            onclick="return confirm('Are you sure to delete?')"><i
                                                class="fas fa-trash-alt"></i></a>
                                    @endif

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
