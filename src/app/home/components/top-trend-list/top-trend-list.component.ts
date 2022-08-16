import { Component, OnInit } from '@angular/core';
import { HomeService } from './../../service/home.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-top-trend-list',
  templateUrl: './top-trend-list.component.html',
  styleUrls: ['./top-trend-list.component.css']
})
export class TopTrendListComponent implements OnInit {

  TopTrend :any [] = []
  Products : any  =[];
  slug : any =""; 

  constructor(private route : ActivatedRoute,private homeService:HomeService) {
        this.slug = this.route.snapshot.paramMap.get("slug");
        console.log(this.slug);
   }

  ngOnInit(): void {
    this.getTopTrendProducts();

  }

  getTopTrendProducts(){
    this.homeService.getTopTrendsProducts().subscribe((res:any) => {
      this.TopTrend = res['Featured_Products'];
      console.log(res['Featured_Products']);
    
    })
  }

// getSingleProduct(){
//     this.homeService.getSingleProduct(this.slug).subscribe((res:any) => {
//       this.Product = res;
//       console.log(res['product']['product']);
//     });
//   }


}
