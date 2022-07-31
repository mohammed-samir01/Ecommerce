import { Category } from './../../../interfaces/category';
import { Products } from './../../../interfaces/Products';
import { Component, OnInit } from '@angular/core';
import { Options , LabelType } from 'ng5-slider';
import { ShopService } from '../../services/shop.service';


@Component({
  selector: 'app-aside',
  templateUrl: './aside.component.html',
  styleUrls: ['./aside.component.css']
})
export class AsideComponent implements OnInit {

  

  constructor(private service:ShopService) { }

  ngOnInit(): void {
  }

  
}
