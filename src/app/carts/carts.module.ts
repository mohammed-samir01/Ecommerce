import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CartComponent } from './components/cart/cart.component';
import { CheckoutComponent } from './components/checkout/checkout.component';
import { HeroComponent } from './components/hero/hero.component';
import {FormsModule,FormGroup,Validators,FormControl,} from '@angular/forms';


import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';


@NgModule({
  declarations: [CartComponent, CheckoutComponent, HeroComponent],
  imports: [
    CommonModule,
    FormsModule,
    HttpClientModule,
    TranslateModule.forRoot({
      defaultLanguage: 'en',
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient],
      },
    }),
  ],

  exports: [CartComponent, CheckoutComponent, HeroComponent],
})
export class CartsModule {}

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json');
}