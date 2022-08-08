import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ShopService {

  rest_api : string = "http://127.0.0.1:8000/api/all_products";
  

  constructor(private httpClient: HttpClient) { }

  getAllProducts(){
    return this.httpClient.get(`${this.rest_api}`);
    
    // when getting data from api get url only
  }

  getAllCate(){
    return this.httpClient.get('./assets/json/subCategory.json')
    
    // when getting data from api get url only
  }

    getProductsByCate(keyword:string){
    return this.httpClient.get('./assets/json/'+keyword+'.json')
    
    // when getting data from api get url only
  }

  // addData(data:any): Observable<any> {
  //   let api_url = this.rest_api;
  //   return this.httpClient.post(api_url,data).pipe(catchError(this.handleError));
  // }

  
}
