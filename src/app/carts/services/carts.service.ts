import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartsService {
 public cartItemList : any = []
 public productList = new BehaviorSubject<any[]>([])
  constructor(private _http : HttpClient) { }

  addToCart(product :any){
    this.cartItemList.push(product)
    this.productList.next(this.cartItemList)

    console.log(product)
  }
    // getproduct(){
  //   return this.productList.asObservable();
  // }
  // setproduct(product :any){
  //   this.cartItemList.push(...product)
  //   this.productList.next(product)
  // }
  // getTotalPrice(){

  // }
}
