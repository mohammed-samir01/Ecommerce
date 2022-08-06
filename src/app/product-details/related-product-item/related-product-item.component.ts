import { Related } from '../../interfaces/related';
import { Component, OnInit , Input} from '@angular/core';
<<<<<<< HEAD

=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
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
<<<<<<< HEAD
  constructor() { }
=======
  constructor(public translate: TranslateService) { }
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  ngOnInit(): void {
  }

}
