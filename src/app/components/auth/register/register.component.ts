import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormBuilder, ValidatorFn, AbstractControl, ValidationErrors } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  constructor (private formBuilder: FormBuilder, public translate: TranslateService) { }

  registerForm: any = FormGroup;
  submitted = false;

  checkPasswords: ValidatorFn = (group: AbstractControl):  ValidationErrors | null => {
    let pass = group.get('password')?.value;
    let confirmPass = group.get('password_confirmation')?.value
    return pass === confirmPass ? null : { notSame: true }
  }

  ngOnInit(): void {
    this.registerForm = this.formBuilder.group({
      first_name: ['', [Validators.required, Validators.minLength(3), Validators.maxLength(32)]],
      last_name: ['', [Validators.required, Validators.minLength(3), Validators.maxLength(32)]],
      username: ['', [Validators.required, Validators.minLength(6), Validators.maxLength(32)]],
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(8), Validators.maxLength(64)]],
      password_confirmation: [''] },{validator: this.checkPasswords});
  }

  get f() { return this.registerForm.controls }

  onSubmit() {
  this.submitted = true;
  if (this.registerForm.invalid) {
    return;
  } 
  else if (this.submitted) {
    alert("submitted, Thank you");
  }
}
}
