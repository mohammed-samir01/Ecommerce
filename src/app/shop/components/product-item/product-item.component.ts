import { FavoriteService } from './../../../components/favorites/service/favorite.service';
import { Component, Input, OnInit , Output , EventEmitter  } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ShopService } from '../../services/shop.service';
// import { ClassShop } from '../../class-shop';
import { ToastrService } from 'ngx-toastr';
import { CartsService } from 'src/app/carts/services/cart.service';
@Component({
  selector: 'app-product-item',
  templateUrl: './product-item.component.html',
  styleUrls: ['./product-item.component.css'],
})
export class ProductItemComponent implements OnInit {
  isFavorite: boolean = false;

  @Input() Product: any = [];

  @Input() Images: any = [];

  productCart :any[] = []

  @Output() item = new EventEmitter();

  constructor(
    private favorite: FavoriteService,
    public translate: TranslateService,
    private shop: ShopService,
    private toastr: ToastrService,
    private cartservice: CartsService
  ) {}

  ngOnInit(): void {}

  add(product: any) {
    this.cartservice.getCart().subscribe((res) => {
      this.productCart.push(res);
    });
    for (let i = 0; i < this.productCart.length; i++) {
      if (product === this.productCart[i].id) {
        this.toastr.error('this product exist');
      } else {
        this.toastr.success('product add successfully');
        this.shop.addToCart(product).subscribe((res) => {
          console.log(res);
        });
      }
    }
    console.log(this.Product);
    // this.item.emit({ item: this.Product, quantity: 1 });
  }

  onFavoriteClick(Product: any) {
    this.isFavorite = !this.isFavorite;
    this.favorite.addToFavorite(Product);
    console.log(Product);
  }

  removeFromFavorite(Product: any) {
    this.isFavorite = this.isFavorite;
    this.favorite.removeFromFavorite(Product);
  }
}


