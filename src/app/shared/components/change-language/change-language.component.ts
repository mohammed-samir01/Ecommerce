import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-change-language',
  templateUrl: './change-language.component.html',
  styleUrls: ['./change-language.component.css']
})
export class ChangeLanguageComponent implements OnInit {

  //____________ fix language after refresh ___________//
  currentLang: string;

  constructor(public translate: TranslateService) {
    this.currentLang = localStorage.getItem('currentLang') || 'en';
    this.translate.use(this.currentLang);
  }

  changeCurrentLang(lang:string) {
    this.translate.use(lang);
    localStorage.setItem('currentLang', lang);
  }
//______________________________________________________//

  ngOnInit(): void {
  }

}
