@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{__('general.add_new_ticket')}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tickets.create') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="code" class="col-md-4 col-form-label text-md-end">{{__('general.ticket_code')}}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') ?? $ticket_code }}" required autocomplete="ticket-code">

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{__('general.title')}}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="ticket-title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="refers_to" class="col-md-4 col-form-label text-md-end">{{__('general.refers_to')}}</label>

                            <div class="col-md-6">
                                <input id="refers_to" type="text" class="form-control @error('refers_to') is-invalid @enderror" name="refers_to" value="{{ old('refers_to') }}" autocomplete="ticket-refers-to">

                                @error('refers_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="department" class="col-md-4 col-form-label text-md-end">{{__('general.department')}}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="department" aria-label="department" class="form-control @error('department') is-invalid @enderror">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->code }}">{{ $department->title }}</option>
                                    @endforeach
                                </select>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telephone" class="col-md-4 col-form-label text-md-end">{{__('general.telephone')}}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autocomplete="ticket-telephone">

                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{__('general.status')}}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="status" aria-label="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value=1 selected>{{__('general.opened')}}</option>
                                    <option value=2>{{__('general.in-progress_capital')}}</option>
                                  </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="priority" class="col-md-4 col-form-label text-md-end">{{ __('general.priority') }}</label>

                            <div class="col-md-6">
                                <input type="range" class="form-range" id="priority" name="priority" min="0" max="5" value="1">
                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="deadline" class="col-md-4 col-form-label text-md-end">{{__('general.deadline')}}</label>

                            <div class="col-md-6">
                                <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" autocomplete="ticket-deadline">

                                @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" rows="10" class="col-md-4 col-form-label text-md-end">{{__('general.description')}}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="ticket-description"></textarea>
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
                                    {{__('general.create_ticket')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
