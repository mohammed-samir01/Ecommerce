import { TopTrend } from './../../../interfaces/top-trend';
import { Component, OnInit } from '@angular/core';
import  trends  from '../../../../assets/topTrend.json';

@Component({
  selector: 'app-top-trend-list',
  templateUrl: './top-trend-list.component.html',
  styleUrls: ['./top-trend-list.component.css']
})
export class TopTrendListComponent implements OnInit {

  trendProducts : Array<TopTrend> = trends; 
  constructor() { }

  ngOnInit(): void {
  }

}
