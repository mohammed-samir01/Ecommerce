import { NgModule, Component } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/home/home/home.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ProductDetailsComponent } from './components/productDetails/product-details/product-details.component';
import { CartComponent } from './components/cart/cart.component';
import{FavoritesComponent}from'./components/favorites/favorites.component';
import{CheckoutComponent}from './components/checkout/checkout.component';
import { ShopComponent } from './shop/components/shop/shop.component';




const routes: Routes = [
  {path : '',component : HomeComponent},
  { path: 'product-details', component: ProductDetailsComponent},
  { path: 'shop', component: ShopComponent},
  { path: 'cart', component: CartComponent},
  {path:'faverorite' , component:FavoritesComponent},
  {path:'checkout' , component:CheckoutComponent},
  { path: '**', component: PageNotFoundComponent , pathMatch:'full'},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
