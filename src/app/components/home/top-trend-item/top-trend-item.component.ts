import { Component, OnInit , Input } from '@angular/core';
import { TopTrend } from '../../../interfaces/top-trend';
import { Router } from '@angular/router';
<<<<<<< HEAD
=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
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

<<<<<<< HEAD
  constructor(private router:Router) { }
=======
  constructor(private router:Router,
  public translate: TranslateService) { }
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  ngOnInit(): void {
  }


    goToProductDetails(id:number){
      this.router.navigate(['/product-details',this.product.id]);
    }

}
