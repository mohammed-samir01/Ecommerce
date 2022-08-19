import { Component, OnInit } from '@angular/core';
import {
  FormControl,
  FormGroup,
  Validators,
  FormBuilder,
} from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { Login } from './../../../models/login';
import { AuthService } from '../services/auth.service';
import { ToastrModule, ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { User } from './../../../models/user';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent implements OnInit {
  loginForm: any = FormGroup;
  submitted = false;
  result: any;

  constructor(
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    private authService: AuthService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: [
        '',
        [
          Validators.required,
          Validators.minLength(8),
          Validators.maxLength(64),
        ],
      ],
    });
  }

  get f() {
    return this.loginForm.controls;
  }
  
  onSubmit() {
    this.submitted = true;

    // stop here if form is invalid
    if (this.loginForm.invalid) {
      return;
    }

    let data = this.loginForm.value;

    // let user = new User(
    //   null,
    //   null,
    //   null,
    //   data.email,
    //   null,
    //   data.password,
    //   null
    // );

        let login = new Login(
          data.email,
          data.password,
        );

    this.authService.loginAuth(login).subscribe((res) => {
      this.result = res;
      console.log(this.result);

      if(this.result.success == true){
      this.toastrService.success(" Success ");
      this.router.navigateByUrl('/').then(() => {
        window.location.reload();
      });
      let token = this.result.token;
      localStorage.setItem("token" , token)
      }
      else{
      this.toastrService.error(" this.result.error ");
      }
    });
  }

}
