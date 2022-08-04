import { FavoriteService } from './service/favorite.service';
import { Component, OnInit } from '@angular/core';
@Component({
  selector: 'app-favorites',
  templateUrl: './favorites.component.html',
  styleUrls: ['./favorites.component.css']
})
export class FavoritesComponent implements OnInit {
  isFavorite : boolean = false;
  public product :any =[];

  constructor(private favorite : FavoriteService) { }

  ngOnInit(): void {
    this.favorite.getProducts().subscribe(res=>{
      this.product = res;
      console.log(res);
    })
  }

  onFavoriteClick(item :any){
    this.isFavorite = !this.isFavorite;

  }

  removeFromFavorite(item :any){
    
    this.isFavorite = this.isFavorite;
    this.favorite.removeFromFavorite(item);
  }
 
}
