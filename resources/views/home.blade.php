@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="statistics">
                <a href="?status_filter=1" class="stats-item {{ $statusFilter == 1 ? 'selected':''}}">
                    <div class="stat-number" >
                        {{$openTickets}}
                    </div>
                    <div>
                        tickets <b>{{__('general.open')}}</b>
                    </div>
                </a>
                <a href="?status_filter=2"  class="stats-item {{ $statusFilter == 2 ? 'selected':''}}">
                    <div class="stat-number">
                        {{$inProgressTickets}}
                    </div>
                    <div>
                        tickets <b>{{__('general.in-progress')}}</b>
                    </div>
                </a>
                <a href="?status_filter=0"  class="stats-item {{ $statusFilter == 0 ? 'selected':''}}">
                    <div class="stat-number">
                        {{$openTickets + $inProgressTickets}}
                    </div>
                    <div>
                        tickets <b>{{__('general.total')}}</b>.
                    </div>
                </a>
            </div>
            <div class="card">
                <div class="card-header">{{__('general.dashboard')}}</div>

                <div class="card-body" style="display: flex;flex-wrap:wrap">
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
