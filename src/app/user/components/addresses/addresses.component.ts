import { EditAddress } from '../../../models/edit';
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
  addressForm: any = FormGroup;
  submitted = false;

  isDisplay: boolean = false;

  usrAddresses: any = [];
  data = [];
  countries: any = [];
  states: any = [];
  cities: any = [];
  msg: any;
  singleAddress: any = [];
  Deleted: any = [];

  addressData: any;
  dataAddress: any;
  result: any;
  constructor(
    private formBuilder: FormBuilder,
    private userService: UserService,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.getUseraddresses();
    this.getCountries();
    this.addressForm = this.formBuilder.group({
      id: ['', []],
      address_title: ['', [Validators.required]],
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
      address: ['', [Validators.required]],
      address2: ['', [Validators.required]],
      country_id: ['', [Validators.required]],
      state_id: ['', [Validators.required]],
      city_id: ['', [Validators.required]],
      zip_code: ['', [Validators.required]],
      po_box: ['', [Validators.required]],
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

    this.dataAddress = this.addressForm.value;

    this.addressData = new Address(
      this.dataAddress.address_title,
      this.dataAddress.default_address || 0,
      this.dataAddress.first_name,
      this.dataAddress.last_name,
      this.dataAddress.email,
      this.dataAddress.mobile,
      this.dataAddress.address,
      this.dataAddress.address2,
      this.dataAddress.country_id,
      this.dataAddress.state_id,
      this.dataAddress.city_id,
      this.dataAddress.zip_code,
      this.dataAddress.po_box
    );

    let id = this.dataAddress.id;

    this.userService.addAddress(this.addressData).subscribe((res) => {
      this.result = res;
      console.log(res);
      if (this.result.status == false) {
        if (this.result.error.po_box) {
          this.toastrService.error(this.result.msg);
        }
        if (this.result.error.zip_code) {
          this.toastrService.error(this.result.msg);
        }
      } else {
        this.toastrService.success(this.result.msg);
        this.addressForm.reset();
      }
    });
    this.getUseraddresses();
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

  removeAddress(id) {
    this.userService.removeAddress(id).subscribe((res) => {
      console.log(res);
      this.Deleted = res;
      this.toastrService.success(this.Deleted.messsage);
      this.getUseraddresses();
    });
  }

  getCountries() {
    this.userService.getCountries().subscribe((res) => {
      this.countries = res;
      console.log(this.countries.Cities);
    });
  }

  getStates(state: any) {
    let value = state.target.value;
    this.userService.getStates(value).subscribe((res) => {
      this.states = res;
      console.log(this.states);
      console.log(value);
    });
  }

  getCities(city: any) {
    let value = city.target.value;
    this.userService.getCities(value).subscribe((res) => {
      this.cities = res;
      console.log(this.cities);
      console.log(value);
    });
  }

  onClickOpenForm() {
    this.isDisplay = !this.isDisplay;
  }

  // getSingleAddress(id: any) {
  //   this.userService.getSingleAddress(id).subscribe((res) => {
  //     this.singleAddress = res;
  //     this.msg = this.singleAddress.msg;
  //     this.isDisplay = !this.isDisplay;
  //     console.log(this.singleAddress);
  //     console.log(this.singleAddress.userAddress.address_title);

  //     this.addressForm.patchValue({
  //       id: this.singleAddress.userAddress.id,
  //       address_title: this.singleAddress.userAddress.address_title,
  //       default_address: this.singleAddress.userAddress.default_address,
  //       first_name: this.singleAddress.userAddress.first_name,
  //       last_name: this.singleAddress.userAddress.last_name,
  //       email: this.singleAddress.userAddress.email,
  //       mobile: this.singleAddress.userAddress.mobile,
  //       address: this.singleAddress.userAddress.address,
  //       address2: this.singleAddress.userAddress.address2,
  //       country_id: this.singleAddress.userAddress.country_id,
  //       state_id: this.singleAddress.userAddress.state_id,
  //       city_id: this.singleAddress.userAddress.city_id,
  //       zip_code: this.singleAddress.userAddress.zip_code,
  //       po_box: this.singleAddress.userAddress.po_box,
  //     });
  //   });
  // }
}
