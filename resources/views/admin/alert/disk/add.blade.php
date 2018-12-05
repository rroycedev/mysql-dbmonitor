@extends('layouts.backend')

@section('content')
<div class="content">
    {!! Form::open(['url' => 'admin/alert/repllag/performadd']) !!}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div>
            <div class="block block-rounded">
                <div class="panel-header">
                    <h3 class="panel-title">Add Replication Alert</h3>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        {!! Form::label('server', 'Server', ['class' => 'control-label']) !!}
                        {!! Form::select('server', json_decode($servers, true), null, ['class' => 'form-control hostname-select']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('warning_level_secs', 'Warning Level', ['class' => 'control-label']) !!}
                        {!! Form::text('warning_level_secs', '', ['class' => 'form-control view-order-table-col', 'autofocus' => 'autofocus']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('error_level_secs', 'Error Level', ['class' => 'control-label']) !!}
                        {!! Form::text('error_level_secs', '', ['class' => 'form-control view-order-table-col']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/alert/repllag" class="btn btn-danger">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection
