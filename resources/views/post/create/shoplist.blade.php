@extends('post.create')

@section('title')
{{ __('home.shoplist.create') }}
@endsection

@section('specific_data') 

<div class="form-group">
    <label for="items_table">{{__('home.shoplist.items-available')}}</label>
    <table class="table table-hover" id="items_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('home.item.name') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.description') }}</th>
                <th scope="col">{{ __('home.item.category') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr id='{{$item->id}}'>
                    <td>{{ $item->name }}</td>
                    <td class="d-none d-sm-table-cell">{{$item->description}}</td>
                    <td>{{ $item->category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="form-group">
    <label for="shoplist_table">{{__('home.shoplist.items-selected')}}</label>
    <table class="table table-hover" id="shoplist_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('home.item.name') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.description') }}</th>
                <th scope="col">{{ __('home.item.quantity') }}</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

@endsection


