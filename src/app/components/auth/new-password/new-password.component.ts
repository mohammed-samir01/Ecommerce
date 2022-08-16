import { Component, OnInit } from '@angular/core';
import { ToastrModule, ToastrService } from 'ngx-toastr';
import { Password } from './../../../models/password';
import {
  FormBuilder,
  FormGroup,
  Validators,
  FormControl,
  ValidatorFn,
  AbstractControl,
} from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { MustMatch } from '../_helpers/must-match.validator';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-new-password',
  templateUrl: './new-password.component.html',
  styleUrls: ['./new-password.component.css'],
})
export class NewPasswordComponent implements OnInit {
  NewPassForm: any = FormGroup;
  submitted = false;

  email: any = '';
  result: any ;


  constructor(
    private authService: AuthService,
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    public router: Router,
    private toastrService: ToastrService
  ) {
    this.email = localStorage.getItem('email');
    this.email = JSON.parse(this.email);
  }

  ngOnInit(): void {
    this.NewPassForm = this.formBuilder.group(
      {
        password: [
          '',
          [
            Validators.required,
            Validators.minLength(8),
            Validators.maxLength(64),
          ],
        ],
        password_confirmation: ['', Validators.required],
      },
      {
        validator: MustMatch('password', 'password_confirmation'),
      }
    );
  }

  get f() {
    return this.NewPassForm.controls;
  }

  onSubmit() {
    this.submitted = true;
    localStorage.setItem(
      'data',
      JSON.stringify(this.NewPassForm.value, null, 4)
    );

    // stop here if form is invalid
    if (this.NewPassForm.invalid) {
      return;
    }

    let data = this.NewPassForm.value;

    // let pass = new Password(data.password, data.confirmation_password);

    let password = data.password  
    // let confirmation_password = data.confirmation_password;

    this.authService.newPassword(password  , this.email.email).subscribe((res) => {
      this.result = res;
      console.log(res);
      //   this.token = this.result.token;

      //   if (this.result.success == false) {
      //     console.log(this.result.error.username);

      //     console.log(this.result.error.username[0]);

      //     if (this.result.error.username) {
      //       this.toastrService.error(this.result.error['username']);
      //     }

      //     if (this.result.error.email) {
      //       this.toastrService.error(this.result.error.email);
      //     }

      //     if (this.result.error.mobile) {
      //       this.toastrService.error(this.result.error.mobile);
      //     }
      //   } else {
      //     localStorage.setItem('token', this.token);
      //     localStorage.setItem('status', this.result.status);

      //     this.router.navigate(['/verify']);
      //     this.toastrService.info(this.result.message);
      //     console.log(user);
      //   }
    });
    // alert('SUCCESS!! :-)\n\n' + JSON.stringify(this.NewPassForm.value, null, 4));
  }
}
