@extends('layouts.backend')

@section('content')
<div class="content">


        {!! Form::open(['url' => 'admin/datacenter/performdeletedatacenter']) !!}
        <input type="hidden" id="datacenter_id" name="datacenter_id" value="{{$datacenter->datacenter_id}}" />

        <div class="row justify-content-center">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="alert alert-danger">
                Are you sure you wish to delete this datacenter?
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Delete', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/datacenter" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
