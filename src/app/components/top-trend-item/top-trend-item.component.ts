import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-top-trend-item',
  templateUrl: './top-trend-item.component.html',
  styleUrls: ['./top-trend-item.component.css']
})
export class TopTrendItemComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }

  products: any[] = 
    [
      {
      "id": 1,
      "title": "Kui Ye Chen's AirPods",
      "image": "../../../assets/images/product-1.jpg",
      "price": "$250",
      "category": "Electorincs",
      "status" : "none"
      },
      {
      "id": 2,
      "title": "Air Jordan 12 gym red",
      "image": "../../../assets/images/product-2.jpg",
      "price": "$300",
      "category": "Shoes",
      "status" : "sale"
      },
      {
      "id": 3,
      "title": "Cyan cotton t-shirt",
      "image": "../../../assets/images/product-3.jpg",
      "price": "$25",
      "category": "Clothes",
      "status" : "none"
      },
      {
      "id": 4,
      "title": "Timex Unisex Originals",
      "image": "../../../assets/images/product-4.jpg",
      "price": "$351",
      "category": "Electorincs",
      "status" : "New"
      }
      ,
      {
      "id": 5,
      "title": "Red digital smartwatch",
      "image": "../../../assets/images/product-5.jpg",
      "price": "$250",
      "category": "Electorincs",
      "status" : "sold"
      }
      ,
      {
      "id": 6,
      "title": "Joemalone Women prefume",
      "image": "../../../assets/images/product-6.jpg",
      "price": "$300",
      "category": "Accessories",
      "status" : "none"
      }
      ,
      {
      "id": 7,
      "title": "Nike air max 95",
      "image": "../../../assets/images/product-7.jpg",
      "price": "$200",
      "category": "Shoes",
      "status" : "none"
      }
      ,
      {
      "id": 8,
      "title": "Apple Watch",
      "image": "../../../assets/images/product-8.jpg",
      "price": "$100",
      "category": "Electorincs",
      "status" : "none"
      }
    ]

}
