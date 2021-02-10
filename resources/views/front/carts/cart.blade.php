@extends('layouts.front.app')

@section('content')
    <div class="container">
		    <nav class="woocommerce-breadcrumb">
		        <a href="{{url('/')}}">Home</a>
		        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
		        <a href="{{url('/login')}}">Cart</a>
		    </nav><!-- /.woocommerce-breadcrumb -->
            <main id="main" class="site-main">
                <article class="page type-page status-publish hentry">
                    <header class="entry-header"><h1 itemprop="name" class="entry-title">Cart</h1></header><!-- .entry-header -->
                    @include('front.components.cart-table')
                </article>
            </main><!-- #main -->
    </div>
@endsection