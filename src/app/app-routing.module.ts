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
import { LiveChatComponent } from './shared/components/live-chat/live-chat.component';
import { ResetPasswordComponent } from './components/auth/reset-password/reset-password.component';
import { VerifyRegisterComponent } from './components/auth/verify-register/verify-register.component';
import { VerifyResetComponent } from './components/auth/verify-reset/verify-reset.component';
import { NewPasswordComponent } from './components/auth/new-password/new-password.component';


const routes: Routes = [
  { path: '', component: HomeComponent},
  { path: 'product-details/:id', component: ProductDetailsComponent},
  { path: 'shop', component: ShopComponent},
  { path: 'cart', component: CartComponent},
  { path: 'register', component: RegisterComponent},
  { path: 'verify-register', component: VerifyRegisterComponent},
  { path: 'login', component: LoginComponent},
  { path: 'reset-password', component: ResetPasswordComponent},
  { path: 'verify-reset', component: VerifyResetComponent},
  { path: 'new-password', component: NewPasswordComponent},
  { path: 'favorite', component: FavoritesComponent},
  { path: 'live-chat', component: LiveChatComponent },
  { path: '**', component: PageNotFoundComponent , pathMatch:'full'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
