import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavbarComponent } from './components/navbar/navbar.component';
import { FooterComponent } from './components/footer/footer.component';
import { NgxModule } from './ngx/ngx.module';
import { FilesModule } from './files/files.module';
import { MaterialModule } from './material/material.module';
import { RouterModule } from '@angular/router';
import { HeroComponent } from './components/hero/hero.component';
import { ChangeLanguageComponent } from './components/change-language/change-language.component';

import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { ChangeThemeComponent } from './components/change-theme/change-theme.component';
import { LiveChatComponent } from './components/live-chat/live-chat.component';
import { FormsModule } from '@angular/forms';
@NgModule({
  declarations: [
    NavbarComponent,
    FooterComponent,
    HeroComponent,
    ChangeLanguageComponent,
    ChangeThemeComponent,
    LiveChatComponent,
  ],
  imports: [
    CommonModule,
    FormsModule,
    NgxModule,
    FilesModule,
    MaterialModule,
    RouterModule,
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

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}