@extends('layouts.backend')

@section('content')
<div class="content">


        {!! Form::open(['url' => 'admin/dnsalias/performdeletednsalias']) !!}
        <input type="hidden" id="alias_id" name="alias_id" value="{{$alias->alias_id}}" />

        <div class="row justify-content-center">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="alert alert-danger">
                Are you sure you wish to delete this DNS alias?
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Delete', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/dnsalias" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
