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
import { Router, ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-new-password',
  templateUrl: './new-password.component.html',
  styleUrls: ['./new-password.component.css'],
})
export class NewPasswordComponent implements OnInit {
  NewPassForm: any = FormGroup;
  submitted = false;

  id!: number;
  result: any;

  constructor(
    private authService: AuthService,
    private formBuilder: FormBuilder,
    public translate: TranslateService,
    public router: Router,
    private activatedRoute: ActivatedRoute,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.id = this.activatedRoute.snapshot.params['id'];
    console.log(this.id);
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

    // stop here if form is invalid
    if (this.NewPassForm.invalid) {
      return;
    }

    let data = this.NewPassForm.value;


    let password = data.password;

    this.authService.newPassword(this.id, password).subscribe((res) => {
      this.result = res;
      console.log(res);



      if (this.result == 'success') {
          this.router.navigate(['/']);
          this.toastrService.success("Password Sucessfully Changed");
      }
      else {
            this.toastrService.error("Type new password");
        }
    });
    // alert('SUCCESS!! :-)\n\n' + JSON.stringify(this.NewPassForm.value, null, 4));
  }
}
