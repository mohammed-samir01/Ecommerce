import { Related } from './../../../interfaces/related';
import { Component, OnInit  } from '@angular/core';
import  related  from '../../../../assets/related.json';
@Component({
  selector: 'app-related-products',
  templateUrl: './related-products.component.html',
  styleUrls: ['./related-products.component.css']
})
export class RelatedProductsComponent implements OnInit {
  relatedProducts : Array<Related> = related;

  constructor() { }

  ngOnInit(): void {
  }

}
