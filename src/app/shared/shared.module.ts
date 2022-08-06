import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavbarComponent } from './components/navbar/navbar.component';
import { FooterComponent } from './components/footer/footer.component';
import { NgxModule } from './ngx/ngx.module';
import { FilesModule } from './files/files.module';
import { MaterialModule } from './material/material.module';
import { RouterModule } from '@angular/router';
import { HeroComponent } from './components/hero/hero.component';
<<<<<<< HEAD


=======
import { ChangeLanguageComponent } from './components/change-language/change-language.component';

import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@NgModule({
  declarations: [
    NavbarComponent,
    FooterComponent,
<<<<<<< HEAD
    HeroComponent
=======
    HeroComponent,
    ChangeLanguageComponent,
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
  ],
  imports: [
    CommonModule,
    NgxModule,
    FilesModule,
    MaterialModule,
<<<<<<< HEAD
    RouterModule
=======
    RouterModule,
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
  exports:[
    NavbarComponent,
    FooterComponent,
    HeroComponent,
    NgxModule,
    FilesModule,
    MaterialModule,
    RouterModule,
  ]
})
export class SharedModule { }
<<<<<<< HEAD
=======

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
