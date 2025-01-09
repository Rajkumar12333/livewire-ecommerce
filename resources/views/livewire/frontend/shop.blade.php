
    <!-- Product Section Begin -->
    <section class="product spad">
        <style>
             .sidebar__item ul li.selected {
                background-color: #f0f0f0; /* Highlight background */
                font-weight: bold; /* Optional: Make the text bold */
            }

        </style>
        <style>

</style>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Department</h4>
                        <ul>
                            @foreach($department as $departments)
                            <li class="{{ $departments->id == $category ? 'selected' : '' }}">
                                <a href="#" wire:click.prevent="$set('category', {{ $departments->id }})">{{ $departments->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap" wire:ignore>
    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
        data-min="1" 
        data-max="600"
        id="price-range-slider">
        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
    </div>
    <div class="range-slider">
        <div class="price-input">
            <input type="text" id="minamount" wire:model="minPrice" placeholder="Min Price" readonly>
            <input type="text" id="maxamount" wire:model="maxPrice" placeholder="Max Price" readonly>
        </div>
    </div>
</div>


                        </div>
                        <div class="sidebar__item">
                            <h4>Colors</h4>
                            @foreach($colors as $data)
                            @php
                                $colorClass = strtolower(str_replace(' ', '-', $data->title)); // Ensure class names are valid
                                $colorHex = $data->color_code; // Assuming you have a `hex_value` property for the color
                            @endphp
                            <style>
                                .sidebar__item__color.{{ $colorClass }} label:after {
                                    border: 1px solid;
                                    background: {{ $colorHex }} !important; /* Use the hex value for background */
                                    
                                }
                            </style>
                            <div class="sidebar__item__color {{ $colorClass }}">
                                <label for="{{ $colorClass }}-circle" class="{{ $colorClass }}-circle " wire:click="colorChange({{$data->id}})">
                                    {{ $data->title }}
                                    <input type="radio" wire:model="color" wire:click.prevent="$set('color', {{ $data->id }})" value="{{ $data->id }}" id="{{ $colorClass }}">
                                </label>
                            </div>
                        @endforeach

                        </div>
                        <div class="sidebar__item">
            <h4>Popular Size 1</h4>
            @foreach($sizes as $data)
            
            <div class="sidebar__item__size">
                <label for="{{ $data->title }} {{ $data->id == $size ? 'selected' : '' }}" wire:click.prevent="$set('size', {{ $data->id }})">
                    {{ $data->title }}
                    <input type="radio" wire:model="size"   value="{{ $data->id }}" id="{{ $data->title }}">
                </label>
            </div>
            @endforeach
            <button wire:click="resetValues">Reset Filter</button>
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
                                                    <img src="{{ asset('storage/' . ($latest->image ?? 'images/default.png')) }}" alt="{{ $latest->title }}">
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
                    <livewire:frontend.shop-search />
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
                    <!-- Color :{{$color}} , Size:{{$size}} ,Department {{$category}} -->
                    @if(!empty($product) && count($product)>0)
                    @foreach($product as $data)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <!-- Wrap the product image in a link -->
                            <a href="{{ route('shop-detail', $data->unique_id) }}">
                                <div class="product__item__pic set-bg-1" style="background-image: url({{ asset('storage/'. ($data->image ?? 'images/default.png'))}});">
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
                @else
                    <p>No Records found</p>
                @endif

</div>



                  
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    function initializeSlider() {
        // Initialize the slider
        $("#price-range-slider").slider({
            range: true, // Enable the range selection
            min: 1,
            max: 600,
            values: [@this.get('minPrice') || 1, @this.get('maxPrice') || 600], // Use Livewire values as default
            slide: function (event, ui) {
                // Update the min and max input fields dynamically
                $('#minamount').val(ui.values[0]);
                $('#maxamount').val(ui.values[1]);

                // Update the range background dynamically
                updateSliderRange(ui.values[0], ui.values[1]);

                // Update Livewire properties
                @this.set('minPrice', ui.values[0]);
                @this.set('maxPrice', ui.values[1]);
            }
        });

        // Initial range background update
        updateSliderRange($("#price-range-slider").slider("values", 0), $("#price-range-slider").slider("values", 1));
    }

    // Function to update the slider's range color dynamically
    function updateSliderRange(min, max) {
        var totalRange = 600 - 1; // Total range of the slider
        var minPercent = ((min - 1) / totalRange) * 100; // Min position as percentage
        var maxPercent = ((max - 1) / totalRange) * 100; // Max position as percentage

        // Apply the gradient for the slider range
        $("#price-range-slider .ui-slider-range").css({
            left: minPercent + "%", // Start position
            width: (maxPercent - minPercent) + "%", // Width of the range
        });
    }

    // Initialize the slider
    initializeSlider();

    // Listen for Livewire updates and reinitialize the slider
    Livewire.on('refreshSlider', function () {
        $("#price-range-slider").slider("destroy"); // Destroy the previous instance
        initializeSlider(); // Reinitialize the slider
    });
});

</script>
    </section>
    <!-- Product Section End -->