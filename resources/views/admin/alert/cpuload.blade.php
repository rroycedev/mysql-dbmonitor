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
                    <h3 class="panel-title">CPU Load Alerts</h3>
                </div>
                <div class="block-content">
                    <table class="table table-striped table-hover">
                        <thead class="table-thead">
                            <tr>
                                <th class="hostname-table-col">Server Hostname</th>
                                <th class="port-name-table-col">Server Port Name</th>
                                <th class="alert-level-secs">Warning Level</th>
                                <th class="alert-level-secs">Error Level</th>
                                <th class="change-delete-btn-table-col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach($alerts as $alert)
                            <tr>
                                <td class="hostname-table-col ellipsis-text" data-toggle="tooltip" title="">{{$alert->hostname}}</td>
                                <td class="port-name-table-col ellipsis-text" data-toggle="tooltip" title="">{{$alert->port_name}}</td>
                                <td class="alert-level-secs">{{$alert->warning_level}}</td>
                                <td class="alert-level-secs">{{$alert->error_level}}</td>
                                <td class="change-delete-btn-table-col">
                                    <button class="btn btn-info" onclick="location.href='/admin/alert/cpuload/edit/{{$alert->server_id}}'">Edit</button>&nbsp;
                                    <button class="btn btn-info" onclick="location.href='/admin/alert/cpuload/delete/{{$alert->server_id}}'">Delete</button>
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
            <a class="btn btn-info" href="/admin/alert/cpuload/add">Add</a>
    </div>
</div>
@endsection
