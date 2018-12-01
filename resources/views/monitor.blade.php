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

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block block-rounded block-bordered">
                    <div class="panel-header">
                        <h3 class="panel-title">Monitor</h3>
                    </div>
                    <div class="block-content">
                        <p>
                            We’ve put everything together, so you can start working on your Laravel project as soon as possible! Dashmix assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
                        </p>
                        <p>
                            Feel free to use any examples you like from the full versions to build your own pages. <strong>Wish you all the best and happy coding!</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
