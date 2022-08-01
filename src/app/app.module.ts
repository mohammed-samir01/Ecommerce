import { NgModule, Component } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { SharedModule } from './shared/shared.module';
import { ShopModule } from './shop/shop.module';


import { HomeComponent } from './components/home/home/home.component';
import { LoginComponent } from './components/auth/login/login.component';
import { RegisterComponent } from './components/auth/register/register.component';
import { CartComponent } from './components/cart/cart.component';
import { FavoritesComponent } from './components/favorites/favorites.component';
import { CategoryListComponent } from './components/home/category-list/category-list.component';
import { CategoryDetailsComponent } from './components/home/category-details/category-details.component';
import { OrderComponent } from './components/order/order.component';
import { ProductDetailsComponent } from './components/productDetails/product-details/product-details.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ProductFilterPipe } from './pipes/product-filter.pipe';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CateogryCardComponent } from './components/home/cateogry-card/cateogry-card.component';
import { TopTrendItemComponent } from './components/home/top-trend-item/top-trend-item.component';
import { ShippingComponent } from './components/home/shipping/shipping.component';
import { NewsletterComponent } from './components/home/newsletter/newsletter.component';
import { HeadComponent } from './components/home/head/head.component';
import { DetailsComponent } from './components/productDetails/details/details.component';
import { TopTrendListComponent } from './components/home/top-trend-list/top-trend-list.component';
import { DescReviewComponent } from './components/productDetails/desc-review/desc-review.component';
import { RelatedProductsComponent } from './components/productDetails/related-products/related-products.component';
import { RelatedProductItemComponent } from './components/productDetails/related-product-item/related-product-item.component';
import { CheckoutComponent } from './components/checkout/checkout.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    LoginComponent,
    RegisterComponent,
    CartComponent,
    FavoritesComponent,

    CategoryListComponent,
    CategoryDetailsComponent,
    OrderComponent,
    ProductDetailsComponent,
    ProductFilterPipe,
    PageNotFoundComponent,
    CateogryCardComponent,
    TopTrendItemComponent,
    ShippingComponent,
    NewsletterComponent,
    HeadComponent,
    DetailsComponent,
    TopTrendListComponent,
    DescReviewComponent,
    RelatedProductsComponent,
    RelatedProductItemComponent,
    CheckoutComponent,
    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    FormsModule,
    ReactiveFormsModule,
    SharedModule,
    ShopModule,

  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
