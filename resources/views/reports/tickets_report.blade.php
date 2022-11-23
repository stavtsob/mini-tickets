@extends('layouts.app')

@section('content')

<div class="filters no-print">
    <div class="container">
        <form method="GET">
            <div class="form-group">
                <label class="form-label">{{__('general.from_date')}}</label>
                <input class="form-input" type="date" name="from_date">
            </div>
            <div class="form-group">
                <label class="form-label">{{__('general.to_date')}}</label>
                <input class="form-input"  type="date" name="to_date">
            </div>
            <div class="form-group">
                <input class="btn-primary"  type="submit" value="Υποβολή">
            </div>
        </form>
</div>
@foreach($tickets as $ticket)
    @include('tickets.list-item',['ticket'=>$ticket,'classes'=>'short'])
@endforeach
@endsection
