<ul class="list-group list-group-flush list-group-scroll">
    @foreach($post->postable->items as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center {{$item->pivot->checked ? 'item-disabled' : ''}}">
            <div>
                {{$item->name}}
                <span class="badge badge-secondary badge-pill ml-1">{{$item->pivot->quantity}}</span>
            </div>
            <div class="align-middle">
                        <input  type="checkbox" 
                                id="{{'bought_check_' . $item->id}}" 
                                data-id="{{$item->id}}" 
                                data-toggle="tooltip" 
                                data-placement="left" 
                                title="{{$item->pivot->checked ? __('home.item.tobuy-tooltip') : __('home.item.bought-tooltip')}}" 
                                {{$item->pivot->checked ? "checked" : ""}}>
            </div>
        </li>
    @endforeach
</ul>