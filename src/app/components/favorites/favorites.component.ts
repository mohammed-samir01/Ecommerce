import { FavoriteService } from './service/favorite.service';
import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ToastrService } from 'ngx-toastr';
import { ShopService } from 'src/app/shop/services/shop.service';
@Component({
  selector: 'app-favorites',
  templateUrl: './favorites.component.html',
  styleUrls: ['./favorites.component.css'],
})
export class FavoritesComponent implements OnInit {
  isFavorite: boolean = false;
  public product: any = [];
  result: any;
  favProduct: any;
  delFav:any;
  data: any;
  parseData: any;
  constructor(
    private favorite: FavoriteService,
    public translate: TranslateService,
    private shop: ShopService,
    private toastr: ToastrService
  ) {}

  ngOnInit(): void {
    this.displayFav();
  }

  displayFav() {
    this.favorite.getFav().subscribe((res) => {
      console.log(res);
      this.result = res;
      this.favProduct = this.result.data.products;
      // console.log(this.favProduct);
    });
  }

  add(product: any) {
    // console.log(product);
    this.shop.addToCart(product).subscribe((res) => {
      this.result = res;
      this.data = this.result.data;
      // this.parseData = JSON.parse(this.data)
      console.log(this.result);
      if (this.result.status == 0) {
        this.toastr.error(this.data.data);
      } else {
        this.toastr.success('product added succefully');
      }
      console.log(res);
    });
  }

  removeFromFavorite(id: any) {
    this.favorite.deleteFromFav(id).subscribe((res) => {
      this.delFav = res;
      this.toastr.success(this.delFav.data.message);
      console.log(this.delFav);
      this.displayFav();
    });
  }
}

