import { Component, OnInit } from '@angular/core';
import {CartService } from'../service/cart.service';
@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css'],
  providers:[CartService]
})
export class CheckoutComponent implements OnInit {
  allProducts :any[]=[]
  constructor(private checkservice : CartService) { }

  ngOnInit(): void {
    // this.allProducts.push(this.checkservice.allProd)
   this.allProducts =  this.checkservice.getProduct()
   console.log(this.allProducts)
  }

}
