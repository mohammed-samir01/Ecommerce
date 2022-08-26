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

  subtotal: any = 0;
  tot: any = 0;
  total: any = 0;
  select: any = 0;

  couponId: number = 1;
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

  ///checkout
  getAddress() {
    this.checkoutservice.getUserAddress().subscribe((res) => {
      this.result = res;
      this.addresses = this.result.data.data;
    });
  }

  getShipping() {
    this.checkoutservice.getShipping().subscribe((res) => {
      this.result = res;
      this.shipping = this.result.Shipping_compines;
    });
  }

  getPayment() {
    this.checkoutservice.getPayment().subscribe((res) => {
      this.result = res;
      this.payment = this.result.payment_methods;
    });
  }

  displayCart() {
    this.checkoutservice.getCart().subscribe((res) => {
      this.result = res;
      this.cartProduct = this.result.Products;
      console.log(this.cartProduct);

      this.subtotal = 0;
      for (let x in this.cartProduct) {
        this.subtotal +=
          this.cartProduct[x].price * this.cartProduct[x].quantity;
      }

      this.tax = this.subtotal * 0.15;
      this.total = this.subtotal + this.tax;
    });
  }

  totalPrice(event: any) {
    this.isShipping = true;
    this.select = parseInt(event.cost);
    this.tot = this.subtotal + this.select + this.tax;
    this.total = this.tot;
  }

  couponSend(couponForm: any) {
    this.checkoutservice.getCoupon(couponForm.couponModel).subscribe((res) => {
      this.result = res;
      this.discount = this.result.data.discount;

      if (this.result.status == 1) {
        this.total = this.tot - this.discount;
        this.toastr.success('Coupon Success');
        this.coupon = !this.coupon;
      } else {
        this.discount = 0;
        this.total = this.tot - this.discount;
        this.toastr.error(this.result.messsage);
      }
    });
  }

  removeCoupon() {
    this.coupon = !this.coupon;
    this.discount = 0;
    this.total = this.tot - this.discount;
    this.couponForm.reset();
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

        if (this.orderStatus.msg.payment_method_id == '1') {
          window.location.replace(this.orderStatus.InvoiceURL);
        } else {
          this.router.navigate(['/shop']);
        }
      });
  }
}
