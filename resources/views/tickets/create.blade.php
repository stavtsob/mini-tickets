@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create a new ticket
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tickets.create') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Ticket code') }}</label>

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
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

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
                            <label for="refers_to" class="col-md-4 col-form-label text-md-end">{{ __('Refers to') }}</label>

                            <div class="col-md-6">
                                <input id="refers_to" type="text" class="form-control @error('refers_to') is-invalid @enderror" name="refers_to" value="{{ old('refers_to') }}" required autocomplete="ticket-refers-to">

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
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autocomplete="ticket-department">

                                @error('department')
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
                                    <option value=1 selected>Open</option>
                                    <option value=2>In Progress</option>
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
                                <input type="range" class="form-range" id="priority" name="priority" min="0" max="5" value="1">
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
                                    {{ __('Create ticket') }}
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
