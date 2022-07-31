import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProductsComponent } from './products/products.component';
import { CategoriesComponent } from './categories/categories.component';
import { ShopPageComponent } from './shop-page/shop-page.component';




@NgModule({
  declarations: [
    ProductsComponent,
    CategoriesComponent,
    ShopPageComponent,

  ],
  imports: [
    CommonModule
  ]
})
export class ShopModule { }
