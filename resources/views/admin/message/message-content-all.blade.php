@foreach($oMessages as $message)
    @if($message->pre_type == 4)
        <?php $oInfo = \App\Model\Members::getMemberById($message->from); ?>
        <li class="am-comment am-comment-primary">
            <a href="javascript:;">
                <img src="{{$oInfo->photo}}" alt="" class="am-comment-avatar" width="48" height="48">
            </a>
            <div class="am-comment-main">
                <header class="am-comment-hd">
                    <div class="am-comment-meta">
                        <a href="javascript:;" class="am-comment-author">{{$oInfo->nickname}}</a> 回复于
                        <time title="{{date('Y年m月d日H:i:s', strtotime($message->created_at))}}">{{$message->created_at}}</time>
                    </div>
                </header>
                <div class="am-comment-bd">
                    <p>{{$message->content}}</p>
                </div>
            </div>
        </li>
    @else
        <?php $oUser = \App\User::findUser($message->from); ?>
        <li class="am-comment @if($message->pre_type == \App\User::getRoleById(Auth::User()->id)[0]) am-comment-flip am-comment-danger @else am-comment-primary @endif">
            <a href="javascript:;">
                <img src="{{$oUser->head_url}}" alt="" class="am-comment-avatar" width="48" height="48">
            </a>
            <div class="am-comment-main">
                <header class="am-comment-hd">
                    <div class="am-comment-meta">
                        <a href="javascript:;" class="am-comment-author">{{$oUser->username}}</a> 回复于
                        <time title="{{date('Y年m月d日H:i:s', strtotime($message->created_at))}}">{{$message->created_at}}</time>
                    </div>
                </header>
                <div class="am-comment-bd">
                    <p>{{$message->content}}</p>
                </div>
            </div>
        </li>
    @endif
@endforeach