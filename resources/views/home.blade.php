@extends('layouts.backend')

@section('content')
<div class="container">
     <div  class="row justify-content-center">
        <div>
            <div class="block block-rounded mt-5">
                <div id="home-container" class="block-content p-5">
                @if (session('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                         {{ session('error') }}
                    </div>
               @endif
               @if (session('message'))
                    <div class="alert alert-info mt-3" role="alert">
                         {{ session('message') }}
                    </div>
               @endif

               <h1 class="ta-c">Welcome to Royce Consulting Database Monitor application</h1>


               <div class="home-font">
               This site demonstrates the programming skills of Ronald Royce using the following technologies:
               </div>
               <ul class="mt-2">
               <li class="home-font">Laravel Framework 5.7</li>
               <li class="home-font">Vue.js</li>
               <li class="home-font">PHP 7.1</li>
               <li class="home-font">Javascript</li>
               <li class="home-font">HTML</li>
               <li class="home-font">jQuery</li>
               <li class="home-font">Ajax</li>
               <li class="home-font">SASS</li>
               </ul>
            </div>
        </div>
    </div>


</div>
@endsection
