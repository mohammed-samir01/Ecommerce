import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import{HttpClientModule} from'@angular/common/http'
import {  RouterModule } from '@angular/router';
import { SpinnerComponent } from './spinner/spinner.component';


@NgModule({
  declarations: [
    SpinnerComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    RouterModule
  ],
  exports:[
    SpinnerComponent
  ]

})
export class SharedModule { }
