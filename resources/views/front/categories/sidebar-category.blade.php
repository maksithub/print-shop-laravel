<aside class="widget widget-product-category side-menu">
    <div class="widget-title">Popular Products</div>
    <ul id="menu-vertical-menu" class="sidebar_category_menu">
        <li class="yamm-tfw menu-item menu-item-has-children">
            <a title="Banners" href="{{url('/category/banners')}}" data-toggle="" class="menu-dropdown" aria-haspopup="true">
            <img src="{{asset('/assets/images/left-menu/icon-banners.svg')}}" alt="product-icon">Banners</a>
            @include('front.categories.sidebar-category-products', ['menu_products' => $banners->products])
        </li>
        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
            <a title="Banners" href="{{url('/product/brochure-printing')}}" aria-haspopup="true">
            <img src="{{asset('/assets/images/left-menu/icon-brochure.svg')}}" alt="product-icon">Brochures</a>
        </li>
        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
            <a title="Banners" href="{{url('/category/business-cards')}}" class="dropdown" aria-haspopup="true">
            <img src="{{asset('/assets/images/left-menu/icon-business_card.svg')}}" alt="product-icon">Business Cards</a>
            @include('front.categories.sidebar-category-products', ['menu_products' => $businesscards->products])
        </li>
        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
            <a title="Banners" href="{{url('/category/flyers')}}" class="dropdown" aria-haspopup="true">
            <img src="{{asset('/assets/images/left-menu/icon-flyers.svg')}}" alt="product-icon">Flyers</a>
            @include('front.categories.sidebar-category-products', ['menu_products' => $flyers->products])
        </li>
        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
            <a title="Banners" href="{{url('/category/labels')}}" class="dropdown" aria-haspopup="true">
            <img src="{{asset('/assets/images/left-menu/icon-labels.svg')}}" alt="product-icon">Labels</a>
            @include('front.categories.sidebar-category-products', ['menu_products' => $labels->products])
        </li>
        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
            <a title="Banners" href="{{url('/category/signs')}}" class="dropdown" aria-haspopup="true">
            <img src="{{asset('/assets/images/left-menu/icon-signs.svg')}}" alt="product-icon">Signs</a>
            @include('front.categories.sidebar-category-products', ['menu_products' => $signs->products])
        </li>
        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown">
            <a title="Banners" href="{{url('/category/postcards')}}" class="dropdown" aria-haspopup="true">
            <img src="{{asset('/assets/images/left-menu/icon-postcard.svg')}}" alt="product-icon">Postcards</a>
            @include('front.categories.sidebar-category-products', ['menu_products' => $postcards->products])
        </li>
        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown featured_last">
            <a title="Banners" href="{{url('/category/stickers')}}" class="dropdown" aria-haspopup="true">
            <img src="{{asset('/assets/images/left-menu/icon-stickers.svg')}}" alt="product-icon">Stickers</a>
            @include('front.categories.sidebar-category-products', ['menu_products' => $stickers->products])
        </li>
        
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
</aside>