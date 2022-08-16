import { Component, OnInit } from '@angular/core';
import { ClassShop } from 'src/app/shop/class-shop';
import { CartsService } from './../../services/cart.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css'],
})
export class CartComponent implements OnInit {
  cartProduct: any[] = [];
  total: any = 0;
  cartclass = new ClassShop();
  constructor(private cartservice: CartsService) {}

  // ng on init
  ngOnInit(): void {
    this.cartservice.getCart().subscribe((res) => {
      this.cartProduct.push(res);
    });
    this.getTotal();
  }

  ///total price
  getTotal() {
    this.total = 0;
    for (let x in this.cartProduct) {
      this.total +=
        this.cartProduct[x].item.price * this.cartProduct[x].quantity;
    }
  }

  /////plus amount
  addAmount(index: number) {
    this.cartProduct[index].quantity++;
    this.getTotal();
    let quantity = this.cartclass.quantity;
    this.cartservice.updateQuantity(index, quantity);
  }
  ////minus amount
  minusAmount(index: number) {
    this.cartProduct[index].quantity--;
    this.getTotal();
    let quantity = this.cartclass.quantity;
    this.cartservice.updateQuantity(index, quantity);
  }

  ////delete product
  deleteProduct(index: number) {
    this.cartProduct.splice(index, 1);
    this.getTotal();
    this.cartservice.deleteProduct(this.cartProduct[index].id);
  }
}
