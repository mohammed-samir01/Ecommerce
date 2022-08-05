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

@NgModule({
  declarations: [
    NavbarComponent,
    FooterComponent,
    HeroComponent,
    ChangeLanguageComponent,
  ],
  imports: [
    CommonModule,
    NgxModule,
    FilesModule,
    MaterialModule,
    RouterModule,
    
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

