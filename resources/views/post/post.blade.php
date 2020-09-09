<div class="col mb-4 post-card" id='post-{{$post->id}}'>
    <div class="card group-card-shadow {{$post->done ? 'bg-light text-muted' : 'bg-white'}}">
        <div class="card-header">
            <div class="row">
                <div class="col align-self-center">
                    <h5 class="post-title ">{{ $post->title }}</h5>
                </div>
                @if($post->postable_type == 'App\Shoplist')
                    <div class="col-2">
                        <form action="{{route('groups.shoplists.edit', ['group' => $group->id,'shoplist' => $post->postable_id])}}" method="GET">
                            <button class="btn btn-transparent edit-post-btn" type="submit">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </button>
                        </form> 
                    </div> 
                @endif

                @if($post->user_id == Auth::user()->id)
                <div class="col-2">
                    <button class="btn btn-transparent remove-post-btn" data-id="{{$post->id}}" data-toggle="modal" data-target="#delete-post-modal">
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
                            <small class="text-muted"> {{ __('home.post.expires') . ": " . date('j / n / Y', strtotime($post->expires_at))}}</small>
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

    $(document).ready(function() {
        
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('.done-checkbox').on('change', function(e){
            e.stopPropagation();
            e.stopImmediatePropagation();
            const post_id = this.dataset.id;
            const postUrl = window.location.href + '/posts/' + post_id;
            const types = {
                memo: "memo",
                shoplist: "shoplist"
            };
            $.ajax({
                type: 'PUT',
                url: postUrl,
                dataType: 'json',
                data: {
                    type: types.memo,
                    done: this.checked
                },
                success: function(response){
                    if(e.target.checked) {
                        e.target.title = "{{__('home.post.todo-tooltip')}}";
                        $('#post-' + post_id + ' > .card')[0].classList.remove('bg-white');
                        $('#post-' + post_id + ' > .card')[0].classList.add('bg-light','text-muted');
                    } else {
                        e.target.title = "{{__('home.post.done-tooltip')}}";
                        $('#post-' + post_id + ' > .card')[0].classList.remove('bg-light','text-muted');
                        $('#post-' + post_id + ' > .card')[0].classList.add('bg-white');
                    }
                },
            });
            
        });

        $('.delete-post-btn').on('click', function(event){
            jQuery.noConflict();
            event.stopPropagation();
            event.stopImmediatePropagation();
            const postId = $('#delete-post-modal').attr('post_id');
            const groupUrl = window.location.href;
            const postUrl = groupUrl + '/posts/' + postId;

            $.ajax({
                type: 'DELETE',
                url: postUrl,
                dataType: 'json',
                success: function(response){
                    let post_id = '#post-' + postId;
                    $(post_id).remove();
                    window.location.href = groupUrl;
                },
            });     
        });

        $('.remove-post-btn').on('click', function(event){
            var button = $(event.target).closest('.remove-post-btn');
            var post_id = button.data('id'); // Extract info from data-* attributes
            $('#delete-post-modal').attr('post_id', post_id);
        });

    });

</script>

