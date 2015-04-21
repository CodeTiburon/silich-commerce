@extends('myapp')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            {!! Form::open(['url' => 'authorize/register', 'id' => 'credForm']) !!}
                            <div class="form-group">

                                {!! Form::label('name', 'Name:') !!}
                                {!! Form::text('name',null,['class' => 'form-control']) !!}
                                <div id ="name_error"></div>
                            </div>

                            <div class="form-group">

                                {!! Form::label('email', 'Email:') !!}
                                {!! Form::text('email',null,['class' => 'form-control']) !!}
                                <div id ="email_error"></div>
                            </div>

                            <div class="form-group">

                                {!! Form::label('password', 'Password:') !!}
                                {!! Form::text('password',null,['class' => 'form-control']) !!}
                                <div id ="password_error"></div>
                            </div>

                            <div class="form-group">

                                {!! Form::label('password_confirmation', 'Confirm password:') !!}
                                {!! Form::text('password_confirmation',null,['class' => 'form-control']) !!}

                            </div>


                            <div class="form-group">

                                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}

                            </div>
                            {!! Form::close() !!}
                        <div id ="successMessage"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection