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

import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { ResetPasswordComponent } from './components/auth/reset-password/reset-password.component';
import { VerifyResetComponent } from './components/auth/verify-reset/verify-reset.component';
import { NewPasswordComponent } from './components/auth/new-password/new-password.component';
import { VerifyRegisterComponent } from './components/auth/verify-register/verify-register.component';


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
    ProductFilterPipe,
    PageNotFoundComponent,
    CateogryCardComponent,
    TopTrendItemComponent,
    ShippingComponent,
    NewsletterComponent,
    HeadComponent,
    TopTrendListComponent,
    CheckoutComponent,
    ResetPasswordComponent,
    VerifyResetComponent,
    NewPasswordComponent,
    VerifyRegisterComponent,
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
    HttpClientModule,
    TranslateModule.forRoot({
      defaultLanguage:"en",
      loader: {
      provide:TranslateLoader,
      useFactory:createTranslateLoader,
      deps:[HttpClient]
      }
    })

  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}