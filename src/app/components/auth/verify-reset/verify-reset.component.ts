import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormBuilder } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-verify-reset',
  templateUrl: './verify-reset.component.html',
  styleUrls: ['./verify-reset.component.css']
})
export class VerifyResetComponent implements OnInit {
  constructor(private formBuilder: FormBuilder, public translate: TranslateService) { }

  verifyResetForm: any = FormGroup;
  submitted = false;


  ngOnInit(): void {
    this.verifyResetForm = this.formBuilder.group({
      code: ['', [Validators.required, Validators.minLength(6), Validators.maxLength(6)]]
    });
  }

  get f() { return this.verifyResetForm.controls }


  onSubmit() {
    this.submitted = true;
    if (this.verifyResetForm.invalid) {
      return;
    }
    if(this.submitted) {
      alert("Submitted, Thanks");
    }
  }
}