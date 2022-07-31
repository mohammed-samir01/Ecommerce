import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Ng5SliderModule } from 'ng5-slider';
import { RouterModule } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { AllProductsComponent } from './components/all-products/all-products.component';
import { ProductDetailsComponent } from './components/product-details/product-details.component';
import { AsideComponent } from './components/aside/aside.component';
import { FilterComponent } from './components/filter/filter.component';
import { HeroComponent } from './components/hero/hero.component';
import { ShopComponent } from './components/shop/shop.component';



@NgModule({
  declarations: [
    AllProductsComponent,
    ProductDetailsComponent,
    AsideComponent,
    FilterComponent,
    HeroComponent,
    ShopComponent,
  ],
  imports: [
    CommonModule,
    Ng5SliderModule,
    RouterModule,
    HttpClientModule,
    FormsModule
  ],
  exports:[
    ShopComponent,
  ]
})
export class ShopModule { }
