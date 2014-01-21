@if (Auth::check())
    <?php $favorited = in_array($post->id, $favorites); ?>
        <span id="like-panel-{{$post->id}}"><a href="#" data-id="{{$post->id}}" class="{{ $favorited ? 'favorited' : 'not-favorited' }}"><i class="fa fa-heart"></i></a></span>
    
        <div id="like-stat-{{$post->id}}" class="pull-right count">{{ $post->favorites()->count() ? $post->favorites()->count() : '' }}
        </div>
@endif

