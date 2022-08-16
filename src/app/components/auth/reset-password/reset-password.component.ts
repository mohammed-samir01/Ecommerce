import { Login } from './../../../models/login';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ValidationErrors } from '@angular/forms';
import {
  FormBuilder,
  FormGroup,
  Validators,
  FormControl,
  ValidatorFn,
  AbstractControl,
} from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { AuthService } from '../services/auth.service';
import { ToastrModule, ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-reset-password',
  templateUrl: './reset-password.component.html',
  styleUrls: ['./reset-password.component.css'],
})
export class ResetPasswordComponent implements OnInit {
  resetForm: any = FormGroup;
  submitted = false;
  result :any;
  id :any; 


  constructor(
    private authService: AuthService,
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.resetForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
    });

    // this.storageData = localStorage.getItem('data');
    // this.userData = JSON.parse(this.storageData);
    // this.email = this.userData.email;

    // this.token = localStorage.getItem('token');
  }

  get f() {
    return this.resetForm.controls;
  }

  onSubmit() {
    this.submitted = true;
    let data = this.resetForm.value;

    let reset = new Login(data.email, null);

    this.authService.forgetPassword(reset)
      .subscribe((res) => {
        this.result = res;
        console.log(res);

        if(this.result.status == true ){
          console.log(this.result.email);
          localStorage.setItem(
            'email',
            JSON.stringify(this.resetForm.value, null, 4)
          );
          this.toastrService.success(this.result.message);
        }
        else{
          this.toastrService.error(this.result.message);
        };

      })

  }
}
