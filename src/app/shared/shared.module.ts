import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavbarComponent } from './components/navbar/navbar.component';
import { FooterComponent } from './components/footer/footer.component';
import { NgxModule } from './ngx/ngx.module';
import { FilesModule } from './files/files.module';
import { MaterialModule } from './material/material.module';
import { RouterModule } from '@angular/router';
import { SpinnerComponent } from './components/spinner/spinner.component';


@NgModule({
  declarations: [
    NavbarComponent,
    FooterComponent,
    SpinnerComponent,
  ],
  imports: [
    CommonModule,
    NgxModule,
    FilesModule,
    MaterialModule,
    RouterModule
  ],
  exports:[
    NavbarComponent,
    FooterComponent,
    SpinnerComponent,
    NgxModule,
    FilesModule,
    MaterialModule,
    RouterModule
  ]
})
export class SharedModule { }
