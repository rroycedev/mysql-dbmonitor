@extends('layouts.backend')

@section('content')
<detailscomponent  ref="navbar" environment-id="0" environment-name="" datacenter-id="0" datacenter-name="" cluster-id="0" cluster-name="" objects="{{json_encode($environments)}}" object-type="environment" object-name="Environment"></detailscomponent>
@endsection
