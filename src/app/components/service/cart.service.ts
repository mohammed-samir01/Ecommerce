import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CartService {



  constructor() { }
 public allProd : any [] = [ {item:  {id: 3,
   title: 'Maybelline New York Colossal Up To 36 Hours Mascara',
    image: 'https://eg.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/48/295522/1.jpg?520'}, quantity: 9}]

    setProduct(product:any)
   {
    this.allProd.push(product)
    this.allProd = product
    return this.allProd
  }
   getProduct(){
    return this.allProd
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
