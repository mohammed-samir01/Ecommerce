import { UserService } from './../../../user/services/user.service';

import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { CartsService } from 'src/app/carts/services/cart.service';
import { AuthService } from './../../../components/auth/services/auth.service';
import { FavoriteService } from './../../../components/favorites/service/favorite.service';
import { ToastrModule, ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent implements OnInit {
  isLoggedIn: Boolean = false;

  totalItem: number = 0;

  cartProduct: any[] = [];
  cartLength: number = 0;
  result: any=[];
  username :any

  constructor(
    private favorite: FavoriteService,
    public translate: TranslateService,
    private cartservice: CartsService,
    private authService: AuthService,
    private userService: UserService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.getUsername();
    this.isLoggedIn = this.authService.isLoggedIn();

    // this.favorite.getFav().subscribe((res) => {
    //   this.totalItem = res.length;
    // });
  }

  getUsername() {
    this.userService.getUserData().subscribe(res=>{
      this.result= res;
      this.username = (this.result.user.first_name + " " + this.result.user.last_name)
    });
  }

  onLogOut() {
    this.authService.loginOut().subscribe((res) => {
      console.log(res);
      this.toastrService.success(' Logged out successfully ');
      this.router.navigate(['/']).then(() => {
        window.location.reload();
      });
      localStorage.removeItem('token');
      localStorage.clear();
    });
  }
}
