import { ShopService } from './../../../shop/services/shop.service';
import { Component, OnInit, Input } from '@angular/core';
import { Router } from '@angular/router';
import { TranslateService } from '@ngx-translate/core';
import { ToastrService ,ToastrModule } from 'ngx-toastr';


@Component({
  selector: 'app-top-trend-item',
  templateUrl: './top-trend-item.component.html',
  styleUrls: ['./top-trend-item.component.css'],
})
export class TopTrendItemComponent implements OnInit {
  @Input() Product: any = [];

  isFavorite: boolean = false;
  isLoggedIn: boolean = false;
  result:any ;
  data: any;

  constructor(
    private router: Router,
    public translate: TranslateService,
    private toastr: ToastrService,
    private shop: ShopService
  ) {}

  ngOnInit(): void {}

  goToProductDetails(id: number) {
    this.router.navigate(['/product-details', this.Product.id]);
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


