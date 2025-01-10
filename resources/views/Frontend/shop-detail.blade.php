@extends('layouts.master')
@section('title', "Product Detail page | Ecommerce")
@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Vegetable’s Package</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <a href="#">Vegetables</a>
                            <span>Vegetable’s Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <livewire:frontend.shop-details  :recordId="$recordId??null"/>
    <livewire:frontend.related-product  :recordId="$recordId??null"/>
    @endsection