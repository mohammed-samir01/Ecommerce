import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormBuilder } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-verify-register',
  templateUrl: './verify-register.component.html',
  styleUrls: ['./verify-register.component.css']
})
export class VerifyRegisterComponent implements OnInit {
  constructor(private formBuilder: FormBuilder, public translate: TranslateService) { }

  verifyRegisterForm: any = FormGroup;
  submitted = false;


  ngOnInit(): void {
    this.verifyRegisterForm = this.formBuilder.group({
      code: ['', [Validators.required, Validators.minLength(6), Validators.maxLength(6)]]
    });
  }

  get f() { return this.verifyRegisterForm.controls }


  onSubmit() {
    this.submitted = true;
    if (this.verifyRegisterForm.invalid) {
      return;
    }
    if(this.submitted) {
      alert("Submitted, Thanks");
    }
  }
}