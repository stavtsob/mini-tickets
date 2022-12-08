@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                <a href="?status_filter=3"  class="stats-item {{ $statusFilter == 3 ? 'selected':''}}" >
                    <div class="stat-number" style="position: relative;">
                        <span style="position: relative;">
                            {{$closedTickets}}
                            <img  src="{{ asset('images/xmas-hat.png') }}" style="position: absolute;width:54px; top: -25px; right: -28px;rotate: 15deg">
                        </span>
                    </div>
                    <div>
                        tickets <b style="color:rgb(205, 76, 76);">{{__('general.closed_small')}}</b>.
                    </div>
                </a>
            </div>
            <div class="card">
                <div class="card-header">{{__('general.dashboard')}}</div>

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
