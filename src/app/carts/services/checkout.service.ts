import { JsonPipe } from '@angular/common';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, of } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class CheckoutService {
  cartProduct: any[] = [];
  total: any = 0;
  cartLength: number = 0;

  //cartcount
  cartCount = new BehaviorSubject(1);
  count: any;

  constructor(private http: HttpClient) {}

  ///get cart
  getCart(): Observable<any> {
    return this.http.get('http://127.0.0.1:8000/api/show-cart');
  }

  //////////checkout
  getShipping() {
    return this.http.get('http://127.0.0.1:8000/api/shipping-compines');
  }
  getPayment() {
    return this.http.get('http://127.0.0.1:8000/api/payment-methods');
  }

  getUserAddress() {
    return this.http.get('http://127.0.0.1:8000/api/get-user-addresses');
  }

  getCoupon(code: any) {
    return this.http.get('http://127.0.0.1:8000/api/apply-coupon?code=' + code);
  }


  OrderDetails(
    address_id: any,
    shipping_id: any,
    payment_id: any,
    coupon_id: any
  ) {
    let headers = new HttpParams()
      .set('user_address_id', address_id)
      .set('shipping_company_id', shipping_id)
      .set('payment_method_id', payment_id)
      .set('coupon_id', coupon_id);

    return this.http.post(
      'http://127.0.0.1:8000/api/checkout/payment',
      headers
    );
  }

}
