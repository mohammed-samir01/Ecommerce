import { Component, OnInit } from '@angular/core';
<<<<<<< HEAD

=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@Component({
  selector: 'app-shipping',
  templateUrl: './shipping.component.html',
  styleUrls: ['./shipping.component.css']
})
export class ShippingComponent implements OnInit {

<<<<<<< HEAD
  constructor() { }

  ngOnInit(): void {
  }

=======
  constructor(public translate: TranslateService) {
    this.translate.get('Free Shipping').subscribe((data:any)=> {
      console.log(data);
    });
  }

  ngOnInit(): void {}

>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
  services: any[] = 
    [
      {
      "id": 1,
<<<<<<< HEAD
      "title": "Free Shipping",
=======
      "title":  "Free Shipping",
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
      "desc": "Free Shipping Worldwide",
      "image": "fa fa-duotone fa-truck-fast",
      },
            {
      "id": 2,
      "title": "24 x 7 service",
      "desc": "Free Shipping Worldwide",
      "image": "fa fa-duotone fa-phone",
      },
            {
      "id": 3,
      "title": "Festival offer",
      "desc": "Free Shipping Worldwide",
      "image": "fa fa-thin fa-tag",
      },
    ]

}
