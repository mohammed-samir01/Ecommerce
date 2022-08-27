import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavbarComponent } from './components/navbar/navbar.component';
import { FooterComponent } from './components/footer/footer.component';
import { LiveChatComponent } from './components/live-chat/live-chat.component';
import { NgxModule } from './ngx/ngx.module';
import { FilesModule } from './files/files.module';
import { MaterialModule } from './material/material.module';
import { RouterModule } from '@angular/router';
import { ChangeLanguageComponent } from './components/change-language/change-language.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ModalComponent } from './components/modal/modal.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
@NgModule({
  declarations: [
    NavbarComponent,
    FooterComponent,
    ChangeLanguageComponent,
    ModalComponent,
    LiveChatComponent,
  ],
  imports: [
    CommonModule,
    NgxModule,
    FilesModule,
    MaterialModule,
    RouterModule,
    FormsModule,
    ReactiveFormsModule,
    NgbModule,
    TranslateModule.forRoot({
      defaultLanguage: 'en',
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient],
      },
    }),
  ],
  exports: [
    NavbarComponent,
    FooterComponent,
    ModalComponent,
    LiveChatComponent,
    NgxModule,
    FilesModule,
    MaterialModule,
    RouterModule,
  ],
})
export class SharedModule {}

export function createTranslateLoader(http:HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json')
}
