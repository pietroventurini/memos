<ul class="list-group list-group-flush list-group-scroll list-shoplist" data-shoplist_id="{{$post->postable_id}}">
    @foreach($post->postable->items as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent {{$item->pivot->checked ? 'item-disabled' : ''}}">
            <div>
                {{$item->name}}
                <span class="badge badge-secondary badge-pill ml-1">{{$item->pivot->quantity}}</span>
            </div>
            <div class="align-middle">
                        <input  type="checkbox" 
                                class="bought-checkbox"
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

<script type="application/javascript">
    $(document).ready(function() {

        $('.bought-checkbox').on('change', function(e){
            e.stopPropagation();
            e.stopImmediatePropagation();
            var list_id = $(this).parents('.list-shoplist')[0].dataset.shoplist_id;
            var item_id = this.dataset.id;
            var checked = this.checked;
            var url = '{{route('groups.shoplists.checkItem', ['group' => $group->id, 'shoplist' => ':shoplist_id'])}}'
            url = url.replace(':shoplist_id', list_id);


           $.ajax({
                type: 'PUT',
                url: url,
                data: {
                    item_id: item_id,
                    checked: checked,
                },
                success: function(response) {
                    if (checked) {
                        $(e.target).parents('li.list-group-item')[0].classList.add('item-disabled');
                        e.target.title = "{{__('home.item.tobuy-tooltip')}}"
                    } else {
                        $(e.target).parents('li.list-group-item')[0].classList.remove('item-disabled');
                        e.target.title = "{{__('home.item.bought-tooltip')}}";
                    }
                },
            });
        });
    });
 </script>