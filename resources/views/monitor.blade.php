@extends('layouts.backend')



@section('content')
    @section('scripts')

    <script type="text/javascript">

       document.onreadystatechange = function() {
           var state = document.readyState;


            if (state == "complete") {

               // var filterbar = new FilterToolbarModel();

            }
       }

    </script>

    @endsection

        @yield('scripts')

    <div id="app" class="content">
        <monitor-component></monitor-component>
    </div>
    <!-- END Page Content -->
@endsection
