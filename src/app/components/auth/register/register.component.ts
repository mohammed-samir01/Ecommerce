import { ToastrModule, ToastrService } from 'ngx-toastr';
import { ErrorHandler } from './../../../shared/error-handler';
import { Router } from '@angular/router';
import { User } from './../../../models/user';
import { Component, OnInit } from '@angular/core';
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
import { MustMatch } from '../_helpers/must-match.validator';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
})
export class RegisterComponent implements OnInit {
  registerForm: any = FormGroup;
  submitted = false;
  dataOfUser: any = [];
  result: any = {};
  error: any = {};
  token: string = '';

  constructor(
    private authService: AuthService,
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    public router: Router,
    private toastrService: ToastrService
  ) {}


  ngOnInit(): void {

    this.registerForm = this.formBuilder.group(
      {
        first_name: [
          '',
          [
            Validators.required,
            Validators.minLength(3),
            Validators.maxLength(32),
          ],
        ],
        last_name: [
          '',
          [
            Validators.required,
            Validators.minLength(3),
            Validators.maxLength(32),
          ],
        ],
        username: [
          '',
          [
            Validators.required,
            Validators.minLength(6),
            Validators.maxLength(32),
          ],
        ],
        email: [
          '',
          [
            Validators.required,
            Validators.email,
            Validators.pattern(
              '^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$'
            ),
          ],
        ],
        mobile: [
          '',
          [Validators.required, Validators.pattern('^01[0-2]{1}[0-9]{8}')],
        ],
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
    return this.registerForm.controls;
  }

  onSubmit() {
    this.submitted = true;

    // stop here if form is invalid
    if (this.registerForm.invalid) {
      return;
    }

    let data = this.registerForm.value;

    let user = new User(
      data.first_name,
      data.last_name,
      data.username,
      data.email,
      data.mobile,
      data.password,
      data.confirmation_password
    );

    this.authService.registerAuth(user).subscribe((res) => {
      this.result = res;
      console.log(res);
      this.token = this.result.token;

      if (this.result.success == false) {
        console.log(this.result.error.username);

        console.log(this.result.error.username[0]);

        if (this.result.error.username) {
          this.toastrService.error(this.result.error['username']);
        }

        if (this.result.error.email) {
          this.toastrService.error(this.result.error.email);
        }

        if (this.result.error.mobile) {
          this.toastrService.error(this.result.error.mobile);
        }
      } else {

        this.router.navigate(['/verify']);
        this.toastrService.info(this.result.message);
        console.log(user);
      }
    });
    // alert('SUCCESS!! :-)\n\n' + JSON.stringify(this.registerForm.value, null, 4));
  }
}
