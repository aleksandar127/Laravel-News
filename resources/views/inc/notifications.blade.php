@foreach($notification as $not)
    <div class=" text-white mt-1 p-2 notification notifications bg-info" style=" cursor: pointer; opacity:1;min-width:100px;display:none;"  id="{{$not->id}}
    ">
        <a href="{{$not->data['url']}}" target="_blank" class="mr-2 closed h5" style="text-decoration: none;color:black;">{{$not->data['title']}}</a>
        <button type="button" class="closed close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endforeach
