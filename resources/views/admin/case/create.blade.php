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

                    <form action="/admin/case" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <div class="am-form-group">
                            <label for="tag" class="am-u-sm-12 am-form-label am-text-left">选择标签<span class="tpl-form-line-small-title">Tag</span></label>
                            <div class="am-u-sm-12  am-margin-top-xs">
                                <select name="tag" data-am-selected="" required>
                                    <option value="1">最新流行</option>
                                    <option value="2">男士风尚</option>
                                    <option value="3">女性潮流</option>
                                    <option value="4">优秀作品</option>
                                </select>
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
                                        <img id="show_thumb" width="200" src="">
                                        <input type="hidden" id="hide_thumb" name="thumb">
                                    </div>
                                    <button type="button" class="am-btn am-btn-primary am-btn-sm ">
                                        <i class="am-icon-cloud-upload"></i> 上传缩略图</button>
                                    <input type="file" id="file_thumb" name="file_thumb" onchange="uploadThumb('/admin/upload-photo', 'file_thumb', 'show_thumb', 'hide_thumb')">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="hair-title" class="am-u-sm-12 am-form-label am-text-left">
                                发型名称
                                <span class="tpl-form-line-small-title">Title</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" name="title" value="{{old('title')}}" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请填写发型名称" required>
                                <small>用于显示该发型的名称。</small>
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