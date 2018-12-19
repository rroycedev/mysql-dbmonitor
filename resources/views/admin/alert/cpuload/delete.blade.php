@extends('layouts.backend')

@section('content')
<div class="content">


        {!! Form::open(['url' => 'admin/alert/cpuload/performdelete']) !!}
        <input type="hidden" id="server_id" name="server_id" value="{{$alert->server_id}}" />

        <div class="row justify-content-center">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="alert alert-danger">
                Are you sure you wish to delete this alert?
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Delete', ['class' => 'btn btn-info', 'disabled' => !$canEdit]) !!}&nbsp;<a href="/admin/alert/cpuload" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
