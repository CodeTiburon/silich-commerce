@extends('myapp')

@section('content')

    <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-success">

        <div class="panel panel-heading">

            <h4>Confirmation</h4>

        </div>

        <div class="panel panel-body">
            <div id="errors" class="alert alert-danger" style="display: none"></div>

            <form class="form-horizontal" id="orderForm" role="form" method="POST" action="{{ url('/order/create') }}">
            						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- <div class="form-group">

                    <label for="namep" class="col-md-4 control-label">Name:</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>-->

                <div class="form-group">

                    <label for="address" class="col-md-4 control-label">Address:</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="address">
                    </div>

                </div>

                <div class="form-group">

                    <label for="telephone" class="col-md-4 control-label">Telephone number:</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="telephone">
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Confirm your order</button>
                    </div>
                </div>

            </form>


        </div>

    </div>
    </div>

@endsection

@section('sources')

    <script src="{{ asset('/js/form.js') }}"></script>

@endsection

