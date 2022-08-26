import { Verify } from './../../../models/verify';
import { Component, OnInit } from '@angular/core';
import {
  HttpClient,
  HttpRequest,
  HttpEventType,
  HttpHeaders,
  HttpParams,
  HttpEvent,
  HttpErrorResponse,
  HttpResponse,
} from '@angular/common/http';

import { Router } from '@angular/router';
import { User } from './../../../models/user';
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
  selector: 'app-verify-register',
  templateUrl: './verify-register.component.html',
  styleUrls: ['./verify-register.component.css'],
})
export class VerifyRegisterComponent implements OnInit {
  verfiyForm: any = FormGroup;
  submitted = false;
  result: any;

  constructor(
    private authService: AuthService,
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.verfiyForm = this.formBuilder.group({
      verification_code: [
        '',
        [Validators.required, Validators.pattern('^[0-9]+$')],
      ],
      email: [
        '',
        [
          Validators.required,
          Validators.email,
          Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$'),
        ],
      ],
    });
  }

  get f() {
    return this.verfiyForm.controls;
  }

  onSubmit() {
    this.submitted = true;

    if (this.verfiyForm.invalid) {
      return;
    }

    let data = this.verfiyForm.value;
    let verify = new Verify(data.email, data.verification_code);

    this.authService.verifyUser(verify).subscribe((res) => {
      this.result = res;

      if (this.result.success == false) {
        console.log(this.result.error);
        this.toastrService.error(this.result.error);
      } else {
        console.log(this.result.success + 'sss');
        this.toastrService.success(this.result.message + ' Please Login');
        this.router.navigate(['/']);
      }
    });

  }
}
