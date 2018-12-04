@extends('layouts.backend')

@section('content')
<div class="content">
    @section('change-dns-alias-scripts')

    <script type="text/javascript">
    
    document.onreadystatechange = function() {
        var state = document.readyState;

        if (state == "complete") {
            var select = document.getElementById('is-vip');

            if (select.value == "1") {
                $('#vip-port-div').show();
            }

            select.addEventListener('change', function() {
                if (select.value == "0") {
                    $('#vip-port-div').hide();
                }
                else {
                    $('#vip-port-div').show();
                }
                
            });
        }
    }

    </script>

    @endsection

    @yield('change-dns-alias-scripts')

    {!! Form::open(['url' => 'admin/dnsalias/performupdatednsalias']) !!}
    <input type="hidden" id="alias_id" name="alias_id" value="{{$alias->alias_id}}" />
    @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    <div class="row justify-content-center">

        <div>

            <div class="block block-rounded">
                <div class="panel-header">
                    <h3 class="panel-title">Edit DNS Alias</h3>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                        {!! Form::text('name', $alias->name, ['class' => 'form-control cluster-table-col']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('isvip', 'Is VIP', ['class' => 'control-label']) !!}
                        {!! Form::select('isvip', ['1' => "Yes", '0' => "No"], $alias->is_vip, ['id' => 'is-vip', 'class' => 'form-control active-table-col']) !!}
                    </div>
                    <div id="vip-port-div" class="form-group hidden">
                        {!! Form::label('vipport', 'VIP Port', ['class' => 'control-label']) !!}
                        {!! Form::text('vipport', $alias->is_vip ? $alias->vip_port : "", ['class' => 'form-control vip-port']) !!}
                    </div>
                    <div class="form-group mb-5">
                        {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
                        {!! Form::select('active', ['1' => "Yes", '0' => "No"], $alias->active, ['class' => 'form-control active-table-col']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        {!! Form::submit('Change', ['class' => 'btn btn-info']) !!}&nbsp;<a href="/admin/dnsalias" class="btn btn-danger">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection
