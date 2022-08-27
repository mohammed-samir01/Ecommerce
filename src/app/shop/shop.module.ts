import { SharedModule } from './../shared/shared.module';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Ng5SliderModule } from 'ng5-slider';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { NgxPaginationModule } from 'ngx-pagination';

import { AllProductsComponent } from './components/all-products/all-products.component';
import { FilterComponent } from './components/filter/filter.component';
import { ShopComponent } from './components/shop/shop.component';
import { AsideComponent } from './components/aside/aside.component';
import { ProductItemComponent } from './components/product-item/product-item.component';
import { HeroComponent } from './components/hero/hero.component';

import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClientModule, HttpClient } from '@angular/common/http';



@NgModule({
  declarations: [
    AllProductsComponent,
    FilterComponent,
    ShopComponent,
    AsideComponent,
    ProductItemComponent,
    HeroComponent,
  ],
  imports: [
    CommonModule,
    Ng5SliderModule,
    RouterModule,
    HttpClientModule,
    FormsModule,
    NgxPaginationModule,
    SharedModule,
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
  exports: [ShopComponent],
})
export class ShopModule {}

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}
