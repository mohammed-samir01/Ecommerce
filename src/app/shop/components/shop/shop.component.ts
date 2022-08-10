import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ShopService } from '../../services/shop.service';
@Component({
  selector: 'app-shop',
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css'],
})
export class ShopComponent implements OnInit {
  data : any = [];
  Products : any[] = [];
  count: number = 0;
  to :number = 0;
  perPge :number =0
  Images :any[]=[];
  constructor(public translate: TranslateService,
    private shopservice: ShopService) { }

  ngOnInit(): void {
  this.getCategory();
  this.getProducts();
  }
  getCategory(){
    this.shopservice.getcategory().subscribe((res:any)=>{
       res = this.data
       console.log(res['id'])
// this.cat =  res['children']
// console.log(this.cat)
      // for(let i =0 ; i < this.cat.length ; i++){
      //   console.log(this.cat[i])
      // }
    })
  }

  getProducts(){
    this.shopservice.getAllProducts().subscribe((res:any) => {
      this.Products = res['data'];

      this.count    = res.meta.total;
      this.to = res.meta.to
      this.perPge = res.meta.per_page
    
      for (let i = 0; i < this.Products.length; i++) {
        this.Images = this.Products[i]['media'];
      }



    })
  }
}
