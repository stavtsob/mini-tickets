<div class="ticket-files">
<h4>{{__('general.attachments')}}</h4>

<form method="POST" enctype="multipart/form-data" action="{{ route('files.tickets.upload', $ticket->code) }}" >
    @csrf
    <label for="file" class="input-file-box">
        <span  id="uploader-label">{{__('general.click_to_upload')}}</span>
        <input style="display:none" id="file" type="file" name="file" accept="@include('files.mime-types')">
    </label>
    <br>
    <button type="submit" id='file-upload-btn' class="upload-btn">{{__('general.upload')}}</button>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php $imageExtensions = ['png','jpg','jpeg','svg','gif']; @endphp
    <div class="uploaded-files">
        <!-- VIEW UPLOADED IMAGES -->
        @foreach($ticket->getMedia() as $file)
            <div class="uploaded-img">
                @if(in_array($file->extension,$imageExtensions))
                    <a href="{{$file->getUrl()}}" target="_blank">
                        <img src="{{$file->getUrl()}}" style="width:80px;height:auto;border:1px solid gray;">
                    </a>
                    @include('tickets.components.delete_attachment_modal')
                @endif
            </div>
        @endforeach
        <!-- VIEW UPLOADED FILES -->
        @foreach($ticket->getMedia() as $file)
            <div style="width:100%;display:flex;align-items:center;margin-bottom:4px;position: relative;margin-right:20px">
                @if(!in_array($file->extension,$imageExtensions))
                    <img src="{{asset('images/file.png')}}" style="width:16px; height: 16px;filter: invert(0.6);margin-right: 5px">
                    <a href="{{route('files.download',$file->uuid)}}" target="_blank">"{{$file->file_name}}"</a><br>
                    @include('tickets.components.delete_attachment_modal')
                @endif
            </div>
        @endforeach
        <!-- END VIEW UPLOADED FILES -->
    </div>
</div>
@push('js')
<script type="text/javascript">
setTimeout(function() {
        $(document).ready(function() {
            $('#file-upload-btn').bind("click",function()
            {
                var imgVal = $('#file').val();
                if(imgVal=='')
                {
                    alert("No file selected.");
                    return false;
                }
                console.log('lol');

            });


            $('#file').bind("change", function(){
                $('#uploader-label').text($(this).val());
            });
        });
    },1000);
</script>
@endpush

