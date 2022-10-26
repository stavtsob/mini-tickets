@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ (Auth::user()->role != 2 && Auth::user()->id != $user->id) ? '': route('users.update', $user->id)}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="role" aria-label="Role" class="form-control @error('role') is-invalid @enderror" {{ Auth::user()->role != 2 ? 'disabled':''}}>
                                    <option value=1 {{ $user->role == 1 ? 'selected':''}}>User</option>
                                    <option value=2 {{ $user->role == 2 ? 'selected':''}}>Administrator</option>
                                  </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $user->email}}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"  value="{{ $user->username }}"  autocomplete="username" disabled>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="{{ (Auth::user()->role != 2 && Auth::user()->id != $user->id) ? 'display:none;' : ''}}">
                                    {{ __('Update profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @if(Auth::user()->role == 2)
                    <form method="POST" action="{{ route('users.delete', ['user-id'=>$user->id]) }}" style="margin-top: 10px;">
                        @csrf
                        <input name="user-id" type="hidden" value="{{ $user->id }}">
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger" style="{{ (Auth::user()->role != 2 && Auth::user()->id != $user->id) ? 'display:none;' : ''}}">
                                    {{ __('Delete user') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
            @if(Auth::user()->id == $user->id || Auth::user()->role == 2)
            <div class="card" style="margin-top: 20px;">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.change_password') }}">
                        @csrf
                        <input name="user-id" type="hidden" value="{{ $user->id }}">
                        @if(Auth::user()->role != 2 || Auth::user()->id == $user->id)
                        <div class="row mb-3">
                            <label for="old-password" class="col-md-4 col-form-label text-md-end">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="old-password" type="password" class="form-control @error('old-password') is-invalid @enderror" name="old-password" required autocomplete="old-password">
                                @error('old-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Chage password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
