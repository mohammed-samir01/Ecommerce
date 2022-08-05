import { NgModule, Component } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './components/home/home/home.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ProductDetailsComponent } from './product-details/product-details/product-details.component';
import { CartComponent } from './components/cart/cart.component';
import { ShopComponent } from './shop/components/shop/shop.component';
import { LoginComponent } from './components/auth/login/login.component';
import { RegisterComponent } from './components/auth/register/register.component';
import { FavoritesComponent } from './components/favorites/favorites.component';


const routes: Routes = [
  { path: '',component : HomeComponent},
  { path: 'product-details/:id', component: ProductDetailsComponent},
  { path: 'shop', component: ShopComponent},
  { path: 'cart', component: CartComponent},
  { path: 'login', component: LoginComponent},
  { path: 'register', component: RegisterComponent},
  { path: 'favorite', component: FavoritesComponent},
  { path: '**', component: PageNotFoundComponent , pathMatch:'full'},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
