import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductDetailsService } from './../services/product-details.service';
import { TranslateService } from '@ngx-translate/core';


@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.css'],
})
export class ProductDetailsComponent implements OnInit {
  slug!: any;

  slugTwo!: any;

  data: any = [];

  Reviews: any = [];

  images: any = [];

  DefaultImage = '';

  currentRate: number = 0;

  ReviewsLength: number = 0;

  RelatedProducts: any = [];

  // RelatedImages: any = [];
  // RImages : any =[];

  constructor(
    private route: ActivatedRoute,
    private service: ProductDetailsService,
    public translate: TranslateService
  ) {
    this.slug = this.route.snapshot.paramMap.get('slug');
    this.slugTwo = this.route.snapshot.paramMap.get('slug');
  }

  ngOnInit(): void {
    this.getProduct();
    this.getRelatedProduct();
  }

  getProduct() {
    this.service.getSingleProduct(this.slug).subscribe((res: any) => {
      this.data = res['Product'];
      this.images = res['Product']['media'];
      this.Reviews = res['Product']['Reviews'];
      this.currentRate = res['Product']['rating'];
      this.DefaultImage = this.images[0]['image_name'];
      this.ReviewsLength = res['Product']['Reviews'].length;
    });
  }

  getRelatedProduct() {
    this.service.getRelatedProduct(this.slug).subscribe((result: any) => {
      this.RelatedProducts = result['Product'];

      // for (let i = 0; i < this.RelatedProducts.length; i++) {
      //   const items = this.RelatedProducts[i]['media'][0];
      //   return items
      // }
      // this.RelatedImages = this.items;
    });
  }

  //   for (this.i = 0; this.i < this.Categories.length; this.i++) {
  //   this.Children.push(this.Categories[this.i]['children']);

  //   // for (this.j = 0; this.j < this.elem.length; this.j++) {
  //   //   this.element.push(this.elem[this.j]);
  //   // }
  // }

  // Children: any = [];

  // i: number = 0;

  // j: number = 0;

  // element: any = [];
}