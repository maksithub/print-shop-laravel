<div class="handheld-header">
	<div class="handheld-navigation-wrapper">	
		<div class="handheld-navbar-toggle-buttons clearfix">
			@include('layouts.front.header.header-logo')
			<button class="navbar-toggler navbar-toggle-hamburger hidden-lg-up pull-right flip" type="button"> 
				<i class="fa fa-bars" aria-hidden="true"></i> 
			</button> 
			<button class="navbar-toggler navbar-toggle-close hidden-lg-up pull-right flip" type="button"> 
				<i class="ec ec-close-remove"></i> 
			</button>
		</div>	
		<div class="handheld-navigation hidden-lg-up" id="default-hh-header"> 
			<span class="ehm-close" style="display: none;">Close</span>
			<ul id="nav navbar-nav departments-menu animate-dropdown" class="nav nav-inline yamm">


        @foreach ($categories as $category)
            <?php $featured = array("Banners", "Boxes", "Brochure Printing", "Business Cards", "Flyers", "Labels", "Signs", "Postcards", "Stickers"); ?>
            @if(!in_array($category->name, $featured))
                @if(get_class($category) == 'App\\Shop\\Products\\Product')
                    <li class="highlight menu-item animate-dropdown">
                        <a title="{{$category->name}}" 
                            @if(request()->segment(1) == $category->slug)
                                class="active"
                            @endif
                            href="{{route('front.get.product', $category->slug)}}">{{$category->name}}
                        </a>
                    </li>
                @else
                    <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
                        <a title="{{$category->name}}" href="{{route('front.category.slug', $category->slug)}}" class="dropdown">{{$category->name}}</a>
                        @include('front.categories.sidebar-category-products', ['menu_products' => $category->products])
                    </li>
                @endif
            @endif
        @endforeach

			</ul>


		</div>
	</div>
</div>

<style type="text/css">
	.navbar-toggle-close{
		display: none;
	}
	.handheld-navigation{
		display: none;
		position: absolute;
		top: 100px;
		left: 0;
		right: 0;
		z-index: 100;
		background: #fff;
		padding: 15px 30px;
		max-height: 450px;
		overflow: scroll;
		border-bottom: 2px solid #00abc5;
	}

</style>
<script type="text/javascript">
$(document).ready(function(){
	$(".navbar-toggle-hamburger").click(function(){
		$(".handheld-navigation").slideDown();
		$(this).hide();
		$(".navbar-toggle-close").show();
	});
	$(".navbar-toggle-close").click(function(){
		$(".handheld-navigation").slideUp();
		$(this).hide();
		$(".navbar-toggle-hamburger").show();
	});

	$("li.menu-item-has-children a.dropdown").click(function(e){
		e.preventDefault();
		if (! $(this).hasClass("opened")) {
			$(this).next(".submenu").slideDown();
			$(this).addClass("opened");
		}else{
			$(this).next(".submenu").slideUp();
			$(this).removeClass("opened");
		}
	});
});
</script>