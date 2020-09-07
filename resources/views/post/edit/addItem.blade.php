@extends('layouts.app')

@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ __('home.shoplist.add-item') }}</h5>
                <div class="card-body">
                    <form id="create-item-form" name="create-item-form" action="{{ route('items.store') }}" method="POST">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="item-name">{{__('home.item.name')}}</label>
                                <input type="text" name="name" id="item-name" class="form-control" required autoComplete="off">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="item-description">{{__('home.item.description')}}</label>
                                <input type="text" name="description" id="item-description" class="form-control" autoComplete="off">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="category-list">{{__('home.item.category')}}</label>
                                <select class="custom-select" name="category" id="category-list">
                                    @foreach($categories as $category)
                                        <option value="{{$category->name}}" {{$category->name == 'Other' ? 'selected' : ''}}>{{$category->name}}</option>""
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="float-right m-3">
                            <a class="btn btn-secondary" href="{{ route('groups.shoplists.edit', ['group' => $group_id, 'shoplist' => $shoplist_id]) }}" role="button">{{__('home.cancel')}}</a>
                            <button type="submit" class="btn btn-primary">{{__('home.add')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection