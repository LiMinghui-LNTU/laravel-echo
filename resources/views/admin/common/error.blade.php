@if (Session::has('error'))
    <div class="am-alert am-alert-danger" data-am-alert>
        <button type="button" class="am-close">&times;</button>
        <p>{{Session::get('error')}}</p>
    </div>
@endif