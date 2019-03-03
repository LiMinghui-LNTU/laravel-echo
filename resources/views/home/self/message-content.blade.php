@if($oMessage->from == \App\Model\Members::getIdByAccount(session()->get('member')[0])[0] && $oMessage->pre_type == 4)
    <?php $oInfo = \App\Model\Members::getInfoByAccount(session()->get('member')[0]); ?>
    <li class="am-comment am-comment-flip am-comment-danger">
        <a href="javascript:;">
            <img src="{{$oInfo->photo}}" alt="" class="am-comment-avatar" width="48" height="48">
        </a>
        <div class="am-comment-main">
            <header class="am-comment-hd">
                <div class="am-comment-meta">
                    <a href="javascript:;" class="am-comment-author">{{$oInfo->nickname}}</a> 回复于
                    <time title="{{date('Y年m月d日H:i:s', strtotime($oMessage->created_at))}}">{{$oMessage->created_at}}</time>
                </div>
            </header>
            <div class="am-comment-bd">
                <p>{{$oMessage->content}}</p>
            </div>
        </div>
    </li>
@else
    <?php $oUser = \App\User::findUser($oMessage->from); ?>
    <li class="am-comment am-comment-primary">
        <a href="javascript:;">
            <img src="{{$oUser->head_url}}" alt="" class="am-comment-avatar" width="48" height="48">
        </a>
        <div class="am-comment-main">
            <header class="am-comment-hd">
                <div class="am-comment-meta">
                    <a href="javascript:;" class="am-comment-author">{{$oUser->username}}</a> 回复于
                    <time title="{{date('Y年m月d日H:i:s', strtotime($oMessage->created_at))}}">{{$oMessage->created_at}}</time>
                </div>
            </header>
            <div class="am-comment-bd">
                <p>{{$oMessage->content}}</p>
            </div>
        </div>
    </li>
@endif