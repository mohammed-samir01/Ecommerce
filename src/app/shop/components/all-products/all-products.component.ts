import { Component, OnInit } from '@angular/core';
import { ShopService } from '../../services/shop.service';
import { Options , LabelType } from 'ng5-slider';


@Component({
  selector: 'app-all-products',
  templateUrl: './all-products.component.html',
  styleUrls: ['./all-products.component.css']
})
export class AllProductsComponent implements OnInit {

  Products : any[] = []; 
  Categories : any[]=[];
  count :number =0;
  constructor(private service:ShopService) { }

  ngOnInit(): void {
    this.getProducts()
    this.getAllCate();
    
  }

  filters : Array<string> = ["Returns Accepted","Returns Accepted","Completed Items","Sold Items","Deals &amp; Savings","Authorized Seller"];
  formats : Array<string> = ["All Listings","Best Offer","Auction","Buy It Now"];


  minValue: number = 1000;
  maxValue: number = 4000;
  options: Options = {
    floor: 0,
    ceil: 5000,
    translate: (value: number, label: LabelType): string => {
      switch (label) {
        case LabelType.Low:
          return '$' + value;
        case LabelType.High:
          return '$' + value;
        default:
          return '$' + value;
      }
    }
  };

  getProducts(){
    this.service.getAllProducts().subscribe((res:any) => {
      this.Products= res;
      this.count = (this.Products).length;
    })
  }

  getAllCate(){
    this.service.getAllCate().subscribe((res:any) => {
      this.Categories= res;
      console.log(this.Categories);
    })
  }

  filter(event:any){
    let value = event.target.value;
    console.log(value);
    this.getProductsByCate(value)
  }

    getProductsByCate(keyword:string){
    this.service.getProductsByCate(keyword).subscribe((res:any) => {
      this.Products= res;
      console.log(this.Products);
    })
  }
}
