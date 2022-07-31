import { Component, OnInit } from '@angular/core';
import { ShopService } from '../services/shop.service';
// import {ProductsComponent} from '../products/products.component';

@Component({
  selector: 'app-categories',
  templateUrl: './categories.component.html',
  styleUrls: ['./categories.component.css']
})
export class CategoriesComponent implements OnInit {
  categories :any[] =[];
  constructor(private categoryService:ShopService ) { }

  ngOnInit(): void {
    this.getCategory();
  }
  getCategory(){
    this.categoryService.getAllCategory().subscribe((res:any)=>{
   this.categories = res;
   console.log(res)
    })
 }

 filterCategory(event:any){
  let value = event.target.html;
  console.log(value);
 
  // this.test.getProductCategory(value);
 }
}
