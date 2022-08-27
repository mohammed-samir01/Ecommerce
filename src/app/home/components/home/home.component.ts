import { AuthService } from './../../../components/auth/services/auth.service';
import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css'],
})
export class HomeComponent implements OnInit {

  result :any =[]
  token :any
  constructor(
    public translate: TranslateService,
    private authService: AuthService
  ) {}

  ngOnInit(): void {
    
    this.refreshToken();
  }

  refreshToken() {
    this.authService.TokenRefresh().subscribe(res=>{
      this.result = res
      this.token = this.result.authorisation.token;
      localStorage.setItem('token' ,this.token)
      console.log(this.token);
      console.log(this.result);
    });
  }
}
