 <!-- Shoping Cart Section Begin -->
 <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                @foreach($cart as $data)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{asset('storage/'.($data->product->image ?? 'images/default.png'))}}" alt="" height="100ox" width="100px">
                                        <h5>{{$data->product->title}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ₹ {{$data->product->price}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                            <span class="dec qtybtn" wire:click="decreaseQuantity({{$data->id}})">-</span>
                                                <input type="text" wire:model="quantity"value="{{$data->quantity}}">
                                                <span class="inc qtybtn" wire:click="increaseQuantity({{$data->id}})">+</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ₹ {{$data->product->price * $data->quantity}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"  wire:click="removeProduct({{$data->product->id}})"></span>
                                    </td>
                                </tr>
                                @endforeach
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <!-- <a href="{{route('shop')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" wire:click="$dispatch('refreshComponent')" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <!-- <h5>Discount Codes</h5> -->
                            <form action="#">
                                <!-- <input type="text" placeholder="Enter your coupon code"> -->
                                <!-- <button type="submit" class="site-btn">APPLY COUPON</button> -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                        <li>Subtotal <span>₹ {{ number_format($subtotal, 2) }}</span></li>
                        <li>Total <span>₹ {{ number_format($total, 2) }}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->