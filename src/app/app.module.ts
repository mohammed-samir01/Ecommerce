import { FilesModule } from './shared/files/files.module';
import { NgxModule } from './shared/ngx/ngx.module';
import { MaterialModule } from './shared/material/material.module';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HomeComponent } from './components/home/home.component';
import { LoginComponent } from './components/auth/login/login.component';
import { RegisterComponent } from './components/auth/register/register.component';
import { CartComponent } from './components/cart/cart.component';
import { FavoritesComponent } from './components/favorites/favorites.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { FooterComponent } from './components/footer/footer.component';
import { ShopComponent } from './components/shop/shop.component';
import { CategoryListComponent } from './components/category-list/category-list.component';
import { CategoryDetailsComponent } from './components/category-details/category-details.component';
import { ContactComponent } from './components/contact/contact.component';
import { OrderComponent } from './components/order/order.component';
import { ProductListComponent } from './components/product-list/product-list.component';
import { ProductDetailsComponent } from './components/product-details/product-details.component';
import { ProductFilterPipe } from './pipes/product-filter.pipe';
import { AlertComponent } from './shared/alert/alert.component';
import { ApplicationErrorComponent } from './shared/application-error/application-error.component';
import { PageNotFoundComponent } from './shared/page-not-found/page-not-found.component';
import { ResourceNotFoundComponent } from './shared/resource-not-found/resource-not-found.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CateogryCardComponent } from './components/cateogry-card/cateogry-card.component';
import { TopTrendItemComponent } from './components/top-trend-item/top-trend-item.component';
import { ShippingComponent } from './components/shipping/shipping.component';
import { NewsletterComponent } from './components/newsletter/newsletter.component';
import { HeadComponent } from './components/head/head.component';

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
    ShopComponent,
    CategoryListComponent,
    CategoryDetailsComponent,
    ContactComponent,
    OrderComponent,
    ProductListComponent,
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
    HeadComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    NgxModule,
    FormsModule,
    ReactiveFormsModule,
    FilesModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
