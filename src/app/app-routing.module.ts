import { NgModule, Component } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { HomeComponent } from './components/home/home/home.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ProductDetailsComponent } from './components/productDetails/product-details/product-details.component';
import { ShopComponent } from './components/shop/shop/shop.component';



const routes: Routes = [
  {path : '',component : HomeComponent},
  { path: 'product-details', component: ProductDetailsComponent },
  { path: 'shop', component: ShopComponent },
  { path: '**', component: PageNotFoundComponent },
// { path: '**', component: PageNotFoundComponent },
// { path: '**', component: PageNotFoundComponent },
// { path: '**', component: PageNotFoundComponent },
// { path: '**', component: PageNotFoundComponent },




];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
