<form class="search-ticket" method="POST" action="{{ route('tickets.search_with_code') }}">
    @csrf
    <input name="code" placeholder="{{__('general.search_ticket_code')}}">
    <button type="submit" class="btn btn-primary">
        {{__('general.search')}}
    </button>
</form>
