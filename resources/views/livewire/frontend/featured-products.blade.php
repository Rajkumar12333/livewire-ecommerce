<div>
<section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li wire:click="setFilter('*')" class="{{ $filter === '*' ? 'active' : '' }}">All</li>
                            @foreach($departmnet as $data)
                            <li wire:click="setFilter('{{ $data->id }}')" class="{{ $filter === $data->id ? 'active' : '' }}">{{ $data->title }}</li>

                            @endforeach
                           
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
            @forelse($feature_products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{$product->department_id}}">
                    <div class="featured__item">
                    <div class="featured__item__pic set-bg-1" style="background-image: url('{{ asset('storage/' . $product->image) }}');">

                            <ul class="featured__item__pic__hover">
                                <li>
                                <a wire:click.prevent="toggleWishlist({{ $product->id }})">
                                            <i class="fa fa-heart" style="color: {{ in_array($product->id, $wishlistItems) ? 'red' : 'gray' }};"></i>
                                        </a>
                                </li>
                                <li><a href="{{route('shop-detail',$product->unique_id)}}"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#" wire:click.prevent="addToCart({{ $product->id }})"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{$product->title}}</a></h6>
                            <h5>{{$product->price}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
    </section>
    <script>


    </script>
</div>
