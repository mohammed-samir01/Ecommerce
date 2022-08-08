import { Component, OnInit  } from '@angular/core';
import { Product } from 'src/app/models/product';
import {CartService } from'../service/cart.service';
@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css'],
  providers:[CartService]
})
export class CartComponent implements OnInit {
  cartProduct :any[]=[]
  total: any = 0
  constructor(private cartservice : CartService) { }

  ngOnInit(): void {
     this.cartItem()
  }

  cartItem(){
    if("cart" in localStorage){
      this.cartProduct = JSON.parse(localStorage.getItem("cart")!)|| []

      }
    this.getTotal()
  }
  getTotal(){
    this.total=0
    for(let x in this.cartProduct){
      this.total += this.cartProduct[x].item.price * this.cartProduct[x].quantity
    }
  }
  addAmount(index:number){
    this.cartProduct[index].quantity++
    this.getTotal()
    localStorage.setItem('cart' , JSON.stringify(this.cartProduct));

  }

  minusAmount(index:number){
    this.cartProduct[index].quantity--
    this.getTotal()
    localStorage.setItem('cart' , JSON.stringify(this.cartProduct));

  }

  detectAmount(){
    localStorage.setItem('cart' , JSON.stringify(this.cartProduct));
  }

  deleteProduct(index:number){
    this.cartProduct.splice(index ,1 )
    this.getTotal()
    localStorage.setItem('cart' , JSON.stringify(this.cartProduct));
  }
  //to backend
  addCart(){
let products = this.cartProduct.map(item=>{
 return {ProductId : item.item.id , quantuty: item.quantity}
})
    let Model={
      userId:5,
      date : new Date(),
      products:products
    }
    console.log(this.cartProduct)
    console.log(Model)
    // this.cartservice.setProduct(this.cartProduct)
    this.cartservice.setProduct(this.cartProduct)
    // setProduct(this.cartProduct)

  }

}
