import { Verify } from './../../../models/verify';
import { Component, OnInit } from '@angular/core';
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
  selector: 'app-verify-reset',
  templateUrl: './verify-reset.component.html',
  styleUrls: ['./verify-reset.component.css'],
})
export class VerifyResetComponent implements OnInit {

  verfiyForm: any = FormGroup;
  submitted = false;
  storageData: any = [];
  userData: any = [];
  email: any;
  token: any;

  constructor(
    private authService: AuthService,
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.verfiyForm = this.formBuilder.group({
      verify: ['', []],
    });

    this.userData = JSON.parse(this.storageData);
    this.email = this.userData.email;

  }

  get f() {
    return this.verfiyForm.controls;
  }

  onSubmit() {
    this.submitted = true;

    // // stop here if form is invalid
    // // if (this.verfiyForm.invalid) {
    // //   return;
    // // }

    // console.log(this.token);

    // let data = this.verfiyForm.value;
    // let verification_code = data.verify;

    // // let verify = new Verify(data.verify);

    // // let httpHeaders = new HttpHeaders().set("Authorization", "Bearer " + t);

    // this.authService
    //   .verifyUser(this.email, verification_code)
    //   .subscribe((res) => {
    //     console.log(verify);

    //     this.toastrService.success('Please Login');
    //     // this.router.navigate(['/login']);
    //   });

    // // alert('SUCCESS!! :-)\n\n' + JSON.stringify(this.verfiyForm.value, null, 4));
  }
}
