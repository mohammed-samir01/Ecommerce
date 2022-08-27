import { ShopService } from './../../shop/services/shop.service';
import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute } from '@angular/router';
import { ProductDetailsService } from './../services/product-details.service';
import { Router } from '@angular/router';
import { ToastrModule ,ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-related-product-item',
  templateUrl: './related-product-item.component.html',
  styleUrls: ['./related-product-item.component.css'],
})
export class RelatedProductItemComponent implements OnInit {
  @Input() relatedProduct: any = [];

  @Input() index: number = 0;

  @Output() getSingleProductOfRalated = new EventEmitter();

  isFavorite: boolean = false;
  isLoggedIn: boolean = false;

  result:any;
  data:any;


  constructor(
    public translate: TranslateService,
    private route: ActivatedRoute,
    private service: ProductDetailsService,
    private shop: ShopService,
    private toastr: ToastrService,
    private router: Router
  ) {}

  ngOnInit(): void {}

  getSingleRelated() {
    this.getSingleProductOfRalated.emit();
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
  ////add to cart
  add(product: any) {
    if (!this.isLoggedIn) {
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
    } else {
      this.router.navigate(['/login']).then(() => {
        window.location.reload();
      });
    }
    
  }
}
