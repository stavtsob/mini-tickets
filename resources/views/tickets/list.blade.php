@include('tickets.search')
<!-- Tickets per Department-->
@foreach ($departments as $department)
    <div class="department-ticket-list">
        <div style="height: 64px; display:flex;align-items:center;justify-content:center">
            <div class="department-title {{$department->code}}-title" style="text-align:center">{{$department->title}}</div>
        </div>
        <div class="ticket-list">
            <a class="create-new-ticket-btn" href="{{ route('tickets.create_page',['department'=>$department->code]) }}">
                <span style="font-size: 42px; margin-right: 16px;">+</span><span>{{__('general.add_new_ticket')}}</span>
            </a>
            <?php
            foreach($tickets[$department->code] as $ticket)
            {?>
                @include('tickets.list-item',['ticket'=>$ticket, 'classes'=>''])
            <?php } ?>
        </div>
    </div>
@endforeach
