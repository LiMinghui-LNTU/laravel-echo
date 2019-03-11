<div class="tpl-content-wrapper">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">{{$sTitle}}</div>
                    <div class="widget-function am-fr">
                        <a href="javascript:;" class="am-icon-cog"></a>
                    </div>
                </div>
                @include('admin.common.error')
                <div class="widget-body am-fr">

                    <form action="/admin/article/{{$oArticle->id}}" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="am-form-group">
                            <label for="hair-title" class="am-u-sm-12 am-form-label am-text-left">
                                文章标题
                                <span class="tpl-form-line-small-title">Title</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" name="title" value="{{$oArticle->title}}" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请填写标题" required>
                                <small>用于显示文章的标题。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="thumb" class="am-u-sm-12 am-form-label  am-text-left">
                                缩略图
                                <span class="tpl-form-line-small-title">Thumb</span>
                            </label>
                            <div class="am-u-sm-12 am-margin-top-xs">
                                <div class="am-form-group am-form-file">
                                    <div class="tpl-form-file-img">
                                        <img id="show_thumb" width="200" src="{{$oArticle->thumb}}">
                                        <input type="hidden" id="hide_thumb" name="thumb" value="{{$oArticle->thumb}}">
                                    </div>
                                    <button type="button" class="am-btn am-btn-primary am-btn-sm ">
                                        <i class="am-icon-cloud-upload"></i> 上传缩略图</button>
                                    <input type="file" id="file_thumb" name="file_thumb" onchange="uploadThumb('/admin/upload-photo', 'file_thumb', 'show_thumb', 'hide_thumb')">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="hair-title" class="am-u-sm-12 am-form-label am-text-left">
                                奖励发币
                                <span class="tpl-form-line-small-title">Coins</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="number" name="coins" value="{{$oArticle->coins}}" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置发币" required>
                                <small>浏览这篇文章获得的发币数量。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="hair-title" class="am-u-sm-12 am-form-label am-text-left">
                                文章描述
                                <span class="tpl-form-line-small-title">Description</span>
                            </label>
                            <div class="am-u-sm-12">
                                <textarea name="description" cols="30" rows="5" placeholder="请输入文章描述" required>{{$oArticle->description}}</textarea>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="content" class="am-u-sm-12 am-form-label am-text-left">
                                文章内容
                                <span class="tpl-form-line-small-title">Content</span>
                            </label>
                            <div class="am-u-sm-12">
                                <script id="brief" name="content" type="text/plain">{!! $oArticle->content !!}</script>
                                <script type="text/javascript">
                                    var editor = UE.getEditor('brief',{initialFrameHeight:200, autoHeightEnabled:true, zIndex:1300})
                                </script>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-12 am-u-sm-push-12">
                                <input type="submit" class="am-btn am-btn-success tpl-btn-bg-color-success ">
                                <input type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success" value="返回" onclick="window.history.go(-1);">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>