import { Component, OnInit } from '@angular/core';
import { UserService } from '../../services/user.service';
import { ToastrModule, ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';

@Component({
  selector: 'app-orders',
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css'],
})
export class OrdersComponent implements OnInit {
  isDisplay: boolean = false;

  orders: any = [];
  oneOrder: any = [];
  data: any = [];
  message: any = [];
  result: any;
  orderData: any = [];

  constructor(
    public userService: UserService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.getAllOrders();
  }

  getAllOrders() {
    this.userService.getAllorders().subscribe((res) => {
      this.result = res;
      this.orders = this.result;
      console.log(this.orders);
    });
  }

  getOrderDetails(id) {
    this.userService.getOrder(id).subscribe((res) => {
      this.orderData = res;
      this.oneOrder = this.orderData.data.data;
      console.log(this.oneOrder);
    });

    this.isDisplay = !this.isDisplay;
  }

  deleteOrder(id) {
    this.userService.deleteOrder(id).subscribe((res) => {
      this.data = res;
      this.message = this.data.data.data;

      if (this.data.status == 0) {
        this.toastrService.error(this.data.data.data);
      } else {
        this.getAllOrders();
        this.toastrService.success(this.data.data.data);
      }
    });
  }

  deleteAllOrders() {
    this.userService.deleteAllOrders().subscribe((res) => {
      this.data = res;
      this.message = this.data.data.data;
      if (this.data.status == 0) {
        this.toastrService.error(this.data.data.data);
      } else {
        this.getAllOrders();
        this.toastrService.success(this.data.data.data)
      }
  })
}
}