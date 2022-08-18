import { FavoriteService } from './../../../components/favorites/service/favorite.service';
import { Component, Input, OnInit, Output, EventEmitter } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ShopService } from '../../services/shop.service';
import { ProductDetailsService } from './../../../product-details/services/product-details.service';
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

  productCart: any[] = [];

  @Output() item = new EventEmitter();

  result :any;

  data :any

  cart : any = []

  singleProduct :any=[]
  productData: any;

  constructor(
    private favorite: FavoriteService,
    public translate: TranslateService,
    private shop: ShopService,
    private productDetails: ProductDetailsService,
    private toastr: ToastrService,
    private cartservice: CartsService
  ) {}

  ngOnInit(): void {}


  getSingleProductDetails(keyword :any){
    this.productDetails.getSingleProduct(keyword).subscribe(res=>{
      this.productData = res
      this.singleProduct = this.productData.Product;
      console.log(this.singleProduct);
    })
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
        this.toastr.success(this.data.messsage);
      }
    });
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
