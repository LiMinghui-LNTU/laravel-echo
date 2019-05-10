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

                    <form action="/admin/ticket/{{$oTicket->id}}" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="am-form-group">
                            <label for="thumb" class="am-u-sm-12 am-form-label  am-text-left">
                                票券图片
                                <span class="tpl-form-line-small-title">Picture</span>
                            </label>
                            <div class="am-u-sm-12 am-margin-top-xs">
                                <div class="am-form-group am-form-file">
                                    <div class="tpl-form-file-img">
                                        <img id="show_thumb" width="200" src="{{$oTicket->picture}}">
                                        <input type="hidden" id="hide_thumb" name="picture" value="{{$oTicket->picture}}" required>
                                    </div>
                                    <button type="button" class="am-btn am-btn-primary am-btn-sm ">
                                        <i class="am-icon-cloud-upload"></i> 选择样图</button>
                                    <input type="file" id="file_thumb" name="file_thumb" onchange="uploadThumb('/admin/upload-photo', 'file_thumb', 'show_thumb', 'hide_thumb')">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="gander" class="am-u-sm-12 am-form-label am-text-left">
                                类型
                                <span class="tpl-form-line-small-title">Type</span>
                            </label>
                            <div class="am-u-sm-12">
                                <label class="am-radio-inline">
                                    <input type="radio" name="type" value="1" required data-am-ucheck @if($oTicket->type == 1) checked @endif>新人券
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="type" value="2" required data-am-ucheck @if($oTicket->type == 2) checked @endif>代金券
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="type" value="3" required data-am-ucheck @if($oTicket->type == 3) checked @endif>限时券
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="type" value="4" required data-am-ucheck @if($oTicket->type == 4) checked @endif>月券
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="type" value="5" required data-am-ucheck @if($oTicket->type == 5) checked @endif>发币券
                                </label>
                                <br>
                                <small>设置票券种类，制定相应规则。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="work-year" class="am-u-sm-12 am-form-label am-text-left">
                                面额
                                <span class="tpl-form-line-small-title">Quota</span>、
                                发放数量
                                <span class="tpl-form-line-small-title">Count</span>
                            </label>
                            <div class="am-u-sm-6">
                                <input type="number" name="quota" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置面额：元/个" min="0" value="{{$oTicket->quota}}" required>
                                <small>设置单张票券面额。</small>
                            </div>
                            <div class="am-u-sm-6">
                                <input type="number" name="count" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置发放数量：张" min="0" value="{{$oTicket->count}}" readonly required>
                                <small>该票券可被领取的总次数。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="condition" class="am-u-sm-12 am-form-label am-text-left">
                                领取条件
                                <span class="tpl-form-line-small-title">Condition</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" name="condition" class="am-form-field tpl-form-no-bg am-margin-top-xs" value="{{$oTicket->condition}}" required>
                                <small>只有符合该设定条件的顾客才可以领取该票券。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-12 am-form-label am-text-left">发券时间 <span class="tpl-form-line-small-title">Send Time</span></label>
                            <div class="am-u-sm-12">
                                <input type="text" class="tpl-form-input am-margin-top-xs" name="created_at" placeholder="请设置发券时间" value="{{$oTicket->created_at}}" onFocus="WdatePicker({isShowClear:true,dateFmt:'yyyy-MM-dd HH:mm:00',readOnly:true})" required>
                                <small>票券的开抢时间。</small>
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