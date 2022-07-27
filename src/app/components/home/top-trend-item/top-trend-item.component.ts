// import { TopTrend } from './../../../interfaces/top-trend';
import { Component, OnInit , Input } from '@angular/core';
import { TopTrend } from '../../../interfaces/top-trend';
import { Router } from '@angular/router';
@Component({
  selector: 'app-top-trend-item',
  templateUrl: './top-trend-item.component.html',
  styleUrls: ['./top-trend-item.component.css']
})
export class TopTrendItemComponent implements OnInit {

  @Input() product : TopTrend = {
    "id": 1,
    "title": "Kui Ye Chen's AirPods",
    "image": "../../../assets/images/product-1.jpg",
    "price": "$250",
    "category": "Electorincs",
    "status": "none"
  };

  constructor(private router:Router) { }

  ngOnInit(): void {
  }


    goToProductDetails(id:number){
      this.router.navigate(['/product-details',this.product.id]);
    }

}
