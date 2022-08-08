import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-change-theme',
  templateUrl: './change-theme.component.html',
  styleUrls: ['./change-theme.component.css']
})
export class ChangeThemeComponent implements OnInit {
  storedTheme: string | null = localStorage.getItem('theme-color');


  constructor() { }

  ngOnInit() { }

  setTheme(theme : string) {
    localStorage.setItem('theme-color', theme);
    this.storedTheme = localStorage.getItem('theme-color');
  }
}