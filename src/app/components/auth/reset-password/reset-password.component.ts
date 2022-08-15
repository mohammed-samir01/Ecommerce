import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormBuilder } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-reset-password',
  templateUrl: './reset-password.component.html',
  styleUrls: ['./reset-password.component.css']
})
export class ResetPasswordComponent implements OnInit {

  constructor(private formBuilder: FormBuilder, public translate: TranslateService) { }

  resetPassword: any = FormGroup;
  submitted = false;

  ngOnInit(): void {
    this.resetPassword = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]]
    });
  }

  get f() { return this.resetPassword.controls }

  onSubmit() {
    this.submitted = true;
    if (this.resetPassword.invalid) {
      return;
    }
    if(this.submitted) {
      alert("Submitted, Thanks");
    }
  }

}
