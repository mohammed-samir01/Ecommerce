import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class FavoriteService {

  
  public favoriteList : any = [];
  public productList = new BehaviorSubject<any>([]);
  
  constructor() { }

  getProducts(){
    return this.productList.asObservable();
  }

  setProducts(product:any)
  {
      this.favoriteList.push(...product);
      this.productList.next(product);
  }

  addToFavorite(product:any){
      this.favoriteList.push(product);
      this.productList.next(this.favoriteList);
  }

  removeFromFavorite(product:any){
    this.favoriteList.map((a :any , index :any)=>{
      if(product.id === a.id){
        this.favoriteList.splice(index , 1);
      }
    })
  }
}