<header id="masthead" class="site-header header-v2">
    <div class="container">
        <div class="row">

            @include('layouts.front.header.header-logo')

            @include('layouts.front.navigation.primary-nav')

            @include('layouts.front.header.header-support-info')

        </div><!-- /.row -->
    </div>

    <div class="container hidden-lg-up">

        @include('layouts.front.header.handheld-navigation')

    </div>

</header><!-- #masthead -->
<nav class="navbar navbar-primary navbar-full hidden-md-down">
    <div class="container">
        @include('layouts.front.header.navbar-search')
        @include('layouts.front.header.navbar-right')
    </div>
</nav>