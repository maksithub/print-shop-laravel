<aside class="widget widget_electro_products_carousel_widget">
    <section class="section-products-carousel" >


        <header>

            <h1>Featured Products</h1>

            <div class="owl-nav">
                <a href="#products-carousel-prev" data-target="#products-carousel-57176fb2dc4a8" class="slider-prev"><i class="fa fa-angle-left"></i></a>
                <a href="#products-carousel-next" data-target="#products-carousel-57176fb2dc4a8" class="slider-next"><i class="fa fa-angle-right"></i></a>
            </div>

        </header>


        <div id="products-carousel-57176fb2dc4a8">
            <div class="products owl-carousel  products-carousel-widget columns-1">

                @foreach ($features as $product)
                <div class="product-carousel-alt">
                    <a href="{{ route('front.get.product', str_slug($product->slug)) }}">
                        <div class="product-thumbnail"><img width="250" height="232" src="{{ asset("storage/$product->cover") }}" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="Smartwatch2" /></div>
                    </a>

                    <a href="{{ route('front.get.product', $product->slug) }}"><h3>{{$product->name}}</h3></a>
                    <span class="price"><span class="electro-price"><span class="amount">{{$product->price}}</span></span></span>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</aside>
