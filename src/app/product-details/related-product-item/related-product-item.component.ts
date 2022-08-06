import { Related } from '../../interfaces/related';
import { Component, OnInit , Input} from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-related-product-item',
  templateUrl: './related-product-item.component.html',
  styleUrls: ['./related-product-item.component.css']
})
export class RelatedProductItemComponent implements OnInit {
 
    @Input() relatedProduct : Related = {
    "id": 1,
    "title": "Kui Ye Chen's AirPods",
    "image": "../../../assets/images/product-1.jpg",
    "price": "$250",
    "category": "Electorincs",
    "status": "none"
  };
  constructor(public translate: TranslateService) { }

  ngOnInit(): void {
  }

}
