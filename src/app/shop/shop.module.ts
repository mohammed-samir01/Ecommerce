import { SharedModule } from './../shared/shared.module';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Ng5SliderModule } from 'ng5-slider';
import { RouterModule } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { NgxPaginationModule } from 'ngx-pagination';

import { AllProductsComponent } from './components/all-products/all-products.component';
import { ProductDetailsComponent } from './components/product-details/product-details.component';
import { FilterComponent } from './components/filter/filter.component';
import { ShopComponent } from './components/shop/shop.component';
import { AsideComponent } from './components/aside/aside.component';
import { ProductItemComponent } from './components/product-item/product-item.component';

import { HttpClient } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';



@NgModule({
  declarations: [
    AllProductsComponent,
    ProductDetailsComponent,
    FilterComponent,
    ShopComponent,
    AsideComponent,
    ProductItemComponent,
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
      defaultLanguage:"en",
      loader: {
      provide:TranslateLoader,
      useFactory:createTranslateLoader,
      deps:[HttpClient]
      }
    })
  ],
  exports:[
    ShopComponent,
  ]
})
export class ShopModule { }

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}
