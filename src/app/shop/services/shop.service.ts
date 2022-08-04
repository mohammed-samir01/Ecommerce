import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ShopService {

  constructor(private http:HttpClient) { }

  getAllProducts(){
    return this.http.get('./assets/Products.json')
    
    // when getting data from api get url only
  }

  getAllCate(){
    return this.http.get('./assets/json/subCategory.json')
    
    // when getting data from api get url only
  }

    getProductsByCate(keyword:string){
    return this.http.get('./assets/json/'+keyword+'.json')
    
    // when getting data from api get url only
  }

  
}
