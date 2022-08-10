import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class ProductDetailsService {
  constructor(private httpClient: HttpClient) {}

  getSingleProduct(keyword: any) {
    return this.httpClient.get('http://127.0.0.1:8000/api/product/' + keyword);
  }

  getRelatedProduct(keyword: any) {
    return this.httpClient.get(
      'http://127.0.0.1:8000/api/' + keyword + '/related_products'
    );
  }
}
