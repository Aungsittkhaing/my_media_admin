@extends('admin.layouts.app')
@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Admin Profile</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert start --}}
                            @if (Session::has('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('updateSuccess') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}
                            <form class="form-horizontal" method="post" action="{{ route('admin.update') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="adminName" value="{{ old('adminName', $user->name) }}"
                                            class="form-control @error('adminName') is-invalid
                                            @enderror"
                                            placeholder="Enter your name...">

                                        {{-- @if ($errors->has('adminName'))
                                            <p>{{ $errors->first('adminName') }}</p>
                                        @endif --}}

                                        @error('adminName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="adminEmail"
                                            value="{{ old('adminEmail', $user->email) }}"
                                            class="form-control @error('adminEmail')
                                                is-invalid
                                            @enderror"
                                            id="inputEmail" placeholder="Enter your email...">
                                        @error('adminEmail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="adminPhone" value="{{ $user->phone }}"
                                            class="form-control" id="inputPhone" placeholder="Enter your phone number...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="adminAddress" class="form-control" cols="30" rows="10" placeholder="Enter your address...">{{ $user->address }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="adminGender">
                                            @if ($user->gender == 'male')
                                                <option value="Empty">Choose Gender</option>
                                                <option value="male" selected>Male</option>
                                                <option value="female">Female</option>
                                            @elseif ($user->gender == 'female')
                                                <option value="Empty">Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female" selected>Female</option>
                                            @else
                                                <option value="Empty" selected>Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Update</button>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{ route('admin.changepassword') }}">Change Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
