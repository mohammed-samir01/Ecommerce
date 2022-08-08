import { Products } from './../../../interfaces/Products';
import { Component, OnInit, Input } from '@angular/core';
import { HomeService } from './../../service/home.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-top-trend-list',
  templateUrl: './top-trend-list.component.html',
  styleUrls: ['./top-trend-list.component.css']
})
export class TopTrendListComponent implements OnInit {

  TopTrend :any [] = []


  constructor(private homeService:HomeService) {
        
   }

  ngOnInit(): void {
    this.getTopTrendProducts();

  }

  getTopTrendProducts(){
    this.homeService.getTopTrendsProducts().subscribe((res:any) => {
      this.TopTrend = res['Featured_Products'];
      console.log(res['Featured_Products']);

      // for (let i = 0; i < this.TopTrend.length; i++) {
      //   const element = this.TopTrend[i]['slug'];
      //   console.log(element);
      // }
    })
  }


// getSingleProduct(){
//     this.homeService.getSingleProduct(this.slug).subscribe((res:any) => {
//       this.Products = res;
//       console.log(res['product']['product']);
//     });
//   }

  //   onclick(index :any){
  //   // return this.Product
  //   console.log(index);
  // }

}
