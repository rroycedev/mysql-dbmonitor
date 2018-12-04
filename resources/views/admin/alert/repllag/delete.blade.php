@extends('layouts.backend')

@section('content')
<div class="content">


        {!! Form::open(['url' => 'admin/cluster/performdeletecluster']) !!}
        <input type="hidden" id="cluster_id" name="cluster_id" value="{{$cluster->cluster_id}}" />

        <div class="row justify-content-center">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="alert alert-danger">
                Are you sure you wish to delete this cluster?
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Delete', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/cluster" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
