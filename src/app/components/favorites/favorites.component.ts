import { Component, OnInit } from '@angular/core';
import { CartItem } from 'src/app/models/cart-item';

@Component({
  selector: 'app-favorites',
  templateUrl: './favorites.component.html',
  styleUrls: ['./favorites.component.css']
})
export class FavoritesComponent implements OnInit {
  cartProduct :any[]=[]
  constructor() { }

  ngOnInit(): void {
    this.addFav()
  }
  addFav(){
    console.log()
  }
}
