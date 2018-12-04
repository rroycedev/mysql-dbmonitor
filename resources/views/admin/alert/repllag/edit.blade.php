@extends('layouts.backend')

@section('content')
<div class="content">
    {!! Form::open(['url' => 'admin/cluster/performupdaterepllagalert']) !!}
    <input type="hidden" id="server_id" name="server_id" value="{{$alert->server_id}}" />
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div>
            <div class="block block-rounded">
                <div class="panel-header">
                    <h3 class="panel-title">Edit Replication Alert</h3>
                </div>
                <div class="block-content">
                    <div class="form-group">
                            {!! Form::label('hostname', 'Server Hostname', ['class' => 'control-label']) !!}
                            {!! Form::text('hostname', $alert->hostname, ['class' => 'form-control cluster-table-col']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('portname', 'Server Port Name', ['class' => 'control-label']) !!}
                        {!! Form::text('portname', $alert->port_name, ['class' => 'form-control cluster-table-col']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('warning_level_secs', 'Warning Level', ['class' => 'control-label']) !!}
                        {!! Form::text('warning_level_secs', $alert->warning_level_secs, ['class' => 'form-control view-order-table-col']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('error_level_secs', 'Error Level', ['class' => 'control-label']) !!}
                        {!! Form::text('error_level_secs', $alert->error_level_secs, ['class' => 'form-control view-order-table-col']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        {!! Form::submit('Change', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/alert/repllag" class="btn btn-danger">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection
