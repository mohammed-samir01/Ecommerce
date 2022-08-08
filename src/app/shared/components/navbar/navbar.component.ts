import { FavoriteService } from './../../../components/favorites/service/favorite.service';
import { Component, OnInit, } from '@angular/core';
import { Router } from '@angular/router';
import { TranslateService } from '@ngx-translate/core';


@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

  totalItem :number = 0;
  
  constructor(private favorite :FavoriteService,
    public translate: TranslateService) { }

  ngOnInit(): void {
    this.favorite.getProducts().subscribe(res=>{
      this.totalItem = res.length;
    })
  }
}
