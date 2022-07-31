import { Component, OnInit } from '@angular/core';
import{ShopService} from'../services/shop.service';
@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {
  //category
  categories :any[] =[];
  //product
  products :any[] =[];
  constructor(private productService : ShopService) { }

  ngOnInit(): void {
    
 //product
    this.getProducts();
     //category
     this.getCategory();
  }
    //product
  getProducts(){
     this.productService.getAllProducts().subscribe((res:any)=>{
      this.products = res;
     })
  }
getProductCategory(keyword:string){
  this.productService.getProductByCategory(keyword).subscribe((res:any)=>{
   this.products =res
  })

}
 //category
 getCategory(){
  this.productService.getAllCategory().subscribe((res:any)=>{
 this.categories = res;
 console.log(res)
  })
}

filterCategory(event:any){
let value = event.target.value;
console.log(value);

this.getProductCategory(value);
}

}
