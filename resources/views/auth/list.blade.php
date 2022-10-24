@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users List') }}</div>

                <div class="card-body" style="display:flex;flex-wrap: wrap">
                    @foreach($users as $id=>$user)
                    <a class="user-row" style="margin-bottom: 10px" href="{{ route('users.profile') . '/' . $user->id  }}">
                        <span>{{$id}}</span>-<span>{{$user->name . ' (' . $user->username . ')'}}</span>-<span>{{ $user->role == 1 ? 'User':'Administrator' }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
