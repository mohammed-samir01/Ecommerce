import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DescReviewComponent } from './desc-review/desc-review.component';
import { DetailsComponent } from './details/details.component';
import { RelatedProductItemComponent } from './related-product-item/related-product-item.component';
import { RelatedProductsComponent } from './related-products/related-products.component';
import { ProductDetailsComponent } from './product-details/product-details.component';
import {MatTabsModule} from '@angular/material/tabs';


@NgModule({
  declarations: [
    DescReviewComponent,
    DetailsComponent,
    RelatedProductItemComponent,
    RelatedProductsComponent,
    ProductDetailsComponent
  ],
  imports: [
    CommonModule,
    MatTabsModule,
  ],
  exports: [
    ProductDetailsComponent
  ]
})
export class ProductDetailsModule { }
