@extends('layouts.backend')

@section('content')
<div class="content">
    {!! Form::open(['url' => 'admin/alert/disk/performadd']) !!}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="block block-rounded">
            <div class="panel-header">
                <h3 class="panel-title">Add Disk Alert</h3>
            </div>
            <div class="block-content">
                <div class="form-group">
                    {!! Form::label('server', 'Server', ['class' => 'control-label']) !!}
                    {!! Form::select('server', json_decode($servers, true), null, ['class' => 'form-control hostname-select']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('volume', 'Volume', ['class' => 'control-label']) !!}
                        {!! Form::text('volume', '', ['class' => 'form-control volume-table-col', 'autofocus' => 'autofocus']) !!}
                </div>
                <div>
                    <div class="form-group fl">
                            {!! Form::label('warning_level_pct', 'Warning Level', ['class' => 'control-label']) !!}
                            <div>
                                <div style="float: left;">{!! Form::text('warning_level_pct', '', ['class' => 'form-control alert-level-input']) !!}</div>
                                <div class="percent-label">%</div>
                                <div style="clear: both;"></div>
                            </div>
                    </div>
                    <div class="form-group fl ml-5">
                            {!! Form::label('error_level_pct', 'Error Level', ['class' => 'control-label']) !!}
                            <div>
                                <div style="float: left;">{!! Form::text('error_level_pct', '', ['class' => 'form-control alert-level-input']) !!}</div>
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
        {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/alert/disk" class="btn btn-danger">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection
