<div class="ticket-list">
    @include('tickets.search')
    <a class="create-new-ticket-btn" href="{{ route('tickets.create_page') }}">
        <span style="font-size: 64px; margin-right: 16px;">+</span><span>{{__('general.add_new_ticket')}}</span>
    </a>
    <?php
    foreach($tickets as $ticket)
    {?>
        @include('tickets.list-item',['ticket'=>$ticket, 'classes'=>''])
    <?php } ?>


</div>
