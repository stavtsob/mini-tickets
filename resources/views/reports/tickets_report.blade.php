@extends('layouts.app')

@section('content')

<div class="filters no-print">
    <div class="container">
        <div class="col-md-4">
            <form method="GET">
                <div class="input-group mb-3">
                    <label class="form-label">{{__('general.from_date')}}</label>
                    <input class="form-control" type="date" name="from_date">
                </div>
                <div class="input-group mb-3">
                    <label class="form-label">{{__('general.to_date')}}</label>
                    <input class="form-control"  type="date" name="to_date">
                </div>
                <input class="btn btn-primary"  type="submit" value="Υποβολή">

            </form>
            <button class="btn btn-primary" style="background-color:dimgrey; margin-top: 5px" onclick="window.print()">Export</button>
        </div>
    </div>
</div>
<h3>{!!$title!!}</h3>
@foreach($tickets as $ticket)
    @include('tickets.list-item',['ticket'=>$ticket,'classes'=>'short'])
@endforeach
@endsection

@push('css')
    <style>
        .date
        {
            color: white;
            background: gray;
            border-radius: 4px;
            font-size: 18px;
            padding: 4px 10px;
            margin-right: 20px;
        }
        .input-group .form-control
        {
            border-radius: 5px!important;
            margin-left: 5px!important;
        }
    </style>
@endpush
