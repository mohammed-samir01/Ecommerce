import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { AppRoutingModule } from './../../app-routing.module';

import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { VerifyRegisterComponent } from './verify-register/verify-register.component';
import { NewPasswordComponent } from './new-password/new-password.component';
import { ResetPasswordComponent } from './reset-password/reset-password.component';
import { VerifyResetComponent } from './verify-reset/verify-reset.component';

@NgModule({
  declarations: [LoginComponent, RegisterComponent, VerifyRegisterComponent, NewPasswordComponent, ResetPasswordComponent, VerifyResetComponent],
  imports: [
    CommonModule,
     AppRoutingModule,
    TranslateModule.forRoot({
      defaultLanguage:"en",
      loader: {
      provide:TranslateLoader,
      useFactory:createTranslateLoader,
      deps:[HttpClient]
      }
    }),
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,],
  exports: [LoginComponent, RegisterComponent],
})
export class AuthModule {}

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/', '.json');
}