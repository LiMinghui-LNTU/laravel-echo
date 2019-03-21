<div class="tpl-content-wrapper">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">{{$sTitle}}--{{$oService->name}}</div>
                    <div class="widget-function am-fr">
                        <a href="javascript:;" class="am-icon-cog"></a>
                    </div>
                </div>
                @include('admin.common.error')
                <div class="widget-body am-fr">

                    <form action="/admin/service/{{$oService->id}}" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="name" value="{{$oService->name}}">
                        <input type="hidden" name="number" value="{{$oService->number}}">
                        <div class="am-form-group">
                            <label for="gander" class="am-u-sm-12 am-form-label am-text-left">
                                类型
                                <span class="tpl-form-line-small-title">Type</span>
                            </label>
                            <div class="am-u-sm-12">
                                <label class="am-radio-inline">
                                    <input type="radio" name="type" value="1" required data-am-ucheck @if($oService->type == 1) checked @endif>短发
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="type" value="2" required data-am-ucheck @if($oService->type == 2) checked @endif>长发
                                </label>
                                <br>
                                <small>统一服务短发和长发的价位、服务时长等可能不同。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="work-year" class="am-u-sm-12 am-form-label am-text-left">
                                价位
                                <span class="tpl-form-line-small-title">Price</span>、
                                服务时长
                                <span class="tpl-form-line-small-title">Service Time</span>、
                                信誉值
                                <span class="tpl-form-line-small-title">Reputation Value</span>
                            </label>
                            <div class="am-u-sm-4">
                                <input type="number" name="price" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置价位：元" value="{{$oService->price}}" min="0" required>
                                <small>设置该项服务的价位，展示给顾客。</small>
                            </div>
                            <div class="am-u-sm-4">
                                <input type="number" name="time" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置服务时长：分" value="{{$oService->continue_to}}" min="0" required>
                                <small>表示进行该项服务大约需要的时间。</small>
                            </div>
                            <div class="am-u-sm-4">
                                <input type="number" name="reputation" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置信誉值：个" value="{{$oService->reputation_val}}" min="0" max="100" required>
                                <small>每项服务都有信誉值，用于约束顾客赴约行为。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="introduction" class="am-u-sm-12 am-form-label  am-text-left">服务简介</label>
                            <div class="am-u-sm-12 am-margin-top-xs">
                                <textarea name="introduction" rows="5" id="introduction" placeholder="请简单介绍一下该项服务" required>{{$oService->introduction}}</textarea>
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