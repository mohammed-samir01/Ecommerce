import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {



  constructor() { }
  public allprods = new BehaviorSubject<any>([])
 public allProd : any [] = []


    setProduct(product:any)
   {
    this.allProd.push(product)
  //  this.allProd =product
    console.log(this.allProd)
    this.allprods.next(product)
   }
   getProduct(){
    return this.allprods.asObservable()
    // return this.allProd
   }

  //  var self = this;
  //  this.shared_id;


  // $scope.getId = function ()  {
  //   console.log(self.shared_id) ;
  // }

  // $scope.useId = function () {
  //   console.log(self.shared_id) ;
  // }




  // getProduct(){
  //   console.log(this.allProd)
  //   return this.allProd
  // }


}
