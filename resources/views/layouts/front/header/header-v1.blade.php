<header id="masthead" class="site-header header-v1">
    <div class="container hidden-md-down">
        <div class="row">
            
            @include('layouts.front.header.header-logo')

            @include('layouts.front.header.navbar-search')

            @include('layouts.front.header.navbar-right')

        </div><!-- /.row -->

        <div class="row header_menu">
            <div class="col-xs-12 col-lg-12">
                @include('layouts.front.navigation.secondary-menu')
            </div>
        </div>
    </div>

    <div class="container hidden-lg-up">

        @include('layouts.front.header.handheld-navigation')

    </div>
</header><!-- #masthead -->