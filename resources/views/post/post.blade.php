<div class="col mb-4" class="post-card">
    <div class="card">
        <h5 class="card-header">{{ $post->title }} ({{$post->postable_type}})</h5>
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
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('.done-checkbox').click(function(){
        const postUrl = 'posts/' + this.dataset.id;
        const types = {
            memo: "memo",
            shoplist: "shoplist"
        };
        //this.title = this.checked ? "__('home.post.done-tooltip')" : "__('home.post.todo-tooltip')"; riaggiungere parentesi graffe eventualmente

        /*$.ajax({
            type: 'PUT',
            url: postUrl,
            dataType: 'json',
            data: {
                type: types.memo,
                done: this.checked
            },
            success: function(response){
                
            },
        })*/
        console.log("Invio richiesta")
    });
</script>

