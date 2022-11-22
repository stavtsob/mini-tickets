<div class="delete-attachment-form">
    <button class="delete-attachment" data-bs-toggle="modal" data-bs-target="#delMedia-{{$file->uuid}}">X</button>
</div>

<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="delMedia-{{$file->uuid}}" tabindex="-1" role="dialog" aria-labelledby="delMediaLabel-{{$file->uuid}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="delMediaLabel-{{$file->uuid}}">{{ __('general.delete_media')}}</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="{{ __('general.close')}}">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{__("general.delete_media_confirm",['file'=>$file->name])}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('general.close')}}</button>
          <form  action="{{route('files.delete', $file->uuid)}}" method="POST">
            @csrf
            <input type="hidden" name="uuid" value="{{$file->uuid}}">
            <input type="submit"  class="btn btn-danger" value="{{__('general.delete')}}" required>
        </form>
        </div>
      </div>
    </div>
  </div>
