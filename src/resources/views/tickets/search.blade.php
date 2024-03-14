<form class="search-ticket" method="post" action="{{ route('tickets.search') }}">
    @csrf
    <input name="code" placeholder="{{__('general.search')}}">
    <button type="submit" class="btn btn-primary">
        {{__('general.search')}}
    </button>
</form>
