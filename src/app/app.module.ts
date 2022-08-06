import { NgModule, Component } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { SharedModule } from './shared/shared.module';
import { ShopModule } from './shop/shop.module';
import { ProductDetailsModule } from './product-details/product-details.module';

import { HomeComponent } from './components/home/home/home.component';
import { LoginComponent } from './components/auth/login/login.component';
import { RegisterComponent } from './components/auth/register/register.component';
import { CartComponent } from './components/cart/cart.component';
import { FavoritesComponent } from './components/favorites/favorites.component';
import { CategoryListComponent } from './components/home/category-list/category-list.component';
import { CategoryDetailsComponent } from './components/home/category-details/category-details.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ProductFilterPipe } from './pipes/product-filter.pipe';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CateogryCardComponent } from './components/home/cateogry-card/cateogry-card.component';
import { TopTrendItemComponent } from './components/home/top-trend-item/top-trend-item.component';
import { ShippingComponent } from './components/home/shipping/shipping.component';
import { NewsletterComponent } from './components/home/newsletter/newsletter.component';
import { HeadComponent } from './components/home/head/head.component';
import { TopTrendListComponent } from './components/home/top-trend-list/top-trend-list.component';
import { CheckoutComponent } from './components/checkout/checkout.component';

<<<<<<< HEAD

=======
import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    LoginComponent,
    RegisterComponent,
    CartComponent,
    FavoritesComponent,
<<<<<<< HEAD

=======
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
    CategoryListComponent,
    CategoryDetailsComponent,
    ProductFilterPipe,
    PageNotFoundComponent,
    CateogryCardComponent,
    TopTrendItemComponent,
    ShippingComponent,
    NewsletterComponent,
    HeadComponent,
    TopTrendListComponent,
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
    ProductDetailsModule,
<<<<<<< HEAD
=======
    HttpClientModule,
    TranslateModule.forRoot({
      defaultLanguage:"ar",
      loader: {
      provide:TranslateLoader,
      useFactory:createTranslateLoader,
      deps:[HttpClient]
      }
    })
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
<<<<<<< HEAD
=======

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
