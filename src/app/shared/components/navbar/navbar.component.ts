
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

  constructor(
    private favorite: FavoriteService,
    public translate: TranslateService,
    private cartservice: CartsService,
    private authService: AuthService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.isLoggedIn = this.authService.isLoggedIn();

    this.favorite.getProducts().subscribe((res) => {
      this.totalItem = res.length;
    });

  }

  onLogOut() {
    this.authService.loginOut().subscribe((res) => {
      console.log(res);
      this.toastrService.success(' Logged out successfully ');
      this.router.navigate(['/login']).then(() => {
        window.location.reload();
      });
      localStorage.removeItem('token');
      localStorage.clear();
    });
  }
}
