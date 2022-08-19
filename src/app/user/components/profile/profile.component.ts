import { UpdateProfile } from './../../../models/profile';
import { Component, OnInit } from '@angular/core';
import {FormControl,FormGroup,Validators,FormBuilder,} from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { ToastrModule, ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { MustMatch } from '../../_helpers/must-match.validator';
import { UserService } from './../../services/user.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css'],
})
export class ProfileComponent implements OnInit {
  imageURL: any;
  userForm: any = FormGroup;
  submitted = false;
  result: any;
  userData: any;
  delete: any;

  constructor(
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    private userService: UserService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.getUserData();

    this.userForm = this.formBuilder.group(
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
        password: ['', [Validators.minLength(8), Validators.maxLength(64)]],
        password_confirmation: [''],
        user_image: ['', []],
      },
      {
        validator: MustMatch('password', 'password_confirmation'),
      }
    );
  }

  get f() {
    return this.userForm.controls;
  }

  getUserData() {
    this.userService.getUserData().subscribe((res) => {
      this.result = res;
      this.userData = this.result.user;
      console.log(this.userData);
      this.userForm.patchValue({
        username: this.userData.username,
        first_name: this.userData.first_name,
        last_name: this.userData.last_name,
        email: this.userData.email,
        mobile: this.userData.mobile,
        user_image: this.userData.user_image,
      });
    });
  }

  onSubmit() {
    this.submitted = true;

    // stop here if form is invalid
    if (this.userForm.invalid) {
      return;
    }

    let data = this.userForm.value;

    let updataData = new UpdateProfile(
      data.username,
      data.first_name,
      data.last_name,
      data.email,
      data.mobile,
      data.password,
      data.confirmation_password,
      data.user_image
    );

    console.log(data.user_image);
    this.userService.updateUserData(updataData).subscribe((res) => {
      console.log(res);
    });

    //     if (this.result.success == false) {
    //   //       this.toastrService.error(
    //   //         'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'
    //   //       );
    //   //     } else {
    //   //       console.log(res);
    //   //       this.toastrService.success('Login Sucessfully');
    //   //       this.router.navigateByUrl('/').then(() => {
    //   //         window.location.reload();
    //   //         localStorage.removeItem('data');
    //   //       });
    //   //       let token = this.result.data.token;
    //   //       localStorage.setItem('token', token);
    //   //       console.log(res);
    //   //     }
    //   //   });
  }

  deleteImage() {
    this.userService.deleteUserImage().subscribe((res) => {
      console.log(res);
      this.delete = res;
      this.toastrService.success(this.delete.message);
    });
  }
}

