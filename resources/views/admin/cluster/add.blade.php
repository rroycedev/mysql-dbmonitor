@extends('layouts.backend')

@section('content')
<div class="content">


        {!! Form::open(['url' => 'admin/cluster/performaddcluster']) !!}
        @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <div class="row justify-content-center">

            <div>

                <div class="block block-rounded">
                    <div class="panel-header">
                        <h3 class="panel-title">Add Cluster</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                            {!! Form::text('name', '', ['class' => 'form-control cluster-table-col']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('parent_cluster', 'Parent Cluster', ['class' => 'control-label']) !!}
                            {!! Form::select('parent_cluster', json_decode($clusters, true), null, ['class' => 'form-control cluster-table-col']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('view_order', 'View Order', ['class' => 'control-label']) !!}
                            {!! Form::text('view_order', '', ['class' => 'form-control view-order-table-col']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Add', ['class' => 'btn btn-info', 'disabled' => !$canEdit]) !!}&nbsp;<a href="/admin/cluster" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
