@extends('layouts.backend')

@section('content')
<div class="content">


        {!! Form::open(['url' => 'admin/datacenter/performupdatedatacenter']) !!}
        <input type="hidden" id="datacenter_id" name="datacenter_id" value="{{$datacenter->datacenter_id}}" />
        @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <div class="row justify-content-center">

            <div>

                <div class="block block-rounded">
                    <div class="panel-header">
                        <h3 class="panel-title">Edit Datacenter</h3>
                    </div>
                    <div class="block-content">
                    <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                            {!! Form::text('name', $datacenter->name, ['class' => 'form-control datacenter-table-col']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('view_order', 'View Order', ['class' => 'control-label']) !!}
                            {!! Form::text('view_order', $datacenter->view_order, ['class' => 'form-control view-order-table-col']) !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Change', ['class' => 'btn btn-info', 'disabled' => !$canEdit]) !!}&nbsp;<a href="/admin/datacenter" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
