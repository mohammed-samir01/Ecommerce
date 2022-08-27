import { Component, OnInit } from '@angular/core';
import {
  FormControl,
  FormGroup,
  Validators,
  FormBuilder,
} from '@angular/forms';
import { ClassShop } from 'src/app/shop/class-shop';
import { CartsService } from './../../services/cart.service';
import { ToastrModule, ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css'],
})
export class CartComponent implements OnInit {
  couponForm: any = FormGroup;

  cartProduct: any[] = [];

  total: any = 0;
  result: any;
  message: any;
  data: any;

  constructor(
    private cartservice: CartsService,
    private toastr: ToastrService
  ) {}

  // ng on init
  ngOnInit(): void {
    this.displayCart();
    this.getTotal();
  }

  displayCart() {
    this.cartservice.getCart().subscribe((res) => {
      this.result = res;
      this.cartProduct = this.result.Products;
      this.getTotal();
    });
  }

  /////plus amount
  addAmount(id: number, index: number) {
    this.cartProduct[index].quantity++;
    this.getTotal();
    this.cartservice.updateQuantity(id, this.cartProduct[index].quantity)
    .subscribe((res) => {
      console.log(res);
    });
  }


  ////minus amount
  minusAmount(id: number, index: number) {
    if (this.cartProduct[index].quantity > 1) {
      this.cartProduct[index].quantity--;
      this.cartservice.updateQuantity(id, this.cartProduct[index].quantity)
      .subscribe((res) => {
        console.log(res);
      });
      this.getTotal();
    } 
    
    else {
      this.cartProduct[index].quantity = 1;
      this.cartservice.updateQuantity(id, this.cartProduct[index].quantity)
      .subscribe((res) => {
        console.log(res);
      });
      this.getTotal();
    }
  }

  ////delete product
  deleteProduct(index: number) {

    this.cartservice.deleteProduct(index).subscribe((res) => {
      this.data = res;
      this.toastr.success(this.data.data.cart);
      this.displayCart();
    });
  }

  ///total price
  getTotal() {
    this.total = 0;
    for (let x in this.cartProduct) {
      this.total += this.cartProduct[x].price * this.cartProduct[x].quantity;
      // localStorage.setItem('subtotal', this.total);
    }
  }
}
