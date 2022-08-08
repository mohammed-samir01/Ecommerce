import { Related } from '../../interfaces/related';
import { Component, OnInit  } from '@angular/core';
import  related  from '../../../assets/related.json';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-related-products',
  templateUrl: './related-products.component.html',
  styleUrls: ['./related-products.component.css']
})
export class RelatedProductsComponent implements OnInit {
  relatedProducts : Array<Related> = related;

  constructor(public translate: TranslateService) { }

  ngOnInit(): void {
  }

}
