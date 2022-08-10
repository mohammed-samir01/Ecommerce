@extends('layouts.app')
@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Cart</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <!-- CART TABLE-->
                <div class="table-responsive mb-4">
                    <table class="table">
                        <thead class="bg-light">
                        <tr>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Product</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Price</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Quantity</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Total</strong></th>
                            <th class="border-0" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(Cart::content() as $item)
                            <livewire:frontend.cart-item-component :item="$item->rowId" :key="$item->rowId" />
                        @empty
                            <tr>
                                <td class="pl-0 border-light" colspan="5">
                                    <p class="text-center">
                                        No Items found in your cart!
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- CART NAV-->
                <div class="bg-light px-4 py-3">
                    <div class="row align-items-center text-center">
                        <div class="col-md-6 mb-3 mb-md-0 text-md-left">
                            <a class="btn btn-link p-0 text-dark btn-sm" href="{{ route('frontend.shop') }}">
                                <i class="fas fa-long-arrow-alt-left mr-2"> </i>Continue shopping
                            </a>
                        </div>
                        <div class="col-md-6 text-md-right">
                            @if (Cart::instance('default')->count() > 0)
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('frontend.checkout') }}">
                                    Proceed to checkout <i class="fas fa-long-arrow-alt-right ml-2"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- ORDER TOTAL-->
            <livewire:frontend.cart-total-component />
        </div>
    </section>
@endsection
