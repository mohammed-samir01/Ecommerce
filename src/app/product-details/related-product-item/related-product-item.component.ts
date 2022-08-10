
import { Component, OnInit , Input} from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ProductDetailsService } from './../services/product-details.service';
@Component({
  selector: 'app-related-product-item',
  templateUrl: './related-product-item.component.html',
  styleUrls: ['./related-product-item.component.css']
})
export class RelatedProductItemComponent implements OnInit {

   @Input() relatedProduct : any =[]
  constructor(public translate: TranslateService,
    public service: ProductDetailsService,) { }

  ngOnInit(): void {
  }

}
