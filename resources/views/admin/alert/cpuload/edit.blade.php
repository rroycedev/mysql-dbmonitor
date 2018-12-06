@extends('layouts.backend')

@section('content')
<div class="content">
    {!! Form::open(['url' => 'admin/alert/cpuload/performupdate']) !!}
    <input type="hidden" id="server_id" name="server_id" value="{{$alert->server_id}}" />
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="block block-rounded">
            <div class="panel-header">
                <h3 class="panel-title">Edit CPU Load Alert</h3>
            </div>
            <div class="block-content">
                <div class="form-group">
                        {!! Form::label('hostname', 'Server Hostname', ['class' => 'control-label', 'style' => 'width: 100%']) !!}
                        {!! Form::text('hostname', $alert->hostname, ['class' => 'form-control cluster-table-col', 'disabled' => 'disabled']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('portname', 'Server Port Name', ['class' => 'control-label', 'style' => 'width: 100%']) !!}
                        {!! Form::text('portname', $alert->port_name, ['class' => 'form-control cluster-table-col', 'disabled' => 'disabled']) !!}
                </div>
                <div>
                    <div class="form-group fl">
                            {!! Form::label('warning_level', 'Warning Level', ['class' => 'control-label']) !!}
                            <div>
                                <div style="float: left;">{!! Form::text('warning_level', $alert->warning_level, ['class' => 'form-control alert-level-load-input']) !!}</div>
                                <div style="clear: both;"></div>
                            </div>
                    </div>
                    <div class="form-group fl ml-5">
                            {!! Form::label('error_level', 'Error Level', ['class' => 'control-label']) !!}
                            <div>
                                <div style="float: left;">{!! Form::text('error_level', $alert->error_level, ['class' => 'form-control alert-level-load-input']) !!}</div>
                                <div style="clear: both;"></div>
                            </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        {!! Form::submit('Change', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/alert/cpuload" class="btn btn-danger">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection
