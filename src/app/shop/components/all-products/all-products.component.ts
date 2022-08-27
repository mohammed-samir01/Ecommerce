import { Component, Input, OnInit, Output, EventEmitter } from '@angular/core';
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

  data: any = {};

  page: number = 1;
  tableSize: number = 12;
  tableSizes: any = [3, 6, 9, 12];
  pagesNumber: number = 1;

  constructor(
    private route: ActivatedRoute,
    private shopservice: ShopService,
    public translate: TranslateService,
    public router: Router
  ) {}

  ngOnInit(): void {}

  getAllProducts() {
    this.shopservice.getAllProducts().subscribe((res) => {
      this.data = res;
      this.Products = this.data.data;
      this.Meta = this.data.meta;
      console.log(res);
      console.log(this.Products);
    });
  }

  goProducts(keyword: any) {
    this.getProductsByCategories(keyword);
  }

  getProductsByCategories(keyword: any) {
    this.shopservice.getProductsByCategories(keyword).subscribe((res: any) => {
      this.Products = res.data;
      this.data = {
        total: res.total,
        current_page: res.current_page,
        from: res.from,
        to: res.to,
        per_page: res.per_page,
      };
      this.Meta = this.data;
      sessionStorage.setItem('categoryName', keyword);
    });
  }

  getProductsByTags(keyword: any) {
    this.shopservice.getProductsByTags(keyword).subscribe((res: any) => {
      this.Products = res.data;
      this.data = {
        total: res.total,
        current_page: res.current_page,
        from: res.from,
        to: res.to,
        per_page: res.per_page,
      };
      this.Meta = this.data;
      sessionStorage.setItem('tagName', keyword);
    });
  }

  goToSpecificPage(num: any) {
    localStorage.setItem('page', num);
    this.shopservice.getAllProducts(num).subscribe((res) => {
      this.data = res;
      this.Products = this.data.data;
      this.Meta = this.data.meta;
      console.log(this.Meta.current_page);
    });
  }

  goToSpecificPageBasedOnCate(num: any) {
    this.shopservice.getProductsByCategoriesPyPage(num).subscribe((res) => {
      this.data = res;
      this.Products = this.data.data;
      this.Meta = {
        total: this.data.total,
        current_page: this.data.current_page,
        from: this.data.from,
        to: this.data.to,
        per_page: this.data.per_page,
      };
    });
  }

  goToSpecificPageBasedOnTag(num: any) {
    this.shopservice.getProductsByTagsPyPage(num).subscribe((res) => {
      this.data = res;
      this.Products = this.data.data;
      this.Meta = {
        total: this.data.total,
        current_page: this.data.current_page,
        from: this.data.from,
        to: this.data.to,
        per_page: this.data.per_page,
      };
      console.log(res);
    });
  }

  ProductByFilters() {
    this.shopservice;
  }


}
