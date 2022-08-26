import { FavoriteService } from './../../../components/favorites/service/favorite.service';
import { Component, Input, OnInit, Output, EventEmitter } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ShopService } from '../../services/shop.service';
import { ProductDetailsService } from './../../../product-details/services/product-details.service';
import { ToastrService } from 'ngx-toastr';
import { CartsService } from 'src/app/carts/services/cart.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-product-item',
  templateUrl: './product-item.component.html',
  styleUrls: ['./product-item.component.css'],
})
export class ProductItemComponent implements OnInit {
  isLoggedIn: Boolean = false;
  isFavorite: boolean = false;
  count = 0;
  result: any;
  data: any;
  @Input() Product: any = [];

  @Input() Images: any = [];

  productCart: any[] = [];

  @Output() item = new EventEmitter();

  cart: any = [];

  singleProduct: any = [];
  productData: any;

  constructor(
    private favorite: FavoriteService,
    public translate: TranslateService,
    private shop: ShopService,
    private productDetails: ProductDetailsService,
    private toastr: ToastrService,
    private cartservice: CartsService,
    public router: Router
  ) {}

  ngOnInit(): void {}

  getSingleProductDetails(keyword: any) {
    this.productDetails.getSingleProduct(keyword).subscribe((res) => {
      this.productData = res;
      this.singleProduct = this.productData.Product;
      console.log(this.singleProduct);
    });
  }

  add(product: any) {
    this.shop.addToCart(product).subscribe((res) => {
      this.cart.push(product);
      console.log(this.cart);
      this.result = res;
      this.data = this.result.data;
      console.log(this.result);
      if (this.result.status == 0) {
        this.toastr.error(this.data.data);
      } else {
        this.toastr.success('Product added successfully');
      }
    });
  }

  addFav(Product: any) {
    if (!this.isLoggedIn) {
      this.isFavorite = !this.isFavorite;
      this.shop.addToFav(Product).subscribe((res) => {
        console.log(res);
      });
    } else {
      this.router.navigate(['/login']).then(() => {
        window.location.reload();
      });
    }
  }
}
