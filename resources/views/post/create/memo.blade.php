@extends('post.create')

@section('title')
{{ __('home.memo.create') }}
@endsection

@section('store_route_name')
'memo.store'
@end_section

@section('specific_data') 

<div class="form-group">
    <label for="description">{{__('home.description')}}</label>
    <textarea class="form-control" id="description" name="description" rows="3" maxlength="255"></textarea>
</div>

@endsection