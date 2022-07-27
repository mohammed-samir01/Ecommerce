import { Component, OnInit } from '@angular/core';
import  WClothes  from '../../../../assets/woman-clothes.json';
import { WomanClothes } from './../../../interfaces/woman-clothes';

@Component({
  selector: 'app-woman-shirts-list',
  templateUrl: './woman-shirts-list.component.html',
  styleUrls: ['./woman-shirts-list.component.css']
})
export class WomanShirtsListComponent implements OnInit {

  WomanClothes : Array<WomanClothes> = WClothes; 

  constructor() { }

  ngOnInit(): void {
  }

}
