import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class ShopService {
  rest_api: string = 'http://127.0.0.1:8000/api/all_products';

  constructor(private httpClient: HttpClient) {}

  getAllProducts() {
    return this.httpClient.get(`${this.rest_api}`);
  }

  getAllCategories() {
    return this.httpClient.get('http://127.0.0.1:8000/api/all_categories');
  }


  getProductsByCate(keyword: string) {
    return this.httpClient.get('./assets/json/' + keyword + '.json');
  }
  

  getSubCategories() {
    return this.httpClient.get('http://127.0.0.1:8000/api/all_categories_sub');
  }

  // addData(data:any): Observable<any> {
  //   let api_url = this.rest_api;
  //   return this.httpClient.post(api_url,data).pipe(catchError(this.handleError));
  // }
}
