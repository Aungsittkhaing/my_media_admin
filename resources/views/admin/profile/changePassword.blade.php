@extends('admin.layouts.app')
@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert start --}}
                            @if (Session::has('fail'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ Session::get('fail') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}
                            <form class="form-horizontal ps-5" method="post" action="{{ route('admin.passwordchange') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="oldPassword" class="col-3 col-form-label">Old Password</label>
                                    <div class="col-6">
                                        <input type="password" name="oldPassword" value="{{ old('oldPassword') }}"
                                            class="form-control @error('oldPassword') is-invalid
                                            @enderror"
                                            placeholder="Enter your Current Password...">

                                        {{-- @if ($errors->has('adminName'))
                                            <p>{{ $errors->first('adminName') }}</p>
                                        @endif --}}

                                        @error('oldPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-3 col-form-label">New Password</label>
                                    <div class="col-6">
                                        <input type="password" name="newPassword" value="{{ old('newPassword') }}"
                                            class="form-control @error('newPassword')
                                                is-invalid
                                            @enderror"
                                            placeholder="Enter your New Password...">
                                        @error('newPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-3 col-form-label">Confirm Password</label>
                                    <div class="col-6">
                                        <input type="password" name="passwordConfirmation"
                                            value="{{ old('passwordConfirmation') }}"
                                            class="form-control @error('passwordConfirmation')
                                                is-invalid
                                            @enderror"
                                            placeholder="Enter your confirm Password...">
                                        @error('passwordConfirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class=" col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
