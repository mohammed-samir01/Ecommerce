import { Component, OnInit } from '@angular/core';
import {
  FormControl,
  FormGroup,
  Validators,
  FormBuilder,
} from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { CartsService } from '../../services/cart.service';
import { CheckoutService } from '../../services/checkout.service';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css'],
})
export class CheckoutComponent implements OnInit {
  checkoutForm: any = FormGroup;
  couponForm: any = FormGroup;

  order: boolean = true;
  coupon: boolean = true;

  subTotal: any = 0;
  tot: any = 0;
  total: any = 0;
  select: any = 0;
  calTotal: any = 0;
  allTotal: any = 0;
  shippingcost: number = 0;
  couponId: number = 0;
  isShipping: boolean = false;
  cartProduct: any[] = [];
  result: any = [];
  tax: number = 0;

  ////checkout
  i: number = 0;
  addresses: any = [];
  shipping: any = [];
  payment: any = [];
  discount: number = 0;
  couoponDiscount: boolean = false;
  shippingCompanyId: any;
  addressId: any;
  orderStatus: any;

  constructor(
    private checkoutservice: CheckoutService,
    private toastr: ToastrService,
    private formBuilder: FormBuilder,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.checkoutForm = this.formBuilder.group({
      shipping_company_id: ['', [Validators.required]],
      user_address_id: ['', [Validators.required]],
      payment_method_id: ['', [Validators.required]],
    });

    this.displayCart();
    this.getAddress();
    this.getShipping();
    this.getPayment();
  }

  getAddress() {
    this.checkoutservice.getUserAddress().subscribe((res) => {
      this.result = res;
      this.addresses = this.result.data.data;
    });
  }
  ///shipping
  getShipping() {
    this.checkoutservice.getShipping().subscribe((res) => {
      this.result = res;
      this.shipping = this.result.Shipping_compines;
    });
  }
  ////payment
  getPayment() {
    this.checkoutservice.getPayment().subscribe((res) => {
      this.result = res;
      this.payment = this.result.payment_methods;
    });
  }

  displayCart() {
    this.checkoutservice.getCart().subscribe((res) => {
      this.result = res;
      console.log(res);
      this.cartProduct = this.result.Products;
      console.log(this.cartProduct);
      for (let x in this.cartProduct) {
        this.subTotal += parseInt(this.cartProduct[x].total);
      }
      console.log(this.subTotal);
      this.tax = Math.floor(this.subTotal * 0.15);
    });
  }

  ///coupon
  couponSend(couponForm: any) {
    this.checkoutservice.getCoupon(couponForm.couponModel).subscribe((res) => {
      this.result = res;
      console.log(res);
      this.couponId = this.result.data.id;
      this.discount = this.result.data.discount;

      if (this.result.status == 1) {
        this.coupon = false;
        this.toastr.success('Coupon Success');
        // this.coupon = !this.coupon;
      } else {
        this.discount = 0;
        this.toastr.error(this.result.messsage);
      }
      ///coupon
    });
  }

  removeCoupon() {
    this.coupon = true;
    this.discount = 0;
  }

  shippingCost(event: any) {
    this.shippingcost = parseInt(event.cost);
    this.calTotal = this.subTotal + this.shippingcost + this.tax;
    this.total = this.calTotal - this.discount;
  }

  sendOrder(form: any) {
    this.shippingCompanyId = form.value.shipping_company_id;
    this.payment = form.value.payment_method_id;
    this.addressId = form.value.user_address_id;

    this.checkoutservice
      .OrderDetails(
        this.addressId,
        this.shippingCompanyId,
        this.payment,
        this.couponId
      )
      .subscribe((res) => {
        this.orderStatus = res;

          if (this.orderStatus.InvoiceURL) {
            window.location.replace(this.orderStatus.InvoiceURL);
          } 
          
          else {
            this.router.navigate(['/shop']);
            this.toastr.success(this.orderStatus.message);
          } 

      });
  }
}















