import { NgModule, Component } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { CommonModule } from '@angular/common';
import { SharedModule } from './shared/shared.module';
import { ShopModule } from './shop/shop.module';
import { ProductDetailsModule } from './product-details/product-details.module';
import { HomeModule } from './home/home.module';
import { CartsModule } from './carts/carts.module';
import { AuthModule } from './components/auth/auth.module';
import { UserModule } from './user/user.module';

import { FavoritesComponent } from './components/favorites/favorites.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ProductFilterPipe } from './pipes/product-filter.pipe';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { HttpClient, HTTP_INTERCEPTORS } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';

import { ToastrModule, ToastNoAnimation, ToastNoAnimationModule } from 'ngx-toastr';

import { AuthInterceptor } from './components/auth/services/auth.interceptor';
@NgModule({
  declarations: [
    AppComponent,
    FavoritesComponent,
    ProductFilterPipe,
    PageNotFoundComponent,
  ],
  imports: [
    ProductDetailsModule,
    SharedModule,
    ShopModule,
    HomeModule,
    CartsModule,
    AuthModule,
    UserModule,
    CommonModule,
    ToastNoAnimationModule.forRoot(),

    TranslateModule.forRoot({
      defaultLanguage: 'en',
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient],
      },
    }),
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
  ],

  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthInterceptor,
      multi: true,
    },
  ],
  bootstrap: [AppComponent],
})
export class AppModule {}



export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}
