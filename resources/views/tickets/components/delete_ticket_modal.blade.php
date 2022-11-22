<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" id="delete-ticket" data-bs-toggle="modal" data-bs-target="#deleteTicketModal-{{$ticket->id}}">
    {{ __('general.delete')}}
  </button>

  <!-- Modal -->
  <div class="modal fade" id="deleteTicketModal-{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteTicketModalLabel-{{$ticket->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteTicketModalLabel-{{$ticket->id}}">{{ __('general.delete_ticket')}}</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="{{ __('general.close')}}">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('general.close')}}</button>
          <form method="POST" action="{{ route('tickets.delete', $ticket->code)}}">
            @csrf
            <button type="submit" class="btn btn-danger">
                {{__('general.delete_ticket')}}
            </button>
        </form>
        </div>
      </div>
    </div>
  </div>
