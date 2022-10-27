@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ticket details <span style="font-color:gray;font-size:11px;margin-left:10px;">[ Created at {{$ticket->created_at->format('H:i d M Y')}} ]</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tickets.update', $ticket->code) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Ticket code') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" value="{{$ticket->code}}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $ticket->title }}" required autocomplete="ticket-title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="refers_to" class="col-md-4 col-form-label text-md-end">{{ __('Refers to') }}</label>

                            <div class="col-md-6">
                                <input id="refers_to" type="text" class="form-control @error('refers_to') is-invalid @enderror" name="refers_to" value="{{ old('refers_to') ?? $ticket->refers_to }}"  autocomplete="ticket-refers-to">

                                @error('refers_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="department" class="col-md-4 col-form-label text-md-end">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') ?? $ticket->department }}"  autocomplete="ticket-department">

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Telephone') }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') ?? $ticket->telephone }}" autocomplete="ticket-telephone">

                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="status" aria-label="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value=1 {{ $ticket->status == 1 ? 'selected':''}}>Open</option>
                                    <option value=2 {{ $ticket->status == 2 ? 'selected':''}}>In Progress</option>
                                    <option value=3 {{ $ticket->status == 3 ? 'closed':''}}>Closed</option>
                                  </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="priority" class="col-md-4 col-form-label text-md-end">{{ __('Priority') }}</label>

                            <div class="col-md-6">
                                <input type="range" class="form-range" id="priority" name="priority" min="0" max="5" value="{{ $ticket->priority }}">
                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" rows="10" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $ticket->description }}" required autocomplete="ticket-description">{{ old('description') ?? $ticket->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update ticket') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('tickets.delete', $ticket->code)}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete ticket') }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="comment-section">
                <div class="user-comments">
                    <h4 style="width: 100%">User Comments</h4>
                    <form method="POST" action="{{ route('tickets.comments.create') }} ">
                        @csrf
                        <div class="post-comment">
                                <input type="hidden" name="ticket_id" value={{ $ticket->id }}>
                                <textarea id="comment" type="text" rows="2"  class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required placeholder="Write your comment here..."></textarea>
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                        </div>
                    </form>
                    @foreach ($ticket->comments() as $comment)
                    <div class="comment {{ $comment->user_id == Auth::user()->id ? 'mine':''}}">
                        <span class="posted-at">Posted at {{ $comment->created_at->format('H:i d M Y') }}</span>
                        <div class="comment-left">
                            <div class="comment-dot"></div><span class="comment-user">{{$comment->user()->name }}</span><span class="comment-content">{{ $comment->comment}}</span>
                        </div>
                        <div class="comment-right">
                            @if($comment->user_id == Auth::user()->id)
                            <div class="dropdown-right comment-options">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-comment-id={{$comment->id}} aria-expanded="false">...</a>

                                <ul class="dropdown-menu comment-options-menu">
                                  <li><a href="{{ route('tickets.comments.delete', $comment->id) }}" class="dropdown-item" href="#">Delete</a></li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
