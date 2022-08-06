import { Component, OnInit } from '@angular/core';
import  trends  from '../../../../assets/topTrend.json';
import { TopTrend } from './../../../interfaces/top-trend';
<<<<<<< HEAD

=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

@Component({
  selector: 'app-top-trend-list',
  templateUrl: './top-trend-list.component.html',
  styleUrls: ['./top-trend-list.component.css']
})
export class TopTrendListComponent implements OnInit {

  trendProducts : Array<TopTrend> = trends; 
<<<<<<< HEAD
  constructor() { }
=======
  constructor(
    public translate: TranslateService) { }
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  ngOnInit(): void {
  }

}
