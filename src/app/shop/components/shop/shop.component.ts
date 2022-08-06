import { Component, OnInit } from '@angular/core';
<<<<<<< HEAD

=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@Component({
  selector: 'app-shop',
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css']
})
export class ShopComponent implements OnInit {

<<<<<<< HEAD
  constructor() { }
=======
  constructor(public translate: TranslateService) { }
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  ngOnInit(): void {
  }

}
