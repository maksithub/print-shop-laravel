@extends('layouts.front.app')
@section('content')
<div id="content" class="site-content no-aside" tabindex="-1">
	<div class="container">

		<nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Contactus</nav>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<article class="post-2508 page type-page status-publish hentry" id="post-2508">
					<div itemprop="mainContentOfPage" class="entry-content">
						@include('front.components.contact-map')
						<div class="vc_row-full-width vc_clearfix"></div>
						<div class="vc_row wpb_row vc_row-fluid">
							@include('front.components.contact-form-v1')
							@include('front.components.store-info-v1')
						</div>
					</div>
				</article>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .container -->
</div><!-- #content -->
@endsection