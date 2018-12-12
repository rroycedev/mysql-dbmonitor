@extends('layouts.backend')



@section('content')
    @section('scripts')

    <script type="text/javascript">

       document.onreadystatechange = function() {
           var state = document.readyState;


            if (state == "complete") {

               // var filterbar = new FilterToolbarModel();
               const app = new Vue({
                      el: '#app'

               });
            }
       }

    </script>

    @endsection

        @yield('scripts')

    <div id="app">
        <monitor-component></monitor-component>
    </div>
    <!-- END Page Content -->
@endsection
