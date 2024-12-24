<?php //echo "<pre>";print_r($product);die();?>
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Department</h4>
                        <ul>
                            @foreach($department as $departments)
                            <li>
                                <a href="#" wire:click.prevent="$set('category', {{ $departments->id }})">{{ $departments->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Colors</h4>
                            @foreach($colors as $color)
                            <div class="sidebar__item__color">
                                <label for="{{ $color->title }}">
                                    {{ $color->title }}
                                    <input type="radio" wire:model="color" value="{{ $color->id }}" id="{{ $color->title }}">
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="sidebar__item">
            <h4>Popular Size</h4>
            @foreach($sizes as $size)
            <div class="sidebar__item__size">
                <label for="{{ $size->title }}">
                    {{ $size->title }}
                    <input type="radio" wire:model="size" value="{{ $size->id }}" id="{{ $size->title }}">
                </label>
            </div>
            @endforeach
        </div>
                        <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Latest Products</h4>
                            <div class="latest-product__slider owl-carousel">
                                @foreach ($latest_product->chunk(3) as $chunk)
                                    <div class="latest-product__slider__item">
                                        @foreach ($chunk as $latest)
                                            <a href="{{route('shop-detail',$latest->unique_id)}}" class="latest-product__item" >
                                                <div class="latest-product__item__pic">
                                                    <img src="{{ asset('storage/' . $latest->image) }}" alt="{{ $latest->title }}">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{ $latest->title }}</h6>
                                                    <span>${{ number_format($latest->price, 2) }}</span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{count($product)}}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                    @foreach($product as $data)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <!-- Wrap the product image in a link -->
                            <a href="{{ route('shop-detail', $data->unique_id) }}">
                                <div class="product__item__pic set-bg-1" style="background-image: url({{ asset('storage/'.$data->image)}});">
                                    <ul class="product__item__pic__hover">
                                    <li>
                                        <a wire:click.prevent="toggleWishlist({{ $data->id }})">
                                            <i class="fa fa-heart" style="color: {{ in_array($data->id, $wishlistItems) ? 'red' : 'gray' }};"></i>
                                        </a>
                                    </li>

                                        
                                        <li><a href="{{route('shop-detail',$data->unique_id)}}" ><i class="fa fa-retweet"></i></a></li>
                                        <li>
                                            <a href="#" wire:click.prevent="addToCart({{ $data->id }})">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </a>
                            <div class="product__item__text">
                                <h6><a href="{{ route('shop-detail', $data->unique_id) }}">{{ $data->title ?? '' }}</a></h6>
                                <h5>{{ $data->price ?? '' }}</h5>
                                
                            </div>
                        </div>
                    </div>
                @endforeach

</div>



                  
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->