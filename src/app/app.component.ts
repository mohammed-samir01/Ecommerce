import { Component } from '@angular/core';
import { AuthService } from './components/auth/services/auth.service';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  title = 'market';
  isLoggedIn: Boolean = false;

  constructor(private authService: AuthService) {}

  ngOnInit(): void {
    this.isLoggedIn = this.authService.isLoggedIn(); 
  }
}
