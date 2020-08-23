@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ __('home.my_groups') }}</h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <!-- Grid of bootstrap cards -->
                    <div class="row row-cols-1 row-cols-md-2">
                        @foreach($groups as $group)
                            <a style="display:block" href=" {{ route('groups.show', ['group' => $group->id]) }}">
                                <div class="col mb-4">
                                    <div class="card">
                                    <img src="img/group_card_header.jpg" class="card-img-top card-img-adapt-size" alt="Group card header">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $group->name }}</h5>
                                        <p class="card-text"> {{ $group->description }}</p>
                                    </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="btn btn-primary float-btn" href="{{ route('groups.create') }}" alt="{{ __('home.group.create') }}" role="button">
        <svg viewBox="0 0 16 16" class="bi bi-plus float-btn-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
        </svg>
    </a>
</div>


@endsection


