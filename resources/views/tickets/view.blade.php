@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{__('general.ticket_details')}} <span style="font-color:gray;font-size:11px;margin-left:10px;">[ {!! $ticket->author()->name ?? '<i>Deprecated user</i>'!!} {{__('general.created_at')}} {{$ticket->created_at->format('H:i d M Y')}} ]</span>
                    </div>
                <div class="card-body">
                    <div style="display: flex; flex-wrap:wrap;">
                        <div style=" flex-grow: 1;min-width: 280px">
                            <form method="POST" action="{{ route('tickets.update', $ticket->code) }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="code" class="col-md-4 col-form-label text-md-end">{{__('general.ticket_code')}}</label>

                                    <div class="col-md-7">
                                        <input id="code" name="code" type="text" class="form-control" value="{{$ticket->code}}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="title" class="col-md-4 col-form-label text-md-end">{{__('general.title')}}</label>

                                    <div class="col-md-7">
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $ticket->title }}" required autocomplete="ticket-title" autofocus>

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="refers_to" class="col-md-4 col-form-label text-md-end">{{__('general.refers_to')}}</label>

                                    <div class="col-md-7">
                                        <input id="refers_to" type="text" class="form-control @error('refers_to') is-invalid @enderror" name="refers_to" value="{{ old('refers_to') ?? $ticket->refers_to }}"  autocomplete="ticket-refers-to">

                                        @error('refers_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="department" class="col-md-4 col-form-label text-md-end">{{__('general.department')}}</label>

                                    <div class="col-md-7">
                                        <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') ?? $ticket->department }}"  autocomplete="ticket-department">

                                        @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="telephone" class="col-md-4 col-form-label text-md-end">{{__('general.telephone')}}</label>

                                    <div class="col-md-7">
                                        <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') ?? $ticket->telephone }}" autocomplete="ticket-telephone">

                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="status" class="col-md-4 col-form-label text-md-end">{{__('general.status')}}</label>

                                    <div class="col-md-7">
                                        <select class="form-select" name="status" aria-label="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value=1 {{ $ticket->status == 1 ? 'selected':''}}>{{__('general.opened')}}</option>
                                            <option value=2 {{ $ticket->status == 2 ? 'selected':''}}>{{__('general.in-progress_capital')}}</option>
                                            <option value=3 {{ $ticket->status == 3 ? 'selected':''}}>{{__('general.closed')}}</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="priority" class="col-md-4 col-form-label text-md-end">{{__('general.priority')}}</label>

                                    <div class="col-md-7">
                                        <input type="range" class="form-range" id="priority" name="priority" min="0" max="5" value="{{ $ticket->priority }}">
                                        @error('priority')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="deadline" class="col-md-4 col-form-label text-md-end">{{__('general.deadline')}}</label>

                                    <div class="col-md-7">
                                        <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') ?? $ticket->deadline }}" autocomplete="ticket-deadline">

                                        @error('deadline')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-md-4 col-form-label text-md-end">{{__('general.description')}}</label>

                                    <div class="col-md-7">
                                        <textarea id="description" type="text" rows="10" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $ticket->description }}" required autocomplete="ticket-description">{{ old('description') ?? $ticket->description }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-7 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{__('general.update_ticket')}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if($ticket->author_id == Auth::user()->id || Auth::user()->id == 2)
                                @include('tickets.components.delete_ticket_modal', $ticket)
                            @endif
                        </div>
                        @include('tickets.files',$ticket)
                    </div>
                </div>
            </div>

            @include('tickets.components.comment-section', $ticket)
        </div>
    </div>
</div>
@endsection
