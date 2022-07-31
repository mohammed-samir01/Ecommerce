import { HttpClient} from '@angular/common/http';
import { Injectable } from '@angular/core';


@Injectable({
  providedIn: 'root'
})
export class ShopService {

  constructor(private http :HttpClient ) { }
  getAllProducts(){
      return this.http.get('https://fakestoreapi.com/products');
  }
  getAllCategory(){
    return this.http.get('https://fakestoreapi.com/products/categories');
  }


  getProductByCategory(keyword:string){
    return this.http.get('https://fakestoreapi.com/products/category/'+ keyword);
  }


  // filterCategory(event:any){
  //   let value = event.target.value;
  //   console.log(value);
  //   // getProductCategory(value);
  //    this.prodd.getProductCategory(value);
  //  }
}
