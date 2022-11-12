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
<!-- Closed Tickets -->
@if(isset($closedTickets))
    <div style="width:100%">
    @if (count($closedTickets)>0)
        <h4 style="margin-top: 60px;margin-left: 10px;">{{__('general.closed_tickets')}}</h4>
    @endif
        <div class="closed-tickets">
            <?php
            foreach ($closedTickets as $closedTicket) {
            ?>
                @include('tickets.list-item',['ticket'=>$closedTicket, 'classes'=>'closed'])
            <?php }  ?>
        </div>
    </div>
@endif
