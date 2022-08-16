import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, of } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class CartsService {
  cartProduct: any[] = [];
  // product = new BehaviorSubject(null)
  total: any = 0;

  cartLength: number = 0;
  public x = localStorage.getItem('token');
  header = {
    headers: {
      // 'Authorization' : this.x
      // append any thing to header
      Authorization:
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTUzNzcxNTMyNSwiZXhwIjoxNTM3NzE4OTI1LCJuYmYiOjE1Mzc3MTUzMjUsImp0aSI6IlBKWVhnSkVyblQ0WjdLTDAiLCJzdWIiOjYsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.1vz5lwPlg6orzkBJijsbBNZrnFnUedsGJUs7BUs0tmM',
    },
  };
  constructor(private http: HttpClient) {}
  ///get cart
  getCart(): Observable<any> {
    return this.http.get('http://127.0.0.1:8000/api/show-cart', this.header);
  }

  /////get total price
  getTotal() {
    this.total = 0;
    this.getCart().subscribe((res) => {
      console.log(res);
      this.cartProduct.push(res);
    });
    for (let x in this.cartProduct) {
      this.total +=
        this.cartProduct[x].item.price * this.cartProduct[x].quantity;
    }
    return of(this.total);
  }

  //udatequantity
  updateQuantity(productId: any, body: any) {
    return this.http.put(
      'http://127.0.0.1:8000/api/update-quantity?' + productId,
      body,
      this.header
    );
  }

  //delete
  deleteProduct(productId: any) {
    return this.http.delete(
      'http://127.0.0.1:8000/api/delete-cart-product?' + productId,
      this.header
    );
  }
}
