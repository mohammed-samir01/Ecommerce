import { FilesModule } from './shared/files/files.module';
import { NgxModule } from './shared/ngx/ngx.module';
import { MaterialModule } from './shared/material/material.module';
import { NgModule, Component } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HomeComponent } from './components/home/home/home.component';
import { LoginComponent } from './components/auth/login/login.component';
import { RegisterComponent } from './components/auth/register/register.component';
import { CartComponent } from './components/cart/cart.component';
import { FavoritesComponent } from './components/favorites/favorites.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { FooterComponent } from './components/footer/footer.component';
import { CategoryListComponent } from './components/home/category-list/category-list.component';
import { CategoryDetailsComponent } from './components/home/category-details/category-details.component';
import { OrderComponent } from './components/order/order.component';
import { ProductDetailsComponent } from './components/productDetails/product-details/product-details.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ProductFilterPipe } from './pipes/product-filter.pipe';
import { AlertComponent } from './shared/alert/alert.component';
import { ApplicationErrorComponent } from './shared/application-error/application-error.component';
import { ResourceNotFoundComponent } from './shared/resource-not-found/resource-not-found.component';
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
import { HeroComponent } from './components/shop/hero/hero.component';
import { AllCategoryComponent } from './components/shop/all-category/all-category.component';
import { ShopComponent } from './components/shop/shop/shop.component';
import { AsideComponent } from './components/shop/aside/aside.component';
import { Ng5SliderModule } from 'ng5-slider';
import { WomanShirtsCardComponent } from './components/shop/woman-shirts-card/woman-shirts-card.component';
import { WomanShirtsListComponent } from './components/shop/woman-shirts-list/woman-shirts-list.component';
import { CheckoutComponent } from './components/checkout/checkout.component';
import { FilterComponent } from './components/shop/filter/filter.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    LoginComponent,
    RegisterComponent,
    CartComponent,
    FavoritesComponent,
    NavbarComponent,
    FooterComponent,
    CategoryListComponent,
    CategoryDetailsComponent,
    OrderComponent,
    ProductDetailsComponent,
    ProductFilterPipe,
    AlertComponent,
    ApplicationErrorComponent,
    PageNotFoundComponent,
    ResourceNotFoundComponent,
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
    HeroComponent,
    AllCategoryComponent,
    ShopComponent,
    AsideComponent,
    WomanShirtsCardComponent,
    WomanShirtsListComponent,
    CheckoutComponent,
    FilterComponent,
    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    NgxModule,
    FormsModule,
    ReactiveFormsModule,
    FilesModule,
    Ng5SliderModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
