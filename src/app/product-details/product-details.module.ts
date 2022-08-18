import { NgModule } from '@angular/core';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { CommonModule } from '@angular/common';
import { DescReviewComponent } from './desc-review/desc-review.component';
import { DetailsComponent } from './details/details.component';
import { RelatedProductItemComponent } from './related-product-item/related-product-item.component';
import { RelatedProductsComponent } from './related-products/related-products.component';
import { ProductDetailsComponent } from './product-details/product-details.component';
import { MatTabsModule } from '@angular/material/tabs';

import { ShopModule } from './../shop/shop.module';
import { SharedModule } from '../shared/shared.module';
import { BarRatingModule } from 'ngx-bar-rating';

import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';

@NgModule({
  declarations: [
    DescReviewComponent,
    DetailsComponent,
    RelatedProductItemComponent,
    RelatedProductsComponent,
    ProductDetailsComponent,
  ],
  imports: [
    CommonModule,
    NgbModule,
    MatTabsModule,
    ShopModule,
    SharedModule,
    BarRatingModule,
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
  exports: [ProductDetailsComponent, BarRatingModule, NgbModule],
})
export class ProductDetailsModule {}
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json');
}
