import { SharedModule } from './../shared/shared.module';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Ng5SliderModule } from 'ng5-slider';
import { RouterModule } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule}  from '@angular/forms';
import { NgxPaginationModule } from 'ngx-pagination';
import { AllProductsComponent } from './components/all-products/all-products.component';
import { ProductDetailsComponent } from './components/product-details/product-details.component';
import { FilterComponent } from './components/filter/filter.component';
import { HeroComponent } from './components/hero/hero.component';
import { ShopComponent } from './components/shop/shop.component';
import { AsideComponent } from './components/aside/aside.component';
import { ProductItemComponent } from './components/product-item/product-item.component';





@NgModule({
  declarations: [
    AllProductsComponent,
    ProductDetailsComponent,
    FilterComponent,
    HeroComponent,
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
    SharedModule
  ],
  exports:[
    ShopComponent,
    FormsModule,
    HeroComponent
  ]
})
export class ShopModule { }
