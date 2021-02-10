<section>
    <header>
        <h2 class="h1">Laptops &amp; Computers Categories</h2>
    </header>
    <div class="woocommerce columns-4">
        <ul class="product-loop-categories">
            @foreach ($array as $element)
                <li class="product-category product first"><a href="/"><img src="assets/images/product-category/7.jpg" alt="Accessories" width="250" height="232" /><h3>{{$cat->name}}<mark class="count">(2)</mark></h3></a></li>
            @endforeach
        </ul>
    </div>
</section>
