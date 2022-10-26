<form class="search-ticket" method="POST" action="{{ route('tickets.search_with_code') }}">
    @csrf
    <input name="code" placeholder="Search ticket code...">
    <button type="submit" class="btn btn-primary">
        {{ __('Search') }}
    </button>
</form>
