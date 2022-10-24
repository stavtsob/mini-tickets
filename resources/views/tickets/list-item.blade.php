<a class="ticket {{ $classes }}" href="{{route('tickets.view', $ticket->code)}}">
    <div class="ticket-left">
        <div class="ticket-title">{{ $ticket['code']}}: {{$ticket['title']}}</div>
        <span style="color:gray;font-size:11px;position: relative;top:-10px">Created at {{$ticket->created_at->format('H:i d M Y')}}</span>
        <div class="ticket-field"><b>Refers to: </b>{{$ticket['refers_to']}}</div>
        <div class="ticket-field"><b>Department: </b>{{$ticket['department']}}</div>
        <div class="ticket-field"><b>Author: </b>{!! $ticket->author()->name ?? '<i>Deprecated user</i>'!!}</div>
        <div class="ticket-field"><b>Status: </b><span class="status
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
                        echo 'Open';
                        break;
                    case 2:
                        echo 'In Progress';
                        break;
                    case 3:
                        echo 'Closed';
                        break;
                }
                ?>
            </span></div>
    </div>
    <div class="ticket-right">
        <div class="ticket-priority-bar">
            <div class="ticket-field" style="width: 100%">Priority</div>
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
    </div>
</a>
