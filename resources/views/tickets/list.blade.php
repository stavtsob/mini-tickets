@include('tickets.search')
<!-- Tickets per Department-->
@foreach ($departments as $department)
    <div class="department-ticket-list">
        <h4>{{$department->title}}</h4>
        <div class="ticket-list">
            <a class="create-new-ticket-btn" href="{{ route('tickets.create_page') }}">
                <span style="font-size: 64px; margin-right: 16px;">+</span><span>{{__('general.add_new_ticket')}}</span>
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
    <?php
    foreach ($closedTickets as $closedTicket) {
    ?>
        @include('tickets.list-item',['ticket'=>$closedTicket, 'classes'=>'closed'])
    <?php }  ?>
    </div>
@endif
