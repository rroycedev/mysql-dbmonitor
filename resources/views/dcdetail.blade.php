@extends('layouts.backend')

@section('content')
<detailsnav environment-id="{{$environment->environment_id}}" environment-name="{{$environment->name}}" datacenter-id="{{$datacenter->datacenter_id}}" datacenter-name="{{$datacenter->name}}" cluster-id="0" cluster-name=""></detailsnav>
<detailscontent objects="{{json_encode($clusters)}}" object-type="cluster" object-name="Cluster"></detailscontent>
@endsection
