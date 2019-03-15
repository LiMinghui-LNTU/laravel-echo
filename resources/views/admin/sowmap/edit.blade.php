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

                    <form action="/admin/sowmap/{{$oSowmap->id}}" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-12 am-form-label am-text-left">跳转连接 <span class="tpl-form-line-small-title">Jump Link</span></label>
                            <div class="am-u-sm-12  am-margin-top-xs">
                                <select data-am-selected="" style="display: none;" name="redirect" required>
                                    @foreach($oNav as $nav)
                                        <option value="{{$nav->url}}" @if($oSowmap->redirect == $nav->url) selected @endif>{{$nav->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="thumb" class="am-u-sm-12 am-form-label  am-text-left">
                                首页轮播图
                                <span class="tpl-form-line-small-title">Sowmap</span>
                            </label>
                            <div class="am-u-sm-12 am-margin-top-xs">
                                <div class="am-form-group am-form-file">
                                    <div class="tpl-form-file-img">
                                        <img id="show_thumb" width="400" src="{{$oSowmap->thumb}}">
                                        <input type="hidden" id="hide_thumb" name="thumb" value="{{$oSowmap->thumb}}">
                                    </div>
                                    <button type="button" class="am-btn am-btn-primary am-btn-sm ">
                                        <i class="am-icon-cloud-upload"></i> 上传轮播图</button>
                                    <input type="file" id="file_thumb" name="file_thumb" onchange="uploadThumb('/admin/upload-photo', 'file_thumb', 'show_thumb', 'hide_thumb')">
                                </div>
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