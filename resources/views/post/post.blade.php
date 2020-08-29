<div class="col mb-4" class="post-card" id='post-{{$post->id}}'>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5>{{ $post->title }} ({{$post->postable_type}})</h5>
                </div>
                @if($post->user_id == Auth::user()->id)
                <div class="col-3 text-right">
                    <button class="btn btn-light destroy-btn" data-id="{{$post->id}}">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg>
                    </button>
                </div>
                @endif
            </div>
        </div>
        
        
        <div class="card-body">
            @if($post->postable_type == 'App\Memo')
                @include('post.memo')
            @elseif($post->postable_type == 'App\Shoplist')
                @include('post.shoplist')
            @endif
                <div class="row">
                    <div class="col-10">
                        <p class="card-text">
                            <small class="text-muted"> {{ __('home.post.creator') . ": " . $post->user->name}}</small> <br/>
                            <small class="text-muted"> {{ __('home.post.expires') . ": " . $post->expires_at}}</small>
                        </p>
                    </div>
                    <div class="col-2 form-check text-center">
                        <input class="form-check-input done-checkbox" 
                                type="checkbox" 
                                id="{{'done_check_' . $post->id}}" 
                                data-id="{{$post->id}}" 
                                data-toggle="tooltip" 
                                data-placement="left" 
                                title="{{$post->done ? __('home.post.todo-tooltip') : __('home.post.done-tooltip')}}" 
                                {{$post->done ? "checked" : ""}}>
                    </div>
                </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('.done-checkbox').on('change', function(event){
        event.stopPropagation();
        event.stopImmediatePropagation();
        const postUrl = window.location.href + '/posts/' + this.dataset.id;
        const types = {
            memo: "memo",
            shoplist: "shoplist"
        };
        //this.title = this.checked ? "__('home.post.done-tooltip')" : "__('home.post.todo-tooltip')"; riaggiungere parentesi graffe eventualmente

        $.ajax({
            type: 'PUT',
            url: postUrl,
            dataType: 'json',
            data: {
                type: types.memo,
                done: this.checked
            },
            success: function(response){
                console.log("successo");
            },
        });
        
    });

    $('.destroy-btn').on('click', function(event){
        event.stopPropagation();
        event.stopImmediatePropagation();
        const postId = this.dataset.id;
        const postUrl = window.location.href + '/posts/' + postId;
        $.ajax({
            type: 'DELETE',
            url: postUrl,
            dataType: 'json',
            success: function(response){
                let post_id = '#post-' + postId;
                $(post_id).remove();
            },
        });
        
    });
</script>

