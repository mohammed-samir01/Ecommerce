import { FavoriteService } from './../../../components/favorites/service/favorite.service';
import { Component, Input, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { CartService } from 'src/app/services/cart/cart.service';
@Component({
  selector: 'app-product-item',
  templateUrl: './product-item.component.html',
  styleUrls: ['./product-item.component.css']
})
export class ProductItemComponent implements OnInit {

  isFavorite : boolean = false;
   products :any []=[]
  @Input() Product : any =[];
  constructor(private  favorite : FavoriteService,
    private cartservic : CartService,
    public translate: TranslateService) { }

  ngOnInit(): void {
    // this.removeFromFavorite(this.Product);
  }

  onFavoriteClick(Product :any){
    this.isFavorite = !this.isFavorite;
    this.favorite.addToFavorite(Product);
    console.log(Product);
  }

  removeFromFavorite(Product :any){
    this.isFavorite = this.isFavorite;
    this.favorite.removeFromFavorite(Product);
  }

  addCart(prod : any){
   this.products = prod
   console.log(this.products)
   this.cartservic.addToCart(prod)
  }
}
