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

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-primary"
                                                onclick="exportCustomer();">
                                            <span class="am-icon-dedent"></span> 数据导出
                                        </button>
                                    </div>

                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-success"
                                                onclick="window.location.href='/admin/type-statistic';">
                                            <span class="am-icon-bar-chart"></span> 数据分析
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="/admin/customer" method="get" id="search-form">
                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                <div class="am-form-group tpl-table-list-select">
                                    <select data-am-selected="{btnSize: ''}" name="vip" onchange="$('#search-form').submit();">
                                        <option value="0">所有类型</option>
                                        @foreach($oVip as $vip)
                                            <option value="{{$vip->id}}" @if($vip->id == $iVip) selected @endif>{{$vip->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                    <input type="text" name="key" class="am-form-field" placeholder="账号/昵称" value="{{$sKey}}">
                                    <span class="am-input-group-btn">
                                        <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button" onclick="$('#search-form').submit();"></button>
                                    </span>
                                </div>
                            </div>
                        </form>

                        <div class="am-u-sm-12" id="people-list">
                            @csrf
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>账号</th>
                                    <th>昵称</th>
                                    <th>头衔</th>
                                    <th>发币</th>
                                    <th>信誉值</th>
                                    <th>账户余额</th>
                                    <th>注册时间</th>
                                    <th>是否激活</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oCustomers as $customer)
                                    <tr class="gradeX">
                                        <td>{{$customer->id}}</td>
                                        <td>{{$customer->account_number}}</td>
                                        <td>{{$customer->nickname}}</td>
                                        <td>{{$customer->title}}</td>
                                        <td>{{$customer->coins}}</td>
                                        <td>{{$customer->reputation_value}}</td>
                                        <td>{{$customer->balance}}</td>
                                        <td>{{$customer->created_at}}</td>
                                        <td>@if($customer->is_active)是@else否@endif</td>
                                    </tr>
                                @endforeach
                                <!-- more data -->
                                </tbody>
                            </table>
                        </div>
                        <div class="am-u-lg-12 am-cf" id="paginate-nav">
                            <div class="am-fr">
                                @if($oCustomers)
                                    {!! $oCustomers->appends(['vip'=>\Illuminate\Support\Facades\Input::get('vip'), 'key'=>\Illuminate\Support\Facades\Input::get('key')])->render('vendor.pagination/default'); !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function exportCustomer() {
        var vip_id = $("select[name='vip']").val();
        var key = $("input[name='key']").val().trim();
        window.location.href = '/admin/customer/create?vip=' + vip_id + '&key=' + key;
    }
</script>