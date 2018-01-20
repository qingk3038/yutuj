<form autocomplete="off" id="index-search" action="{{ route('search') }}" class="{{ Route::is('search') ? 'mt-5' : 'position-absolute' }}">
    <input type="hidden" name="pid" id="pid" value="{{ request('pid') }}">
    @if(Route::is('search'))
        <input type="hidden" name="s" value="{{ request('s') }}">
        <input type="hidden" name="nid" value="{{ request('nid') }}">
        <input type="hidden" name="r" value="{{ request('r') }}">
        <input type="hidden" name="v" value="{{ request('v') }}">
    @endif
    <div class="input-group mb-3 rounded border {{ Route::is('search') ? 'border-warning' : 'border-white' }}">
        <div class="input-group-prepend">
            <button id="search-btn" class="btn dropdown-toggle rounded-0 border-0 {{ Route::is('search') ? 'btn-outline-warning' : 'btn-outline-light' }}" type="button" data-toggle="dropdown">不限</button>
            <div class="dropdown-menu rounded-0" style="background: rgba(255,255,255, .8); min-width: auto;">
                <a class="dropdown-item search-item" href="javascript:void(0);">不限</a>
                @foreach($searchProvinces as $province)
                    <a class="dropdown-item search-item" href="javascript:void(0);" pid="{{ $province->id }}">{{ $province->name }}</a>
                @endforeach
            </div>
        </div>
        <input type="text" class="form-control bg-none border-0 {{ Route::is('search') ? 'text-dark' : 'text-white' }}" placeholder="搜目的地/攻略/游记" name="q" id="q" value="{{ request('q') }}">
        <div class="input-group-append">
            <button class="btn btn-outline-light rounded-0 border-0 bg-none" type="submit">
                <i class="fa fa-search fa-lg {{ Route::is('search') ? 'text-warning' : 'text-white' }}"></i>
            </button>
        </div>
    </div>
</form>