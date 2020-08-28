@extends('layouts.app')

@section('content') 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <h5 class="card-header">@yield('title')</h5>
                    <div class="card-body">
                        <form action="{{route(@yield('store_route_name'), ['group'=>$group_id])}}" method="POST">
                            @csrf
                            <input type="hidden" id="type" name="type" value="{{$type}}">
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="title">{{ __('home.post.title') }}</label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                            value="" autocomplete="off" required>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="expires_at">{{ __('home.post.expires') }}</label>
                                    <input type="date" class="form-control" id="expires_at" name="expires_at" 
                                            value="" autocomplete="off" required>
                                </div>
                            </div>

                            @yield('specific_data')

                            <div class="form-row float-right">
                                <a class="btn btn-secondary mr-2" href="{{route('groups.show', ['group' => $group_id])}}" role="button"> {{__('home.cancel')}} </a>
                                <button class="btn btn-primary mr-2" type="submit">{{__('home.create')}}</button>
                            </div>

                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
