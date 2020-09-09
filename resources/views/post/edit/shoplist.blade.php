@extends('post.edit')

@section('title')
{{ __('home.shoplist.edit') }}
@endsection

@section('update_route_name')
{{route('groups.shoplists.update', ['group'=>$group_id, 'shoplist'=>$shoplist->id])}}
@endsection

@section('specific_data') 


<div class="form-group mt-3">
    <div class="row mb-3">
        <div class="col-sm">
            <label class="attr-label" for="items_table">{{__('home.shoplist.items-available')}}</label>
        </div>
        <div class="col-sm">
            <a class="btn btn-primary float-right" href="{{ route('items.create', ['group' => $group_id, 'shoplist' => $shoplist->id]) }}" role="button">{{__('home.shoplist.add-item')}}</a>
        </div>
    </div>
    <table class="table table-hover" id="items_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('home.item.name') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.description') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.category') }}</th>
                <th scope="col quantity-col">{{ __('home.item.quantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($available_items as $item)
                <tr id='{{$item->id}}'>
                    <td>{{ $item->name }}</td>
                    <td class="d-none d-sm-table-cell">{{$item->description}}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->category->name }}</td>
                    <td class="quantity-cell">
                        <input class="quantity-input" type="number" value="1" min="1" max="100" step="1"/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>




<div class="form-group mt-4">
    <label class="attr-label" for="shoplist_table">{{__('home.shoplist.items-selected')}}</label>
    <table class="table table-hover" id="shoplist_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('home.item.name') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.description') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.category') }}</th>
                <th scope="col quantity-col">{{ __('home.item.quantity') }}</th>
                <th scope="col">{{ __('home.item.remove') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shoplist->items as $item)
                <tr id='{{$item->id}}'>
                    <td>{{ $item->name }}</td>
                    <td class="d-none d-sm-table-cell">{{$item->description}}</td>
                    <td class="d-none d-sm-table-cell">{{ $item->category->name }}</td>
                    <td class="quantity-cell">
                        <input class="quantity-input" type="number" value="{{$item->pivot->quantity}}" min="1" max="100" step="1"/>
                    </td>
                    <td>
                        <button class='btn btn-outline-danger remove-item-btn' type='button'>
                            <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd' d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z'/>
                            </svg>
                        </button>
                        <!--<input type="hidden" name="shoplist_items[]" value='{"id": "{{$item->id}}", "quantity": "{{$item->pivot->quantity}}"}' />-->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection


