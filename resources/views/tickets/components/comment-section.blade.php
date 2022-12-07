<div class="comment-section">
    <div class="user-comments">
        <h4 style="width: 100%">{{__('general.user_comments')}}</h4>
        <form method="POST" action="{{ route('tickets.comments.create') }} ">
            @csrf
            <div class="post-comment">
                    <input type="hidden" name="ticket_id" value={{ $ticket->id }}>
                    <textarea id="comment" type="text" rows="2"  class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required placeholder="{{__('general.write_your_comment_here')}}"></textarea>
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">
                        {{__('general.send')}}
                    </button>
                    <div id="userlist-tag">
                    </div>
            </div>
        </form>
        @foreach ($ticket->comments() as $comment)
        <div class="comment {{ $comment->user_id == Auth::user()->id ? 'mine':''}}" id="comment-{{$comment->id}}">
            <span class="posted-at">{{__('general.posted_at')}} {{ $comment->created_at->format('H:i d M Y') }}</span>
            <div class="comment-left">
                <div class="comment-dot"></div><span class="comment-user">{{$comment->user()->name }}</span><span class="comment-content">{!! $comment->comment !!}</span>
            </div>
            <div class="comment-right">
                @if($comment->user_id == Auth::user()->id || Auth::user()->id == 2)
                <div class="dropdown-right comment-options">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-comment-id={{$comment->id}} aria-expanded="false">...</a>

                    <ul class="dropdown-menu comment-options-menu">
                      <li><a href="{{ route('tickets.comments.delete', $comment->id) }}" class="dropdown-item" href="#">{{__('general.delete')}}</a></li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('js')
<script>
    setTimeout(() => {
        let userListElement = $('#userlist-tag');
        let users = @php echo json_encode(App\Models\User::orderBy('name')->get(['id','name','username'])->toArray()); @endphp ;

        users.forEach(function(user){
            userListElement.append('<div class="user-suggestion" data-username="'+user['username']+'">' + user['username'] + ' - ' + user['name'] + '</div>');
        });

        $('#comment').on('change keyup paste', function()
        {
            lastWord = $(this).val().split(/\s+/).pop();
            if(lastWord && lastWord.charAt(0) == '@')
            {
                console.log(lastWord.charAt(1));
                userListElement.css('display','block');
            }
            else
            {
                userListElement.css('display','none');
            }
        });

        $('.user-suggestion').on('click', function()
        {
            let username = $(this).data('username');
            let commentBody = $('#comment').val();

            $('#comment').val(commentBody + username + " ");
            $('#comment').trigger('change');
        });
    }, 1000);

</script>
@endpush
