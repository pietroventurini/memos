@extends('layouts.app')

@section('content') 

<div class="container" id="posts-container" >
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <h5 class="card-header">{{ $group->name }}</h5>
                    <div class="card-body">
                        <!-- POSTS -->
                        <div class="row row-cols-1 row-cols-md-2">
                        @foreach($group->posts as $post)
                            @include('post.post')
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to delete post -->
    <div class="modal fade" id="delete-post-modal" tabindex="-1" role="dialog" aria-labelledby="delete-post-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-post-modal-label">{{__('home.post.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{__('home.post.delete-msg')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('home.cancel')}}</button>
                <button type="button" class="btn btn-danger delete-post-btn" data-dismiss="modal">{{__('home.delete')}}</button>
            </div>
            </div>
        </div>
    </div>

</div>



<!-- Buttons -->
@if(Auth::user()->isAdminOfGroup($group->id))
<a class="btn btn-primary float-btn float-btn-3 float-btn-settings" href="{{ route('groups.edit', ['group' => $group->id]) }}" alt="{{ __('home.group.edit') }}" role="button">
    <svg viewBox="0 0 16 16" class="bi bi-wrench float-btn-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019L13 11l-.471.242-.529.026-.287.445-.445.287-.026.529L11 13l.242.471.026.529.445.287.287.445.529.026L13 15l.471-.242.529-.026.287-.445.445-.287.026-.529L15 13l-.242-.471-.026-.529-.445-.287-.287-.445-.529-.026z"/>
    </svg>
</a>
@endif

<a class="btn btn-primary float-btn float-btn-2" href="{{ route('groups.memos.create', ['group' => $group->id]) }}" alt="{{ __('home.memo.create') }}" role="button">
    <svg viewBox="0 0 16 16" class="bi bi-card-text float-btn-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
        <path fill-rule="evenodd" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
    </svg>
</a>

<a class="btn btn-primary float-btn" href="{{ route('groups.shoplists.create', ['group' => $group->id]) }}" alt="{{ __('home.shoplist.create') }}" role="button">
    <svg viewBox="0 0 16 16" class="bi bi-cart2 float-btn-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
    </svg>
</a>
<!-- end buttons -->



@endsection
