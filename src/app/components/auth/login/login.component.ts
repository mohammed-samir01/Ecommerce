import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormBuilder } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent implements OnInit {

  constructor(private formBuilder: FormBuilder, public translate: TranslateService) { }
  
  loginForm:any =  FormGroup;
  submitted = false;
  
  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
    email: ['', [Validators.required, Validators.email]],
    password: ['', [Validators.required, Validators.minLength(8), Validators.maxLength(24)]] });
  }


  get f() { return this.loginForm.controls }

  onSubmit() {
  this.submitted = true;
  if (this.loginForm.invalid) {
      return;
  }
  if(this.submitted) {
    alert("Done");
  }
}
}