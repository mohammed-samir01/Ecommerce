import { JsonPipe } from '@angular/common';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, of } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class CartsService {


  constructor(private http: HttpClient) {}

  ///get cart
  getCart(): Observable<any> {
    return this.http.get('http://127.0.0.1:8000/api/show-cart');
  }

  //udatequantity
  updateQuantity(productId: any, qun: any) {
    console.log(productId, qun);
    let params = new HttpParams()
      .set('product_id', productId)
      .set('quantity', qun);
    return this.http.put('http://127.0.0.1:8000/api/update-quantity', params);
  }

  //delete
  deleteProduct(productId: any) {
    return this.http.delete(
      'http://127.0.0.1:8000/api/delete-cart-product?product_id=' + productId
    );
  }

}
