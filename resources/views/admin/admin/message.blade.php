<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">{{$sTitle}}</div>
                    </div>
                    <div class="widget-body  am-fr">
                        @csrf
                        <div class="am-panel-bd am-u-md-12">
                            <ul class="am-comments-list am-comments-list-flip am-scrollable-vertical" id="my-ul" style="height: 450px;">
                                @if($oMyMessages)
                                    @foreach($oMyMessages as $message)
                                        @if($message->from == $oUser->id)
                                            <li class="am-comment am-comment-flip am-comment-danger">
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
                                        @else
                                            <?php $oInfo = \App\User::findUser($message->from); ?>
                                            <li class="am-comment am-comment-primary">
                                                <a href="javascript:;">
                                                    <img src="{{$oInfo->head_url}}" alt="" class="am-comment-avatar" width="48" height="48">
                                                </a>
                                                <div class="am-comment-main">
                                                    <header class="am-comment-hd">
                                                        <div class="am-comment-meta">
                                                            <a href="javascript:;" class="am-comment-author">{{$oInfo->username}}</a> 回复于
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
                                @endif
                            </ul>
                            <hr>
                            <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                <input type="text" id="message-content" class="am-form-field" placeholder="请输入回复内容：">
                                <span class="am-input-group-btn">
                                    <button class="am-btn  am-btn-default am-btn-danger tpl-table-list-field am-icon-reply" type="button" onclick="adminSend();">回复</button>
                                    <button class="am-btn  am-btn-default am-btn-primary tpl-table-list-field am-icon-share" type="button" onclick="window.history.go(-1);">返回</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function adminSend() {
        var content = $("#message-content").val();
        if (content.trim() == '') {
            $("#message-content").focus();
            return false;
        } else {
            $.post(
                '/admin/admin-reply',
                {
                    _token: $("input[name='_token']").val(),
                    to: 2,
                    type: 2,
                    content: content
                },
                function (data) {
                    if (data.code == '1001') {
                        $("#message-content").val("");
                        $("#my-ul").append(data.msg);
                    } else {
                        showMessage(data.msg);
                        return false;
                    }
                },
                'json'
            );
        }
    }
</script>