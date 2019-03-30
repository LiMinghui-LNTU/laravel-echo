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

                    <form action="/admin/vip" class="am-form tpl-form-border-form" method="post">
                        @csrf
                        <div class="am-form-group">
                            <label for="title" class="am-u-sm-12 am-form-label am-text-left">
                                会员名称
                                <span class="tpl-form-line-small-title">Vip Title</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" name="title" class="am-form-field tpl-form-no-bg am-margin-top-xs" required>
                                <small>请设置会员名称。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="thumb" class="am-u-sm-12 am-form-label  am-text-left">
                                卡片样图
                                <span class="tpl-form-line-small-title">Picture</span>
                            </label>
                            <div class="am-u-sm-12 am-margin-top-xs">
                                <div class="am-form-group am-form-file">
                                    <div class="tpl-form-file-img">
                                        <img id="show_thumb" width="200" src="">
                                        <input type="hidden" id="hide_thumb" name="picture" required>
                                    </div>
                                    <button type="button" class="am-btn am-btn-primary am-btn-sm ">
                                        <i class="am-icon-cloud-upload"></i> 选择样图</button>
                                    <input type="file" id="file_thumb" name="file_thumb" onchange="uploadThumb('/admin/upload-photo', 'file_thumb', 'show_thumb', 'hide_thumb')">
                                </div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="work-year" class="am-u-sm-12 am-form-label am-text-left">
                                办理费用
                                <span class="tpl-form-line-small-title">Charge</span>、
                                折扣
                                <span class="tpl-form-line-small-title">Discount</span>、
                                奖励信誉值
                                <span class="tpl-form-line-small-title">Reputation Value</span>、
                                奖励发币
                                <span class="tpl-form-line-small-title">Coins</span>
                            </label>
                            <div class="am-u-sm-3">
                                <input type="number" name="charge" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="填写办理费用" min="0" required>
                                <small>办理此会员需要交纳的费用。</small>
                            </div>
                            <div class="am-u-sm-3">
                                <input type="number" name="discount" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置消费折扣" min="0" required>
                                <small>消费时按该折扣进行打折。</small>
                            </div>
                            <div class="am-u-sm-3">
                                <input type="number" name="reputation_value" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置奖励信誉值" min="0" required>
                                <small>办理该会员的顾客将会得到此信誉值奖励。</small>
                            </div>
                            <div class="am-u-sm-3">
                                <input type="number" name="coins" class="am-form-field tpl-form-no-bg am-margin-top-xs" placeholder="请设置奖励的发币" min="0" required>
                                <small>办理该会员的顾客将会奖励该数量的发币。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="privilege" class="am-u-sm-12 am-form-label am-text-left">
                                会员特权
                                <span class="tpl-form-line-small-title">Privilege</span>
                            </label>
                            <div class="am-u-sm-12">
                                <input type="text" name="privilege" class="am-form-field tpl-form-no-bg am-margin-top-xs" required>
                                <small>成为此会员后享有的特权。</small>
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
<script>
    function searchTicket(type) {
        $.get(
            '/admin/search-ticket',
            {
                type : type
            },
            function (data) {
                if(data.code == '1001'){
                    if(data.is_exist){
                        $("input[name='condition']").val(data.condition);
                        $("input[name='created_at']").val(data.created_at);
                        $("input[name='condition']").attr("readonly", "readonly");
                        $("input[name='created_at']").attr("readonly", "readonly");
                        $("input[name='created_at']").attr("onFocus", "");
                    }else {
                        $("input[name='condition']").val("");
                        $("input[name='created_at']").val("");
                        $("input[name='condition']").removeAttr("readonly");
                        $("input[name='created_at']").attr("onFocus", "WdatePicker({isShowClear:true,dateFmt:'yyyy-MM-dd HH:mm:00',readOnly:true})");
                    }
                }else {
                    showMessage(data.msg);
                    return false;
                }
            },
            'json'
        );
    }
</script>