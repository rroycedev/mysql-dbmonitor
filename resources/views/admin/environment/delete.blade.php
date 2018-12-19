@extends('layouts.backend')

@section('content')
<div class="content">


        {!! Form::open(['url' => 'admin/environment/performdeleteenvironment']) !!}
        <input type="hidden" id="environment_id" name="environment_id" value="{{$environment->environment_id}}" />

        <div class="row justify-content-center">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="alert alert-danger">
                Are you sure you wish to delete this environment?
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Delete', ['class' => 'btn btn-info', 'disabled' => !$canEdit]) !!}&nbsp;<a href="/admin/environment" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
