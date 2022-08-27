import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { AuthService } from './../../../components/auth/services/auth.service';
import { UserService } from './../../services/user.service';

@Component({
  selector: 'app-user-page',
  templateUrl: './user-page.component.html',
  styleUrls: ['./user-page.component.css'],
})
export class UserPageComponent implements OnInit {
  asideName: string = 'Profile';
  Aside: any = ['Profile', 'Addresses', 'Orders'];

  isLoggedIn: Boolean = false;

  constructor(
    private authService: AuthService,
    private userService: UserService,
    public router: Router,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.isLoggedIn = this.authService.isLoggedIn();
  }
  onClick(event: any) {
    // localStorage.setItem('asideName', event);
    this.asideName = event;
    console.log(this.asideName);
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
