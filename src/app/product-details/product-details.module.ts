import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DescReviewComponent } from './desc-review/desc-review.component';
import { DetailsComponent } from './details/details.component';
import { RelatedProductItemComponent } from './related-product-item/related-product-item.component';
import { RelatedProductsComponent } from './related-products/related-products.component';
import { ProductDetailsComponent } from './product-details/product-details.component';
import {MatTabsModule} from '@angular/material/tabs';

<<<<<<< HEAD

=======
import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
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
<<<<<<< HEAD
=======
    HttpClientModule,
    TranslateModule.forRoot({
      defaultLanguage:"en",
      loader: {
      provide:TranslateLoader,
      useFactory:createTranslateLoader,
      deps:[HttpClient]
      }
    })
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
  ],
  exports: [
    ProductDetailsComponent
  ]
})
export class ProductDetailsModule { }
<<<<<<< HEAD
=======

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
