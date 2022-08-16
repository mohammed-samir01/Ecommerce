import { Component, Input, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute } from '@angular/router';
import { ShopService } from '../../services/shop.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-all-products',
  templateUrl: './all-products.component.html',
  styleUrls: ['./all-products.component.css'],
})
export class AllProductsComponent implements OnInit {
  @Input() Categories: any = [];

  @Input() Tags: any = [];

  @Input() Meta: any = [];

  @Input() ProductsByCategory: any = [];

  @Input() ProductsLength: number = 0;

  @Input() Products: any = [];

  Images: any[] = [];

  cartProducts: any[] = [];

  // @Input() count: number = 0;

  // @Input() perPge: number = 0;

  // @Input() to: number = 0;
  // page: number = 1;
  // tableSize: number = 12;
  // tableSizes: any = [3, 6, 9, 12];
  // pagesNumber: number = 1;

  constructor(
    private route: ActivatedRoute,
    private shopservice: ShopService,
    public translate: TranslateService,
    public router: Router
  ) {}

  ngOnInit(): void {}

  goProducts(keyword: any) {
    this.router.navigate(['/shop'], {
      queryParams: { CategoryName: keyword } || 0,
    });
    this.getProductsByCategories(keyword);
  }

  getProductsByCategories(keyword: any) {
    this.shopservice.getProductsByCategories(keyword).subscribe((res: any) => {
      this.Products = res['data'];
      this.Meta = [res.total, res.current_page, res.from, res.to, res.per_page];
    });
  }

  goProductsByTags(keyword: any, num?: number) {
    this.router.navigate(['/shop'], {
      queryParams: { CategoryName: keyword, page: num } || 0,
    });
    this.getProductsByTags(keyword);
  }

  getProductsByTags(kayword: any) {
    this.shopservice.getProductsByTags(kayword).subscribe((res: any) => {
      this.Products = res['data'];
      this.Meta = [res.total, res.current_page, res.from, res.to, res.per_page];
    });
  }

  goToSpecificPage(num: any) {
    this.router.navigate(['/shop'], {
      queryParams: { page: num || 1 },
    });
    this.getProductsByCategoriesPage(num);
  }

  getProductsByCategoriesPage(num: any) {
    this.shopservice
      .getProductsByCategoriesPagination(num)
      .subscribe((res: any) => {
        this.Products = res['data'];
        this.Meta = [
          res.total,
          res.current_page,
          res.from,
          res.to,
          res.per_page,
        ];
      });
  }

  // onTableDataChange(event: any) {
  //   this.Meta[1] = event;
  //   this.Products;
  //   this.router.navigate(['/shop'], {
  //         queryParams: { page: event } || 0,
  //       });
  //       this.getProductsByCategories(event);
  // }
  // onTableSizeChange(event: any): void {
  //   this.Meta[4] = event.target.value;
  //   this.Meta[1] = 1;
  //   this.Products;
  // }

  addToCart(event: any) {
    if ('cart' in localStorage) {
      this.cartProducts = JSON.parse(localStorage.getItem('cart')!) || [];
      let exist = this.cartProducts.find(
        (item: any) => item.item.slug == event.item.slug
      );

      if (exist) {
        // window.print('error')
        alert('Product is already in your cart');
        //  return( '<div class="alert alert-primary" role="alert"> This is a primary alert—check it out!</div>')
      } else {
        this.cartProducts.push(event);
        localStorage.setItem('cart', JSON.stringify(this.cartProducts));
      }
    } else {
      this.cartProducts.push(event);
      localStorage.setItem('cart', JSON.stringify(this.cartProducts));
    }
  }
}
