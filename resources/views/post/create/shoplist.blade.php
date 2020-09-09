@extends('post.create')

@section('title')
{{ __('home.shoplist.create') }}
@endsection

@section('store_route_name')
{{route('groups.shoplists.store', ['group'=>$group_id])}}
@endsection

@section('specific_data') 

<div class="form-group">
    <label class="attr-label" for="items_table">{{__('home.shoplist.items-available')}}</label>
    <table class="table table-hover" id="items_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('home.item.name') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.description') }}</th>
                <th scope="col">{{ __('home.item.category') }}</th>
                <th scope="col quantity-col">{{ __('home.item.quantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
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

<div class="form-group">
    <label class="attr-label" for="shoplist_table">{{__('home.shoplist.items-selected')}}</label>
    <table class="table table-hover" id="shoplist_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('home.item.name') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.description') }}</th>
                <th scope="col">{{ __('home.item.category') }}</th>
                <th scope="col quantity-col">{{ __('home.item.quantity') }}</th>
                <th scope="col">{{ __('home.item.remove') }}</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

@endsection


