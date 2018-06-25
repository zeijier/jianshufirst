@if($target_user->id != \Illuminate\Support\Facades\Auth::id())
<div>
    @if(\Illuminate\Support\Facades\Auth::user()->hasStar($target_user->id))
    {{--由于user.show.blade.php 把target_user传过来...  like-value=1 认为已经关注了--}}
    <button class="btn btn-default like-button" like-value="1" like-user="{{$target_user->id}}" type="button">取消关注</button>
        @else
        <button class="btn btn-default like-button" like-value="0" like-user="{{$target_user->id}}" type="button">关注</button>
        @endif
</div>
    @endif