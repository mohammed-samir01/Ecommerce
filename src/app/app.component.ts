import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  title = 'market';
  storedTheme: string | null = localStorage.getItem('theme-color');
  showChatBox: boolean = false;


  constructor(public translate: TranslateService) { }
  ngOnInit() { }

  setTheme(theme : string) {
    localStorage.setItem('theme-color', theme);
    this.storedTheme = localStorage.getItem('theme-color');
  }

  goToUp(){
    document.body.scrollTop = document.documentElement.scrollTop = 0;
  }

}