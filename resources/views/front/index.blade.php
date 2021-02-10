@extends('layouts.front.app')
@section('og')
    <meta property="og:type" content="home"/>
    <meta property="og:title" content="{{ config('app.name') }}"/>
    <meta property="og:description" content="{{ config('app.name') }}"/>
@endsection

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <div class="row">
                @include('front.blocks.homepage.home-v2-slider')
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 hidden-md-down">
                @include('front.categories.sidebar-category')
            </div>

            <div class="col-md-9 col-sm-12 col-xs-12">   
                @include('front.blocks.homepage.features-list')
                @include('front.blocks.homepage.best-deals')
                @include('front.blocks.homepage.product-carousel-tab')
                
            </div><!-- #primary -->

        </div><!-- .container -->
    </div><!-- #content -->
@endsection