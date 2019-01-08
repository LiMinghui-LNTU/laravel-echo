@if (Session::has('warning'))
    <div class="am-alert am-alert-warning" data-am-alert>
        <button type="button" class="am-close">&times;</button>
        <p>{{Session::get('warning')}}</p>
    </div>
@endif