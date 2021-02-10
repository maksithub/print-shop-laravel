@extends('layouts.front.app')

@section('content')
<div id="content" class="site-content no-aside" tabindex="-1">
	<div class="container">
		<nav class="woocommerce-breadcrumb"><a href="index.php">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>FAQ</nav>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">				
				@include('front.blocks.faq-content');
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .container -->
</div><!-- #content -->
@endsection
