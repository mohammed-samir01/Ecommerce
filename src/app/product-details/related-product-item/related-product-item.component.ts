import { Component, OnInit, Input } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute } from '@angular/router';
import { ProductDetailsService } from './../services/product-details.service';

@Component({
  selector: 'app-related-product-item',
  templateUrl: './related-product-item.component.html',
  styleUrls: ['./related-product-item.component.css'],
})
export class RelatedProductItemComponent implements OnInit {
  @Input() relatedProduct: any = [];

  @Input() index: number = 0;

  slugTwo!: any;

  constructor(
    public translate: TranslateService,
    private route: ActivatedRoute,
    private service: ProductDetailsService
  ) {
    this.slugTwo = this.route.snapshot.paramMap.get('slug');
  }

  ngOnInit(): void {
    this.getSingleProductOfRalated();
  }

  getSingleProductOfRalated() {
    this.service.getSingleProduct(this.slugTwo).subscribe((res: any) => {
      console.log(res);
      // this.data = res['Product'];
      // this.images = res['Product']['media'];
      // this.Reviews = res['Product']['Reviews'];
      // this.currentRate = res['Product']['rating'];
      // this.DefaultImage = this.images[0]['image_name'];
      // this.ReviewsLength = res['Product']['Reviews'].length;
    });
  }
}
