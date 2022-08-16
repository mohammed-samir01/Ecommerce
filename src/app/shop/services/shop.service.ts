import { Injectable } from '@angular/core';

import { BehaviorSubject } from 'rxjs';
import { tap, concatMap, scan } from 'rxjs/operators';
// import { FavoriteService } from './../../../components/favorites/service/favorite.service';

import {
  HttpClient,
  HttpResponse,
  HttpHeaders,
  HttpParams,
} from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class ShopService {
  constructor(private httpClient: HttpClient) {}

  getAllProducts() {
        const params = new HttpParams()
          .set('cateName', '')
          .set('pagenum', 'g');
    return this.httpClient.get('http://127.0.0.1:8000/api/all_products?page=');
  }

  getAllCategories() {
    return this.httpClient.get('http://127.0.0.1:8000/api/all_categories');
  }

  getProductsByCategories(keyword: string, num?: number) {
    console.log(keyword);
    return this.httpClient.get('http://127.0.0.1:8000/api/shop/' + keyword);
  }

  //pagi test

  getProductsByCategoriesPagination(num?: number) {
    return this.httpClient.get('http://127.0.0.1:8000/api/shop/?page=' + num);
  }

  getAllTags() {
    return this.httpClient.get('http://127.0.0.1:8000/api/all_tags');
  }

  getProductsByTags(keyword: string) {
    console.log(keyword);
    return this.httpClient.get(
      'http://127.0.0.1:8000/api/shop/tags/' + keyword
    );
  }

  getSubCategories() {
    return this.httpClient.get('http://127.0.0.1:8000/api/all_categories_sub');
  }

  //add to cart
  addToCart(product_id:any){
    return this.httpClient.post('http://127.0.0.1:8000/api/add-to-cart',product_id)
}}
