import { Address } from './../../../models/address';
import { Component, OnInit } from '@angular/core';
import { UserService } from './../../services/user.service';
import { ToastrModule, ToastrService } from 'ngx-toastr';
import {
  FormControl,
  FormGroup,
  Validators,
  FormBuilder,
} from '@angular/forms';

@Component({
  selector: 'app-addresses',
  templateUrl: './addresses.component.html',
  styleUrls: ['./addresses.component.css'],
})
export class AddressesComponent implements OnInit {
  addressForm :any = FormGroup;
  submitted = false;

  usrAddresses: any = [];
  data = [];

  constructor(
    
    private formBuilder: FormBuilder,
    private userService: UserService,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.getUseraddresses();

    this.addressForm = this.formBuilder.group({
      address_title: ['', []],
      default_address: ['', []],
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
      email: [
        '',
        [
          Validators.required,
          Validators.email,
          Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$'),
        ],
      ],
      mobile: [
        '',
        [Validators.required, Validators.pattern('^01[0-2]{1}[0-9]{8}')],
      ],
      address: ['', []],
      address2: ['', []],
      country_id: ['', []],
      state_id: ['', []],
      city_id: ['', []],
      zip_code: ['', []],
      po_box: ['', []],
    });
  }

  get f() {
    return this.addressForm.controls;
  }

  onSubmit() {
    this.submitted = true;

    // stop here if form is invalid
    if (this.addressForm.invalid) {
      return;
    }

    let data = this.addressForm.value;

    let addressData = new Address(
      data.address_title,
      data.default_address,
      data.first_name,
      data.last_name,
      data.email,
      data.mobile,
      data.address,
      data.address2,
      data.country_id,
      data.state_id,
      data.city_id,
      data.zip_code,
      data.po_box
    );

    this.userService.addAddress(addressData).subscribe((res) => {
      console.log(res);
    });


  }

  getUseraddresses() {
    this.userService.userAddresses().subscribe((res) => {
      this.usrAddresses = res;

      if (this.usrAddresses.status == 0) {
        this.data = this.usrAddresses.data.data;
      } else {
        this.data = this.usrAddresses.data.data;
        console.log(this.data);
      }
      console.log(res);
    });
  }

  removeAddress() {}
}
