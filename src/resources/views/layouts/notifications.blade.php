@if(Auth::user())
<div class="notifications {{count($unreadNotifications) > 0 ? 'unread':''}}">
    <button><img src="{{url('/images/notification-icon.png')}}" style="width:16px;height:16px;"></button>
    <div class="notification-container">
        <div class="notifications-heading">{{__('general.notifications_heading')}}</div>
        @foreach($notifications as $notification)
        <a href="{{$notification->url}}" style="text-decoration: none;">
            <div class="notification {{ $notification->seen ? 'seen':''}}" data-id={{$notification->id}}>
                <div class="left">
                    <div class="notification-dot"></div>
                </div>
                <div class="right">
                    <div class="datetime">{{$notification->timeLabel}}</div>
                    <div class="author">{{ $notification->authorName() }}</div>
                    <div  class="content">{{ $notification->content }}</div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@push('css')
<style>
.notifications {
    position: relative;
    width: 100%;
    display: flex;
    justify-content: flex-end;
    margin-right: 30px;
}
.notifications.unread::after
{
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    top: -10px;
    right: -10px;
    content: "{{count($unreadNotifications)}}";
    background: red;
    color: white;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    font-size: 11px;
}
.notification-container
{
    display: none;
    position: absolute;
    top: 20px;
    min-height: 420px;
    width: 300px;
    background-color: white;
    z-index: 99;
    right: 0px;
    border: 1px solid lightgray;
    box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
    border-radius: 5px;

}
.notification-container.active
{
    display: block;
}
.notifications-heading
{
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 48px;
    width: 100%;
}
.notifications-heading::after
{
    content: "";
    position: absolute;
    bottom: 8px;
    height: 3px;
    width: 32px;
    background: black;
}
.notification
{
    border-bottom: 1px solid lightgray;
    padding: 5px 20px;
    display: flex;
    align-items: center;

}
.notification:hover
{
    background: rgb(229, 229, 229);
}
.notification-dot
{
    width: 8px;
    height: 8px;
    background: rgb(253, 196, 105);
    border-radius: 2px;
    box-shadow: 0px 2px 2px rgba(0,0,0,0.1);
}
.notification.seen .notification-dot
{
    background: rgb(160, 160, 160);
}
.notification .left
{
    width: 10%;
}
.notification .right
{
    width: 89%;
}
.notification .datetime
{
    font-weight: 700;
}
.notification .datetime, .notification .author
{
    font-size: 11px;
    color: gray;
    line-height: 11px;
}
.notification .content
{
    margin-top: 5px;
    font-size: 14px;
    color: rgb(84, 83, 83);
    line-height: 15px;
}
</style>
@push('js')
<script>
    setTimeout(() => {

        $(window).on('click', function(){
            $('.notification-container').removeClass('active');
        });
        $('.notifications button').on('click',function()
        {
            $('.notification-container').toggleClass('active');
            $('.notifications').removeClass('unread');
            event.stopPropagation();
        });

        function readNotificationListener()
        {
            $('.notification:not(.seen)').on('mouseover',function(e)
            {
                $('.notification:not(.seen)').off('mouseover');
                notificationId = $(this).data('id');
                element = $(this);
                $.ajax({
                method: 'POST',
                url: '{{route('notifications.read')}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'notificationId': notificationId
                }})
                .done(function( data ) {
                    element.addClass('seen');
                    readNotificationListener();
                });
            })
        }
        readNotificationListener();
    }, 1000);
</script>
@endpush
@endif
