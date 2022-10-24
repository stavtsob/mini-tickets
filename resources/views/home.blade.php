@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="statistics">
                <div class="stats-item">
                    <div class="stat-number" >
                        {{$openTickets}}
                    </div>
                    <div>
                        tickets <b>open</b>
                    </div>
                </div>
                <div class="stats-item">
                    <div class="stat-number">
                        {{$inProgressTickets}}
                    </div>
                    <div>
                        tickets <b>in-progress</b>
                    </div>
                </div>
                <div class="stats-item">
                    <div class="stat-number">
                        {{$openTickets + $inProgressTickets}}
                    </div>
                    <div>
                        tickets <b>total</b>.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('tickets.list')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
