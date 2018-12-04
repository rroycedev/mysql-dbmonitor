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
                    <h3 class="panel-title">Environments</h3>
                </div>
                <div class="block-content">
                    <table class="table table-striped table-hover">
                        <thead class="table-thead">
                            <tr>
                                <th class="environment-table-col">Name</th>
                                <th class="view-order-table-col">View Order</th>
                                <th class="change-delete-btn-table-col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach($environments as $env)
                            <tr>
                                <td class="environment-table-col ellipsis-text" data-toggle="tooltip" title="{{$env->name}}">{{$env->name}}</td>
                                <td class="view-order-table-col">{{$env->view_order}}</td>
                                <td class="change-delete-btn-table-col">
                                    <button class="btn btn-info" onclick="location.href='/admin/environment/edit/{{$env->environment_id}}'">Edit</button>&nbsp;
                                    <button class="btn btn-info" onclick="location.href='/admin/environment/delete/{{$env->environment_id}}'">Delete</button>
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
        <a class="btn btn-info" href="/admin/environment/add">Add</a>
    </div>
</div>

@endsection
