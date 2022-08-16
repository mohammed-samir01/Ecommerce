import { Component, OnInit, SimpleChanges } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ShopService } from '../../services/shop.service';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';


@Component({
  selector: 'app-shop',
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css'],
})
export class ShopComponent implements OnInit {
  //aside
  Categories: any = [];

  Tags: any = [];

  //products
  data: any = [];

  Products: any = [];

  Images: any = [];

  ProductsLength: number = 0;

  //pagination

  Meta: any = [];

  // count: number = 0;

  // to: number = 0;

  // perPge: number = 0;

  //Product By Category
  CategoryName: any = [];

  constructor(
    public router: Router,
    private route: ActivatedRoute,
    private shopservice: ShopService,
    public translate: TranslateService
  ) {
    // this.route.queryParams.subscribe((data) => {
    //   this.CategoryName = data['CategoryName'];
    //   console.log(this.CategoryName);
    // });
    this.getProducts();
  }

  ngOnInit(): void {
    this.getProducts();
    this.getSubCategories();
    this.getTags();
  }

  getProducts() {
    this.shopservice.getAllProducts().subscribe((res: any) => {
      this.Products = res['data'];
      this.ProductsLength = res['data'].length;
      this.Meta = [res.meta.total, res.meta.current_page, res.meta.from, res.meta.to, res.meta.per_page]

      for (let i = 0; i < this.Products.length; i++) {
        this.Images = this.Products[i]['media'];
      }
    });
  }

  getSubCategories() {
    this.shopservice.getSubCategories().subscribe((res: any) => {
      this.Categories = res;
    });
  }

  getTags() {
    this.shopservice.getAllTags().subscribe((res: any) => {
      this.Tags = res;
    });
  }
}
