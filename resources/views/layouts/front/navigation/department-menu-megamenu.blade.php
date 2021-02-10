<ul role="menu" class=" dropdown-menu">
    <li class="menu-item animate-dropdown menu-item-object-static_block">
        <div class="yamm-content">
            <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="wpb_single_image wpb_content_element vc_align_left">
                                <figure class="wpb_wrapper vc_figure">
                                    <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="assets/images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vc_row row wpb_row vc_row-fluid">
                <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <ul>

                                    @foreach($menu_products as $product)
                                        <li>
                                                <a title="{{$product->name}}" 
                                                    @if(request()->segment(2) == $product->slug)
                                                        class="active"
                                                    @endif
                                                    href="{{route('front.get.product', $product->slug)}}">{{$product->name}} 
                                                </a>
                                        </li>
                                    @endforeach

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
