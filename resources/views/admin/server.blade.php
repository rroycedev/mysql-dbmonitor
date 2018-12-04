@extends('layouts.backend')

@section('content')
<div class="content">
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div>
            <div class="block block-rounded">

                <div class="panel-header">
                    <h3 class="panel-title">Servers</h3>
                </div>
                <div class="block-content">
                    <table class="table table-striped table-hover">
                        <thead class="table-thead">
                            <tr>
                                <th class="hostname-table-col">Hostname</th>
                                <th class="ip-address-table-col">IP Address</th>
                                <th class="port-name-table-col">Port</th>
                                <th class="environment-table-col">Environment</th>
                                <th class="datacenter-table-col">Datacenter</th>
                                <th class="cluster-table-col">Cluster</th>
                                <th class="change-delete-btn-table-col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach($servers as $server)
                            <tr>
                                <td class="hostname-table-col ellipsis-text" data-toggle="tooltip" title="{{$server->hostname}}">{{$server->hostname}}</td>
                                <td class="ip-address-table-col">{{$server->ipaddress}}</td>
                                <td class="port-name-table-col">{{$server->port_name}}</td>
                                <td class="environment-table-col">{{$server->environment->name}}</td>
                                <td class="datacenter-table-col">{{$server->datacenter->name}}</td>
                                <td class="cluster-table-col">{{$server->cluster->name}}</td>
                                <td class="change-delete-btn-table-col">
                                    <button class="btn btn-info" onclick="location.href='/admin/server/edit/{{$server->server_id}}'">Edit</button>&nbsp;
                                    <button class="btn btn-info" onclick="location.href='/admin/server/delete/{{$server->server_id}}'">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <a class="btn btn-info" href="/admin/server/add">Add</a>
    </div>
</div>
@endsection
