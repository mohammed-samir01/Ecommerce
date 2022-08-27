import { Injectable } from '@angular/core';

import { BehaviorSubject } from 'rxjs';
import { tap, concatMap, scan } from 'rxjs/operators';

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

  getAllProducts(page?: any) {
    // const params = new HttpParams().set('pagenum', num);
    return this.httpClient.get(
      'http://127.0.0.1:8000/api/all_products?page=' + page
    );
  }

  getAllCategories() {
    return this.httpClient.get('http://127.0.0.1:8000/api/all_categories');
  }

  getProductsByCategories(keyword: string) {
    return this.httpClient.get('http://127.0.0.1:8000/api/shop/' + keyword);
  }

  getProductsByCategoriesPyPage(page: any) {
    let params = new HttpParams().set('page', page);
    let keyword = sessionStorage.getItem('categoryName');
    return this.httpClient.get(
      'http://127.0.0.1:8000/api/shop/' + keyword + '?' + params
    );
  }

  getProductsByTagsPyPage(page: any) {
    let params = new HttpParams().set('page', page);
    let keyword = sessionStorage.getItem('tagName');
    return this.httpClient.get(
      'http://127.0.0.1:8000/api/shop/' + keyword + '?' + params
    );
  }
  //pagi test

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


  getProductsByFilters(keyword: string) {
    console.log(keyword);
    return this.httpClient.get('http://127.0.0.1:8000/api/shop/' + keyword);
  }

  //add to cart
  addToCart(product_id: any) {
    let params = new HttpParams().set('product_id', product_id);
    return this.httpClient.post(
      'http://127.0.0.1:8000/api/add-to-cart',
      params
    );
  }
  getCart() {
    return this.httpClient.get('http://127.0.0.1:8000/api/show-cart');
  }
  
  addToFav(product_id: any) {
    let params = new HttpParams().set('product_id', product_id);
    return this.httpClient.post('http://127.0.0.1:8000/api/toggle-fav', params);
  }
}
