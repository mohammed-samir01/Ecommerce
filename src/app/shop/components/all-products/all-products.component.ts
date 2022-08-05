import { Component, OnInit } from '@angular/core';
import { ShopService } from '../../services/shop.service';



@Component({
  selector: 'app-all-products',
  templateUrl: './all-products.component.html',
  styleUrls: ['./all-products.component.css']
})
export class AllProductsComponent implements OnInit {

  Products : any[] = [];
  Categories : any[]=[];
  cartProduct :any []=[];
  page: number = 1;
  count: number = 0;
  tableSize: number = 9;
  tableSizes: any = [3, 6, 9, 12];
  pagesNumber: number = 1;

  constructor(private service:ShopService) {

   }

  ngOnInit(): void {
    this.getProducts();
    this.getAllCate();
  }


  getProducts(){
    this.service.getAllProducts().subscribe((res:any) => {
    this.Products= res;
    this.count = (this.Products).length;
    })
  }

  getAllCate(){
    this.service.getAllCate().subscribe((res:any) => {
    this.Categories= res;
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
    })

  }



  onTableDataChange(event: any) {
    this.page = event;
    this.getAllCate();
  }
  onTableSizeChange(event: any): void {
    this.tableSize = event.target.value;
    this.page = 1;
    this.getAllCate();
  }

//  addToCart(event :any){
//   console.log(event)
//  if("cart" in localStorage){
//     this.cartProduct = JSON.parse(localStorage.getItem("cart") || '[]')
//     console.log(this.cartProduct)
//      let exist = this.cartProduct.find((item) => {
//       item.item.id == event.item.id
//       console.log(item.item.id)
//     })
//     //  console.log(item.item.id)
//      console.log(event.item.id)
//      console.log(exist)
//      if(exist){
//       alert('exist')
//     }
//      else
//      {
//      this.cartProduct.push(event);

//      localStorage.setItem('cart' , JSON.stringify(this.cartProduct));
//     }
// }
//   else{
//    this.cartProduct.push(event);
//    localStorage.setItem('cart' , JSON.stringify(this.cartProduct));
//   }

// }
// )localStorage.setItem('cart' ,JSON.stringify(event) );
// )console.log(event);
addToCart(event:any){

  if("cart" in localStorage){
    this.cartProduct=JSON.parse(localStorage.getItem("cart")||'[]');
    let exist=this.cartProduct.find(item=>item.item.id==event.item.id);
    if(exist){
      alert("this product is already in your cart")
    }
    else{
      this.cartProduct.push(event);
      localStorage.setItem("cart",JSON.stringify(this.cartProduct))
    }
  }
  else{
    this.cartProduct.push(event);
    localStorage.setItem("cart",JSON.stringify(this.cartProduct))
  }
}

}
