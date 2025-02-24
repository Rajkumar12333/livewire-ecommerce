  
<!-- Related Product Section Begin -->
<section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($relatedProducts as $data)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"  style="background-image: url({{ asset('storage/'.($data->image ?? 'images/default.png')) }});">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{route('shop-detail',$data->unique_id)}}"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#" wire:click.prevent="addToCart({{ $data->id }})"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('shop-detail', $data->unique_id) }}">{{$data->title}}</a></h6>
                            <h5>$ {{$data->price}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
          
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
