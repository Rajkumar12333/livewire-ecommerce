<div>


    <div class="row">
    @if(!empty($wishlistProducts) && count($wishlistProducts)>0)
    @foreach($wishlistProducts as $product)
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                    </a><div class="product__item__pic set-bg-1" style="background-image: url('{{ asset('storage/' . ($product->image ?? 'images/default.png')) }}');">
                                        <ul class="product__item__pic__hover">
                                            <li>
                                            <a wire:click.prevent="toggleWishlist({{ $product->id }})">
                                            <i class="fa fa-heart" style="color: {{ in_array($product->id, $wishlistItems) ? 'red' : 'gray' }};"></i>
                                        </a>
                                        </li>
    
                                            
                                            <li><a href="{{route('shop-detail',$product->unique_id)}}"><i class="fa fa-retweet"></i></a></li>
                                            <li>
                                            <a href="#" wire:click.prevent="addToCart({{ $product->id }})"><i class="fa fa-shopping-cart"></i></a>
                                            </li>
    
                                        </ul>
                                    </div>
                                
                                <div class="product__item__text">
                                    <h6><a href="http://ecommerce.localhost.com/shop-detail/93e4a02f-bc0b-490d-8ea3-e3b1f3a8db31">{{$product->title}}</a></h6>
                                    <h5>{{$product->price}}</h5>
                                    
                                </div>
                            </div>
                        </div>
                  
                    @endforeach
    @else
    <div class="col-lg-12 col-md-6 col-sm-6 no-records">
        <p style="text-align:center;">No records found</p>
    </div>
    @endif
    </div>
 
</div>
