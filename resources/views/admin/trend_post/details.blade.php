@extends('admin.layouts.app')
@section('content')
    <div class="col-6 offset-3 mt-5">
            <h3>
                <i class="fas fa-arrow-left text-dark" onclick="history.back()"></i>
            </h3>
            <div class="card-header">
                <div class="text-center">
                    <img class="rounded shadow-sm" width="450px"
                         @if ($post->image == null) src="{{ asset('defaultImage/default.png') }}"
                         @else
                         src="{{ asset('postImage/' . $post->image) }}" @endif>
                </div>
            </div>
            <div class="card-body">
                <h3 class="text-center">{{$post->title}}</h3>
                <p class="text-start">{{ $post->description }}</p>
            </div>
        <!-- /.card -->
    </div>
@endsection
