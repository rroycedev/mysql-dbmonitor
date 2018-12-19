@extends('layouts.backend')

@section('content')
<div class="content">
    {!! Form::open(['url' => 'admin/alert/disk/performupdate']) !!}
    <input type="hidden" id="alert_id" name="alert_id" value="{{$alert->alert_id}}" />
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="block block-rounded">
            <div class="panel-header">
                <h3 class="panel-title">Edit Disk Alert</h3>
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
                <div class="form-group">
                        {!! Form::label('volume', 'Volume', ['class' => 'control-label']) !!}
                        {!! Form::text('volume', $alert->volume, ['class' => 'form-control volume-table-col', 'autofocus' => 'autofocus']) !!}
                </div>
                <div>
                    <div class="form-group fl">
                            {!! Form::label('warning_level_pct', 'Warning Level', ['class' => 'control-label']) !!}
                            <div>
                                <div style="float: left;">{!! Form::text('warning_level_pct', $alert->warning_level_pct, ['class' => 'form-control alert-level-input']) !!}</div>
                                <div class="percent-label">%</div>
                                <div style="clear: both;"></div>
                            </div>
                    </div>
                    <div class="form-group fl ml-5">
                            {!! Form::label('error_level_pct', 'Error Level', ['class' => 'control-label']) !!}
                            <div>
                                <div style="float: left;">{!! Form::text('error_level_pct', $alert->error_level_pct, ['class' => 'form-control alert-level-input']) !!}</div>
                                <div class="percent-label">%</div>
                                <div style="clear: both;"></div>
                            </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        {!! Form::submit('Change', ['class' => 'btn btn-info', 'disabled' => !$canEdit]) !!}&nbsp;<a href="/admin/alert/disk" class="btn btn-danger">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection
