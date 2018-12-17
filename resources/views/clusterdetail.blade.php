@extends('layouts.backend')

@section('content')
<detailsnav environment-id="{{$environment->environment_id}}" environment-name="{{$environment->name}}" datacenter-id="{{$datacenter->datacenter_id}}" datacenter-name="{{$datacenter->name}}" cluster-id="{{$cluster->cluster_id}}" cluster-name="{{$cluster->name}}"></detailsnav>
<detailscontent objects="{{json_encode($servers)}}" object-type="server" object-name="Server"></detailscontent>
@endsection
