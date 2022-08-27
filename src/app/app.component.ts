import { LiveChatService } from './shared/components/live-chat/live-chat.service';
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

  isDisplay: boolean = false;

  constructor(
    private authService: AuthService,
    private liveChatService: LiveChatService
  ) {}

  ngOnInit(): void {
    this.isLoggedIn = this.authService.isLoggedIn();
    this.status();
  }

  status() {
    let id = 1;
    if (this.authService.token != null) {
      let token = this.authService.token;
      let status = 1;
      this.authService.status(status).subscribe((res) => {});
    }
    else{
      let status = 0;
      this.authService.status(status).subscribe((res) => {});
    }
  }

  onClickChat() {
    let id = 1;
    this.liveChatService.createChat(id).subscribe((res) => {
      console.log(res);
    });
  }

  goToUp(){
    document.body.scrollTop = document.documentElement.scrollTop = 0;
  }
}
