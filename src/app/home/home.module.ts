import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CategoryListComponent } from './components/category-list/category-list.component';
import { CategoryCardComponent } from './components/category-card/category-card.component';
import { HeadComponent } from './components/head/head.component';
import { FootComponent } from './components/foot/foot.component';
import { TopTrendItemComponent } from './components/top-trend-item/top-trend-item.component';
import { TopTrendListComponent } from './components/top-trend-list/top-trend-list.component';
import { HomeComponent } from './components/home/home.component';

import { AppRoutingModule } from './../app-routing.module';
import { SharedModule } from '../shared/shared.module';

import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';

@NgModule({
  declarations: [
    CategoryListComponent,
    CategoryCardComponent,
    HeadComponent,
    FootComponent,
    TopTrendItemComponent,
    TopTrendListComponent,
    HomeComponent
  ],
  imports: [
    CommonModule,
    AppRoutingModule,
    SharedModule,
    HttpClientModule,
    TranslateModule.forRoot({
      defaultLanguage:"en",
      loader: {
      provide:TranslateLoader,
      useFactory:createTranslateLoader,
      deps:[HttpClient]
      }
    }),
  ],
  exports: [
    HomeComponent
  ]
})
export class HomeModule { }

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}
