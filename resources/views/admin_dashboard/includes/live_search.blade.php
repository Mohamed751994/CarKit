<form id="live-search" action="{{\Request::url()}}" class="styled my-3 d-flex align-items-center" method="GET">
    <input type="text" class="text-input w-50 form-control mx-2" name="live_search" value="{{request('live_search')}}" id="filter" placeholder="بحث......" />
    <button type="submit" class="btn btn-success">بحث الآن</button>
</form>
