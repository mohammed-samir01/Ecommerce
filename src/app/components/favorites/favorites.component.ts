import { FavoriteService } from './service/favorite.service';
import { Component, OnInit } from '@angular/core';
<<<<<<< HEAD
=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@Component({
  selector: 'app-favorites',
  templateUrl: './favorites.component.html',
  styleUrls: ['./favorites.component.css']
})
export class FavoritesComponent implements OnInit {
  isFavorite : boolean = false;
  public product :any =[];

<<<<<<< HEAD
  constructor(private favorite : FavoriteService) { }
=======
  constructor(private favorite : FavoriteService,
    public translate: TranslateService) { }
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

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
