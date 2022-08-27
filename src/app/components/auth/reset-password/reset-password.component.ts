import { Login } from './../../../models/login';
import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
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
  result: any;
  id: any;

  constructor(
    private authService: AuthService,
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    // console.log(this.activatedRoute.snapshot.params['id']);

    this.resetForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
    });

  }

  get f() {
    return this.resetForm.controls;
  }

  onSubmit() {
    this.submitted = true;
    let data = this.resetForm.value;

    let reset = new Login(data.email, null);

    this.authService.forgetPassword(reset).subscribe((res) => {
      this.result = res;
      console.log(res);

      if (this.result.user_id) {
        this.toastrService.success(this.result.message);

      } else {

        this.toastrService.error(this.result.message);
      }
    });
  }
}
