@extends('layouts.backend')

@section('content')
<div class="content">
    {!! Form::open(['url' => 'admin/alert/cpuload/performadd']) !!}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="block block-rounded">
            <div class="panel-header">
                <h3 class="panel-title">Add CPU Load Alert</h3>
            </div>
            <div class="block-content">
                <div class="form-group">
                    {!! Form::label('server', 'Server', ['class' => 'control-label']) !!}
                    {!! Form::select('server', json_decode($servers, true), null, ['class' => 'form-control hostname-select']) !!}
                </div>
                <div>
                    <div class="form-group fl">
                            {!! Form::label('warning_level', 'Warning Level', ['class' => 'control-label']) !!}
                            <div>
                                <div style="float: left;">{!! Form::text('warning_level', '', ['class' => 'form-control alert-level-input']) !!}</div>
                                <div style="clear: both;"></div>
                            </div>
                    </div>
                    <div class="form-group fl ml-5">
                            {!! Form::label('error_level', 'Error Level', ['class' => 'control-label']) !!}
                            <div>
                                <div style="float: left;">{!! Form::text('error_level', '', ['class' => 'form-control alert-level-input']) !!}</div>
                                <div style="clear: both;"></div>
                            </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/alert/cpuload" class="btn btn-danger">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection
