@if(Session::has('flash_messsage'))
    <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
@endif