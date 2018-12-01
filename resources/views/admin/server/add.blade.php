@extends('layouts.backend')

@section('content')
<div class="content">


        <div class="row justify-content-center">
            <div>
                <div class="block block-rounded">
                    <div class="panel-header">
                        <h3 class="panel-title">Add Server</h3>
                    </div>
                    <div class="block-content">
                        {!! Form::open(['url' => 'admin/server/performaddserver']) !!}    
                        <div class="form-group">
                            {!! Form::label('hostname', 'Hostname', ['class' => 'control-label']) !!}
                            {!! Form::text('hostname', '', ['class' => 'form-control hostname-table-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('ipaddress', 'IP Address', ['class' => 'control-label']) !!}
                            {!! Form::text('ipaddress', '', ['class' => 'form-control ip-address-table-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('portname', 'Port Name', ['class' => 'control-label']) !!}
                            {!! Form::text('portname', '', ['class' => 'form-control port-name-table-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('environment', 'Environment', ['class' => 'control-label']) !!}
                            {!! Form::select('environment', json_decode($environments, true), null, ['class' => 'form-control environment-table-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('datacenter', 'Datacenter', ['class' => 'control-label']) !!}
                            {!! Form::select('datacenter', json_decode($datacenters, true), null, ['class' => 'form-control datacenter-table-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('cluster', 'Cluster', ['class' => 'control-label']) !!}
                            {!! Form::select('cluster', json_decode($clusters, true), null, ['class' => 'form-control cluster-table-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('vieworder', 'View Order', ['class' => 'control-label']) !!}
                            {!! Form::text('vieworder', '', ['class' => 'form-control view-order-table-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
                            {!! Form::checkbox('active', '', false, ['class' => 'checkbox-form-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('excludenoc', 'Exclude NOC', ['class' => 'control-label']) !!}
                            {!! Form::checkbox('excludenoc', '', false, ['class' => 'checkbox-form-col']) !!} 
                        </div>
                        <div class="form-group">
                            {!! Form::label('excludediskcheck', 'Exclude Disk Check', ['class' => 'control-label']) !!}
                            {!! Form::checkbox('excludediskcheck', '', false, ['class' => 'checkbox-form-col']) !!} 
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-info">Add</button>
        </div>
</div>
@endsection
