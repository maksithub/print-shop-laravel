<div class="home-v2-ads-block animate-in-view fadeIn animated" data-animation=" animated fadeIn">
    <div class="ads-block row">
        @foreach ($ads as $product)
            <div class="ad col-xs-12 col-sm-6">
              
                <div class="media">
                    <div class="media-left media-middle"><img src="{{asset("storage/$product->cover")}}" alt="" /></div>
                    <div class="media-body media-middle">
                        <div class="ad-text">
                            {{$product->name}}
                        </div>
                        <div class="ad-action">
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
