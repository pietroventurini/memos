@extends('post.create')

@section('title')
{{ __('home.shoplist.create') }}
@endsection

@section('specific_data') 

<table class="table table-hover table-striped" id="items_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('home.item.name') }}</th>
                <th scope="col" class="d-none d-sm-table-cell">{{ __('home.item.description') }}</th>
                <th scope="col">{{ __('home.item.category') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr id='row_{{$item->id}}'>
                    <input type="hidden" name="items[]" value="{{$item->id}}" />
                    <td>{{ $item->name }}</td>
                    <td class="d-none d-sm-table-cell">{{$item->description}}</td>
                    <td>{{ $item->category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection