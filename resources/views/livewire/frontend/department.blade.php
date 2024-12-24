<div>
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            @foreach($departments as $department)
                            <li><a href="{{route('department',[$department->slug])}}">{{$department->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="row featured__filter" id="MixItUp5C98BA">
                        @if(!empty($products) &&count($products)>0)
                        @foreach($products as $data)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix 2">
                            <div class="featured__item">
                            <div class="featured__item__pic set-bg-1" style="background-image: url({{ asset('storage/'.$data->image)}});">

                                    <ul class="featured__item__pic__hover">
                                        <li>
                                        <a wire:click.prevent="toggleWishlist({{ $data->id }})">
                                            <i class="fa fa-heart" style="color: {{ in_array($data->id, $wishlistItems) ? 'red' : 'gray' }};"></i>
                                        </a>        
                                    </li>
                                        <li><a href="{{route('shop-detail',$data->unique_id)}}"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#" wire:click.prevent="addToCart({{ $data->id }})"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#">{{$data->title}}</a></h6>
                                    <h5>{{$data->price}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>No records found.</p>
                        @endif
                    
            </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
</div>
