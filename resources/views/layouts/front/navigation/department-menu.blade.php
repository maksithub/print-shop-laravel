
<nav class="nav navbar-nav navbar-primary departments-menu">
    <li class="nav-item dropdown <?php echo ( $page == 'home-v2' ? 'open' : '' ); ?>">

        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle" >Shop by Department</a>
        <ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown">
            @foreach ($categories as $category)
                @if(get_class($category) == 'App\\Shop\\Products\\Product')
                    <li class="menu-item animate-dropdown"><a title="{{$category->name}}" href="{{route('front.get.product', $category->slug)}}">{{$category->name}}</a></li>
                @else
                    <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2590 dropdown">

                        <a title="{{$category->name}}" href="{{route('front.category.slug', $category->slug)}}" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">{{$category->name}}</a>
                        @include('layouts.front.navigation.department-menu-megamenu', ['menu_products' => $category->products])
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
</nav>
