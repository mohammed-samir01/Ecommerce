import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ProductDetailsService {

  constructor(private http:HttpClient) { }

  getProductsByID(id:any){
    return this.http.get('https://fakestoreapi.com/products/'+ id)
  }

  getProductsByCate(keyword:string){
    return this.http.get('./assets/json/'+keyword+'.json')
    
  }
}
