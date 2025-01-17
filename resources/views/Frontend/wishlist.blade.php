@extends('layouts.master')
@section('title', "WishList | Ecommerce")
@section('content')
 
      <!-- Breadcrumb Section Begin -->
      <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Wish List</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Wish List</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<livewire:frontend.wishlist-page  lazy/>

    @endsection