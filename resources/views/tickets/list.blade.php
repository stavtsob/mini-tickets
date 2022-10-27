<div class="ticket-list">
    @include('tickets.search')
    <a class="create-new-ticket-btn" href="{{ route('tickets.create_page') }}">
        <span style="font-size: 64px; margin-right: 16px;">+</span><span>Add a new ticket</span>
    </a>
    <?php
    foreach($tickets as $ticket)
    {?>
        @include('tickets.list-item',['ticket'=>$ticket, 'classes'=>''])
    <?php } ?>

    @if (count($closedTickets)>0)
        <h4 style="margin-top: 60px;margin-left: 10px;">Closed Tickets</h4>
    @endif
    <?php
    foreach ($closedTickets as $closedTicket) {
    ?>
        @include('tickets.list-item',['ticket'=>$closedTicket, 'classes'=>'closed'])
    <?php }  ?>
</div>
