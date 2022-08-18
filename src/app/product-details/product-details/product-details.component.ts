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
    this.getSingleProductOfRalated();
  }

  getProduct() {
    this.service.getSingleProduct(this.slug).subscribe((res: any) => {
      this.data = res['Product'];
      this.images = res['Product']['media'];
      this.Reviews = res['Product']['Reviews'];
      this.currentRate = res['Product']['rating'];
      this.DefaultImage = this.images[0]['file_name'];
      this.ReviewsLength = res['Product']['Reviews'].length;
    });
  }

  getRelatedProduct() {
    this.service.getRelatedProduct(this.slug).subscribe((result: any) => {
      this.RelatedProducts = result['data'];
      console.log(result['data']);
    });
  }

  getSingleProductOfRalated() {
    this.service.getSingleProduct(this.slug).subscribe((res: any) => {
      console.log(res);
      this.data = res['Product'];
      this.images = res['Product']['media'];
      this.currentRate = res['Product']['rating'];
      this.DefaultImage = this.images[0]['file_name'];
    });
  }
}
