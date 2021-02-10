
@switch($page)
    @case('home')
        @include('layouts.front.header.header-v1')
        @break
    @case('home-v2')
     	@include('layouts.front.header.header-v2')
        @break
    @case('home-v3')
     	@include('layouts.front.header.header-v3')
        @break
    @case('home-v3-full-color')
        @include('layouts.front.header.header-v3-full-color')
        @break
    @default
    	@include('layouts.front.header.header-v2')
@endswitch
