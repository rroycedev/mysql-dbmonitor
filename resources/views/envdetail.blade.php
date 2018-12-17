@extends('layouts.backend')

@section('content')
<detailscomponent  ref="navbar" environment-id="{{$environment->environment_id}}" environment-name="{{$environment->name}}" datacenter-id="0" datacenter-name="" cluster-id="0" cluster-name="" objects="{{json_encode($datacenters)}}" object-type="datacenter" object-name="Datacenter"></detailscomponent>
@endsection
