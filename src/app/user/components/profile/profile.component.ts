import { HttpClient } from '@angular/common/http';
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
  userForm: any = FormGroup;
  submitted = false;
  result: any;
  respons:any;
  userData: any;
  delete: any;
  image_name!: File;
  id: any;

  constructor(
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    private userService: UserService,
    public router: Router,
    private toastrService: ToastrService,
    private http:HttpClient
  ) {}

  ngOnInit(): void {
    this.getUserData();

    this.userForm = this.formBuilder.group(
      {
        User_Id: ['', []],
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
        file: ['', []],
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
        User_id: this.userData.User_Id,
        // user_image: this.userData.user_image,
      });
         this.id = this.userData.User_Id;
         console.log(this.id);
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
      // data.user_image
    );
    // console.log(data.user_image);

    this.userService.updateUserData(updataData).subscribe((res) => {
      this.respons = res;
      if (this.respons.success == true) {
          this.toastrService.success(this.respons.message);
          this.getUserData();
        }else{
          this.toastrService.error('Please change username');
        }
    });

  }

  deleteImage() {
    this.userService.deleteUserImage(this.id).subscribe((res) => {
      console.log(res);
      this.delete = res;
      this.toastrService.success(this.delete.messsage);
      this.getUserData();
    });
  }

  // addImage(event) {
  //   this.img = <File>event.target.files[0];
  //   console.log(this.img);
  // }

  // data = new FormData();

  // onFileChange(event: any) {
  //   // console.log(this.addproperity.value.file);
  //   console.log(event.target.files);
  //   console.log(event.target.files[0]['name']);

  //   if (event.target.files && event.target.files[0]) {
  //     var filesAmount = event.target.files.length;
  //     for (let i = 0; i < filesAmount; i++) {
  //       let imagename = event.target.files[i];
  //       console.log(imagename);
  //       this.data.append('image_name[]', imagename, imagename.name);
  //       // this.image_name.push(imagename);
  //       var reader = new FileReader();

  //       reader.onload = (event: any) => {
  //         // console.log(event.target.files +'fillllle');
  //         //  this.image_name.push(event.target.result);
  //         //  this.image_name.patchValue({
  //         //     fileSource: this.images
  //         //  });
  //       };

  //       // reader.readAsArrayBuffer(event.target.files[i]);
  //     }
  //   }
  //   console.log('array' + this.image_name);
  // }

}

