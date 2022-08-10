import { Injectable } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class HomeService {

  constructor(public translate: TranslateService, private httpClient: HttpClient) { }
  getCategory(){
  return this.httpClient.get("http://127.0.0.1:8000/api/all_categories");
  }

  getTopTrendsProducts(){
    return this.httpClient.get("http://127.0.0.1:8000/api/featured_products");
  }

  getSingleProduct(keyword :any){
    return this.httpClient.get("http://127.0.0.1:8000/api/product/"+keyword);
  }
}
