import { Component, OnInit , Input } from '@angular/core';
import { Category } from '../../../interfaces/category';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-cateogry-card',
  templateUrl: './cateogry-card.component.html',
  styleUrls: ['./cateogry-card.component.css']
})
export class CateogryCardComponent implements OnInit {

  @Input() category : Category = {
    "id": 2,
    "title": "Shoes",
    "image": "../../../assets/images/cat-img-2.jpg"
  };
  constructor(public translate: TranslateService) { }

  ngOnInit(): void {
  }

  // categoies: any[] = 
  //   [
  //     {
  //     "id": 1,
  //     "title": "Clothes",
  //     "image": "../../../assets/images/cat-img-1.jpg"
  //     },
  //     {
  //     "id": 2,
  //     "title": "Shoes",
  //     "image": "../../../assets/images/cat-img-2.jpg"
  //     },
  //     {
  //     "id": 3,
  //     "title": "Watches",
  //     "image": "../../../assets/images/cat-img-3.jpg"
  //     },
  //     {
  //     "id": 4,
  //     "title": "Electronics",
  //     "image": "../../../assets/images/cat-img-4.jpg"
  //     }
  //   ]

}
