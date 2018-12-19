@extends('layouts.backend')

@section('content')
<div class="content">
    @section('add-dns-alias-scripts')

    <script type="text/javascript">
    
       document.onreadystatechange = function() {
           var state = document.readyState;

            if (state == "complete") {

               // var filterbar = new FilterToolbarModel();

               var select = document.getElementById('is-vip');

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

        @yield('add-dns-alias-scripts')

        {!! Form::open(['url' => 'admin/dnsalias/performadddnsalias']) !!}
        @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <div class="row justify-content-center">

            <div>

                <div class="block block-rounded">
                    <div class="panel-header">
                        <h3 class="panel-title">Add DNS Alias</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                            {!! Form::text('name', '', ['class' => 'form-control cluster-table-col']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('isvip', 'Is VIP', ['class' => 'control-label']) !!}
                            {!! Form::select('isvip', ['1' => "Yes", '0' => "No"], '0', ['id' => 'is-vip', 'class' => 'form-control active-table-col']) !!}
                        </div>
                        <div id="vip-port-div" class="form-group hidden">
                            {!! Form::label('vipport', 'VIP Port', ['class' => 'control-label']) !!}
                            {!! Form::text('vipport', '', ['class' => 'form-control vip-port']) !!}
                        </div>
                        <div class="form-group mb-5">
                            {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
                            {!! Form::select('active', ['1' => "Yes", '0' => "No"], '1', ['class' => 'form-control active-table-col']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            {!! Form::submit('Add', ['class' => 'btn btn-info', 'disabled' => !$canEdit]) !!}&nbsp;<a href="/admin/dnsalias" class="btn btn-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
</div>
@endsection
