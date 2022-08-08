import { Component, OnInit, Input } from '@angular/core';
import { Router } from '@angular/router';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-top-trend-item',
  templateUrl: './top-trend-item.component.html',
  styleUrls: ['./top-trend-item.component.css']
})
export class TopTrendItemComponent implements OnInit {

  @Input() Product : any =[];
  @Input() index!: number;

  constructor(private router:Router,
  public translate: TranslateService) { }

  ngOnInit(): void {
    console.log(this.index);
    // this.onclick(this.index);
  }


  goToProductDetails(id:number){
      this.router.navigate(['/product-details',this.Product.id]);
  }
    
  // onclick(index :any){
  //   // return this.Product
  //   console.log(index);
  // }

}


