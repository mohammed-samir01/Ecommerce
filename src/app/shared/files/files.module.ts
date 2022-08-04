import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FileSelectDirective , FileDropDirective , FileUploadModule } from 'ng2-file-upload';



@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    FileUploadModule
  ],
  exports : [
    FileUploadModule,
    FileDropDirective,
    FileSelectDirective
  ],
})
export class FilesModule { }
