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

                    <form action="/admin/clerk/{{\Illuminate\Support\Facades\Auth::user()->id}}" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="am-form-group">
                            <label for="name" class="am-u-sm-12 am-form-label am-text-left">
                                姓名
                                <span class="tpl-form-line-small-title">Name</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" class="tpl-form-input am-margin-top-xs" id="name" name="name" value="@if(!is_null($oDesigner)){{$oDesigner->name}}@endif" placeholder="请输入用户名" required>
                                <small>此姓名将展示在前台供顾客选择。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="gander" class="am-u-sm-12 am-form-label am-text-left">
                                性别
                                <span class="tpl-form-line-small-title">Gander</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="radio" name="gander" class="tpl-form-no-bg am-margin-top-xs" value="1" @if(!is_null($oDesigner) && $oDesigner->sex == 1){{'checked'}}@endif required>男
                                <input type="radio" name="gander" class="tpl-form-no-bg am-margin-top-xs" value="2" @if(!is_null($oDesigner) && $oDesigner->sex == 2){{'checked'}}@endif required>女
                                <br>
                                <small>设置性别方便顾客做出选择。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="photo" class="am-u-sm-12 am-form-label  am-text-left">
                                个人写真
                                <span class="tpl-form-line-small-title">Photo</span>
                            </label>
                            <div class="am-u-sm-12 am-margin-top-xs">
                                <div class="am-form-group am-form-file">
                                    <div class="tpl-form-file-img">
                                        <img id="show_photo" width="200" src="@if(!is_null($oDesigner)){{$oDesigner->photo}}@endif">
                                        <input type="hidden" id="hide_photo" name="photo" value="@if(!is_null($oDesigner)){{$oDesigner->photo}}@endif">
                                    </div>
                                    <button type="button" class="am-btn am-btn-primary am-btn-sm ">
                                        <i class="am-icon-cloud-upload"></i> 上传写真</button>
                                    <input id="file_photo" name="file_photo" type="file" onchange="uploadThumb('/admin/upload-photo', 'file_photo', 'show_photo', 'hide_photo')">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="title" class="am-u-sm-12 am-form-label am-text-left">
                                头衔
                                <span class="tpl-form-line-small-title">Title</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" name="title" value="@if(!is_null($oDesigner)){{$oDesigner->title}}@endif" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置头衔" required>
                                <small>可以展示自己的技术等级。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="work-year" class="am-u-sm-12 am-form-label am-text-left">
                                工龄
                                <span class="tpl-form-line-small-title">Work Year</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="number" name="work-year" value="@if(!is_null($oDesigner)){{$oDesigner->work_year}}@endif" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置工龄" required>
                                <small>展示自己的阅历。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="introduction" class="am-u-sm-12 am-form-label  am-text-left">个人简介</label>
                            <div class="am-u-sm-12 am-margin-top-xs">
                                <textarea name="introduction" rows="10" id="introduction" placeholder="输入个人简介，让顾客更好地了解你。" required>@if(!is_null($oDesigner)){{$oDesigner->introduction}}@endif</textarea>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-12 am-u-sm-push-12">
                                <input type="submit" class="am-btn am-btn-success tpl-btn-bg-color-success" value="保存">
                                @if(!is_null($oDesigner))
                                    <input type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success" value="退出" onclick="window.location.href='/admin/clerk';">
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>