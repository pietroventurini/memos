@extends('layouts.app')

@section('content') 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <h5 class="card-header">@yield('title')</h5>
                    <div class="card-body">
                        <form action="@yield('update_route_name')" {{$post->postable_type == 'App\Shoplist' ? 'id=edit-shoplist-form' : ''}} method="POST">
                            @csrf
                            <input type="hidden" id="type" name="type" value="{{$post->type}}">
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="title">{{ __('home.post.title') }}</label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                            value="{{$post->title}}" autocomplete="off" required>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="expires_at">{{ __('home.post.expires') }}</label>
                                    <input type="date" class="form-control" id="expires_at" name="expires_at" 
                                            value={{$post->expires_at}} autocomplete="off" required>
                                </div>
                            </div>

                            @yield('specific_data')

                            <div class="form-row float-right">
                                <a class="btn btn-secondary mr-2" href="{{route('groups.show', ['group' => $group_id])}}" role="button"> {{__('home.cancel')}} </a>
                                <button class="btn btn-primary mr-2"  type="submit">{{__('home.edit')}}</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    /*$('#edit-post-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        console.log(form.serializeArray());
    });*/

</script>
@endsection
