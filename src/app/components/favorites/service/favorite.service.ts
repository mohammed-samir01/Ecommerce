import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class FavoriteService {
  public favoriteList: any = [];
  public productList = new BehaviorSubject<any>([]);

  constructor(private httpclient: HttpClient) {}

  getFav() {
    return this.httpclient.get('http://127.0.0.1:8000/api/get-fav');
  }

  deleteFromFav(id:any) {
    return this.httpclient.delete(
      'http://127.0.0.1:8000/api/delete-fav-product?product_id='+id);
  }
}
