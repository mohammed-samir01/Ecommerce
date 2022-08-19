
import { NgModule, Component } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { HomeComponent } from './home/components/home/home.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ProductDetailsComponent } from './product-details/product-details/product-details.component';
import { FavoritesComponent } from './components/favorites/favorites.component';
import { ShopComponent } from './shop/components/shop/shop.component';
import { CartComponent } from './carts/components/cart/cart.component';
import { LoginComponent } from './components/auth/login/login.component';
import { RegisterComponent } from './components/auth/register/register.component';
import { VerifyRegisterComponent } from './components/auth/verify-register/verify-register.component';
import { NewPasswordComponent } from './components/auth/new-password/new-password.component';
import { VerifyResetComponent } from './components/auth/verify-reset/verify-reset.component';
import { ResetPasswordComponent } from './components/auth/reset-password/reset-password.component';
import { MeComponent } from './components/auth/me/me.component';
import { LiveChatComponent } from './shared/components/live-chat/live-chat.component';






const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'product-details/:slug', component: ProductDetailsComponent },
  { path: 'shop', component: ShopComponent },
  { path: 'cart', component: CartComponent },
  { path: 'favorite', component: FavoritesComponent },
  { path: 'live-chat', component: LiveChatComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'verify', component: VerifyRegisterComponent },
  { path: 'new-password/:id', component: NewPasswordComponent },
  { path: 'reset-password', component: ResetPasswordComponent },
  { path: 'reset-verify', component: VerifyResetComponent },
  { path: 'me', component: MeComponent },

  { path: '**', component: PageNotFoundComponent, pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }