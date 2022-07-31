import { Products } from './../../../interfaces/Products';
import { Product } from './../../../models/product';
import { Component, OnInit } from '@angular/core';
import allProduct  from '../../../../assets/Products.json';
@Component({
  selector: 'app-filter',
  templateUrl: './filter.component.html',
  styleUrls: ['./filter.component.css']
})
export class FilterComponent implements OnInit {

  d : Array<Products> = allProduct;
  count = (this.d).length;

  constructor() { }

  ngOnInit(): void {
  }

}
