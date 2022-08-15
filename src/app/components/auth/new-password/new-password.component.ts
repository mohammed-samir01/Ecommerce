import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormBuilder, ValidatorFn, AbstractControl, ValidationErrors } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-new-password',
  templateUrl: './new-password.component.html',
  styleUrls: ['./new-password.component.css']
})
export class NewPasswordComponent implements OnInit {

  constructor (private formBuilder: FormBuilder, public translate: TranslateService) { }

  newPasswordForm: any = FormGroup;
  submitted = false;

  checkPasswords: ValidatorFn = (group: AbstractControl):  ValidationErrors | null => {
    let pass = group.get('password')?.value;
    let confirmPass = group.get('confirmPassword')?.value
    return pass === confirmPass ? null : { notSame: true }
  }

  ngOnInit(): void {
    this.newPasswordForm = this.formBuilder.group({
      password: ['', [Validators.required, Validators.minLength(8), Validators.maxLength(24)]],
      confirmPassword: [''] },{validator: this.checkPasswords});
  }

  get f() { return this.newPasswordForm.controls }

  onSubmit() {
    this.submitted = true;
    if (this.newPasswordForm.invalid) {
      return;
    } 
    else if (this.submitted) {
      alert("submitted, Thank you");
    }
  }

}
