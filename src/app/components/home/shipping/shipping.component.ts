import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-shipping',
  templateUrl: './shipping.component.html',
  styleUrls: ['./shipping.component.css']
})
export class ShippingComponent implements OnInit {

  constructor(public translate: TranslateService) {
    this.translate.get('Free Shipping').subscribe((data:any)=> {
      console.log(data);
    });
  }

  ngOnInit(): void {}

  services: any[] = 
    [
      {
      "id": 1,
      "title":  "Free Shipping",
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
