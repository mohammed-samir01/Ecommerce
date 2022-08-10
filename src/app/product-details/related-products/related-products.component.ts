
import { Component, OnInit  } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute } from '@angular/router';
import { ProductDetailsService } from './../services/product-details.service';
@Component({
  selector: 'app-related-products',
  templateUrl: './related-products.component.html',
  styleUrls: ['./related-products.component.css']
})
export class RelatedProductsComponent implements OnInit {
  relatedProducts : any[] = [];
  slug!:any

  constructor(public service: ProductDetailsService,

    private route:ActivatedRoute) {
      this.slug = this.route.snapshot.paramMap.get("slug");
    }


  ngOnInit(): void {
    this.getRelated();
  }
  getRelated(){
    this.service.getRelatedProduct(this.slug).subscribe((res:any)=>{
      // this.data = res['Product'];
      // this.images = res['Product']['media'];
      console.log(res)
    })
  }
}
