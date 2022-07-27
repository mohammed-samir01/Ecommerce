import { Component, OnInit, Input } from '@angular/core';
import { WomanClothes } from './../../../interfaces/woman-clothes';
import { Router } from '@angular/router';

@Component({
  selector: 'app-woman-shirts-card',
  templateUrl: './woman-shirts-card.component.html',
  styleUrls: ['./woman-shirts-card.component.css']
})
export class WomanShirtsCardComponent implements OnInit {

  constructor(private router:Router) { }

  ngOnInit(): void {
  }

    @Input() thing : WomanClothes = {
    "id": 1,
    "title": "Kui Ye Chen's",
    "image": "../../../assets/images/product-2.jpg",
    "price": "$250",
    "category": "Woman Clothes ",
    "status": "new"
  };

    goToShop(){
      this.router.navigate(['/']);
    }
}
