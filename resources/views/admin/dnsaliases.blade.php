@extends('layouts.backend')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div>
            <div class="block block-rounded">
                <div class="panel-header">
                    <h3 class="panel-title">DNS Aliases</h3>
                </div>
                <div class="block-content">
                    @if (session('msg'))
                         <div class="alert alert-success">
                              {{ session('msg') }}
                         </div>
                    @endif
                    <table class="table table-striped table-hover">
                        <thead class="table-thead">
                            <tr>
                                <th class="dns-alias-name">Name</th>
                                <th class="view-order-table-col">Is VIP</th>
                                <th class="view-order-table-col">VIP Port</th>
                                <th class="view-order-table-col">Active</th>
                                <th class="change-delete-btn-table-col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach($aliases as $alias)
                            <tr>
                                <td class="dns-alias-name ellipsis-text" data-toggle="tooltip" title="{{$alias->name}}">{{$alias->name}}</td>
                                <td class="view-order-table-col">{{$alias->is_vip ? "Yes" : "No"}}</td>
                                <td class="view-order-table-col">{{$alias->is_vip == "1" ? $alias->vip_port : ""}}</td>
                                <td class="view-order-table-col">{{$alias->active ? "Yes" : "No"}}</td>
                                <td class="change-delete-btn-table-col">
                                    <button class="btn btn-info" onclick="location.href='/admin/dnsalias/edit/{{$alias->alias_id}}'">Edit</button>&nbsp;
                                    <button class="btn btn-info" onclick="location.href='/admin/dnsalias/delete/{{$alias->alias_id}}'">Delete</button>
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
        <a class="btn btn-info" href="/admin/dnsalias/add">Add</a>
    </div>
</div>
@endsection
