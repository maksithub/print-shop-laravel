<nav id="blog-navigation" class="blog-navigation navbar yamm" aria-label="Blog Navigation">
	<div class="navbar-header">
		<button class="navbar-toggle collapsed" data-target="#nav-blog-horizontal-menu-collapse" data-toggle="collapse" type="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		</div><!-- .navbar-header -->

	<div class="nav-bg-class">
		<div class="collapse navbar-collapse" id="nav-blog-horizontal-menu-collapse">
			<div class="nav-outer">
				<ul class="nav list-unstyled blog-nav-menu">
					@foreach ($cats as $cat)
						<li class="menu-item animate-dropdown"><a title="Technology" href="{{}}">{{$cat->name}}</a></li>
					@endforeach
					
				</ul><!-- .blog-nav-menu -->						
			</div><!-- .nav-outer -->
			<div class="clearfix"></div>
		</div><!-- /.navbar-collapse -->
	</div><!-- .nav-bg-class -->
</nav><!-- #blog-navigation -->