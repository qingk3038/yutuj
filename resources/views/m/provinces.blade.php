<form class="position-absolute" autocomplete="off" id="index-search">
    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" id="search-btn" class="btn dropdown-toggle down bg-none index-search-btn" data-toggle="dropdown">不限</button>
            <div class="dropdown-menu rounded-0" style="background: rgba(255,255,255, .8); min-width: auto;">
                <a class="dropdown-item search-item" href="javascript:void(0);">不限</a>
                @foreach($searchProvinces as $province)
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="{{ $province->id }}">{{ $province->name }}</a>
                @endforeach
            </div>
        </div>
        <input type="hidden" name="pid" id="pid">
        <input type="text" class="form-control bg-none index-q" name="q" id="q" placeholder="搜目的地/攻略/游记">
        <button type="submit" class="input-group-addon bg-none"><i class="fa fa-search text-white fa-lg"></i></button>
    </div>
</form>