<a class="ticket {{ $classes }} priority-{{$ticket->priority}}" href="{{route('tickets.view', $ticket->code)}}">
    <div class="ticket-left">
        <div class="ticket-title">{{ $ticket['code']}}: {{$ticket['title']}}</div>
        <span style="color:gray;font-size:11px;position: relative;top:-10px">{{__('general.created_at')}} {{$ticket->created_at->format('H:i d M Y')}}</span>
        <div class="ticket-field"><b>{{__('general.refers_to')}}: </b>{{$ticket['refers_to']}}</div>
        <div class="ticket-field"><b>{{__('general.department')}}: </b>{{$ticket['department']}}</div>
        <div class="ticket-field"><b>{{__('general.author')}}: </b>{!! $ticket->author()->name ?? '<i>Deprecated user</i>'!!}</div>
        <div class="ticket-field"><b>{{__('general.status')}}: </b><span class="status
            <?php
                switch($ticket['status'])
                {
                    case 1:
                        echo 'open';
                        break;
                    case 2:
                        echo 'in-progress';
                        break;
                    case 3:
                        echo 'closed';
                        break;
                }
            ?>">
            <?php
            switch($ticket['status'])
                {
                    case 1:
                        echo __('general.opened');
                        break;
                    case 2:
                        echo __('general.in-progress_capital');
                        break;
                    case 3:
                        echo __('general.closed');
                        break;
                }
                ?>
            </span>
        </div>
    </div>
    <div class="ticket-right">
        <div class="ticket-priority-bar" >
            <div class="ticket-field " style="width: 100%">{{__('general.priority')}}</div>
            <?php for($i=0;$i<$ticket['priority'];$i++)
            {
                echo '<span class="point active"></span>';
            }
            for($i=0;$i<5-$ticket['priority'];$i++)
            {
                echo '<span class="point"></span>';
            }
            ?>
        </div>
        <div class="comments-count">
            {{ $ticket->comments()->count() }} {{__('general.comments')}}
        </div>
    </div>
</a>
