@extends('layouts.backend')

@section('content')
<div class="content">


        {!! Form::open(['url' => 'admin/server/performupdateserver']) !!}
        <input type="hidden" id="server_id" name="server_id" value="{{$server->server_id}}" />
        @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <div class="row justify-content-center">

            <div>

                <div class="block block-rounded">
                    <div class="panel-header">
                        <h3 class="panel-title">Edit Server</h3>
                    </div>
                    <div class="block-content">
                        <div style="float: left;border: 1px solid lightgray;padding: 10px;">
                            <div class="form-group">
                                {!! Form::label('hostname', 'Hostname', ['class' => 'control-label']) !!}
                                {!! Form::text('hostname', $server->hostname, ['class' => 'form-control hostname-table-col']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('ipaddress', 'IP Address', ['class' => 'control-label']) !!}
                                {!! Form::text('ipaddress', $server->ipaddress, ['class' => 'form-control ip-address-table-col']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('portname', 'Port Name', ['class' => 'control-label']) !!}
                                {!! Form::text('portname', $server->port_name, ['class' => 'form-control port-name-table-col']) !!}
                            </div>
                        </div>
                        <div style="float: left;border: 1px solid lightgray;padding: 10px;margin-left: 10px;">
                            <div class="form-group">
                                {!! Form::label('environment', 'Environment', ['class' => 'control-label']) !!}
                                {!! Form::select('environment', json_decode($environments, true), $server->environment_id, ['class' => 'form-control environment-table-col']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('datacenter', 'Datacenter', ['class' => 'control-label']) !!}
                                {!! Form::select('datacenter', json_decode($datacenters, true), $server->datacenter_id, ['class' => 'form-control datacenter-table-col']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('cluster', 'Cluster', ['class' => 'control-label']) !!}
                                {!! Form::select('cluster', json_decode($clusters, true), $server->cluster_id, ['class' => 'form-control cluster-table-col']) !!}
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div style="margin: auto;border: 1px solid lightgray;padding: 10px;margin-top: 10px;margin-bottom: 20px;padding-left: 13%;padding-top: 15px;">
                            <div style="float: left;">
                                <div class="form-group">
                                    {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
                                    {!! Form::select('active', ['1' => "Yes", '0' => "No"], $server->active, ['class' => 'form-control active-table-col']) !!}
                                </div>
                            </div>
                            <div style="float: left;margin-left: 20px;">
                                <div class="form-group">
                                    {!! Form::label('excludenoc', 'Exclude NOC', ['class' => 'control-label']) !!}
                                    {!! Form::select('excludenoc', ['1' => "Yes", '0' => "No"], $server->exclude_noc, ['class' => 'form-control active-table-col']) !!}
                                </div>
                            </div>
                            <div style="float: left;margin-left: 20px;">
                                <div class="form-group">
                                    {!! Form::label('excludediskcheck', 'Exclude Disk Check', ['class' => 'control-label']) !!}
                                    {!! Form::select('excludediskcheck', ['1' => "Yes", '0' => "No"], $server->exclude_disk_check, ['class' => 'form-control active-table-col']) !!}
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Change', ['class' => 'btn btn-info', 'disabled' => !$canEdit]) !!}&nbsp;<a href="/admin/server" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
