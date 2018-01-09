<div class="btn-group" data-toggle="buttons">
    @foreach($options as $option => $label)
        <label class="btn btn-default btn-sm {{ \Request::get('type', 'film') == $option ? 'active' : '' }}">
            <input type="radio" class="video-type" value="{{ $option }}">{{$label}}
        </label>
    @endforeach
</div>