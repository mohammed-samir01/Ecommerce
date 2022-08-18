import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-user-page',
  templateUrl: './user-page.component.html',
  styleUrls: ['./user-page.component.css']
})
export class UserPageComponent implements OnInit {
  asideName: string = 'profile';
  Aside: any = ['Profile', 'Addresses', 'Orders', 'Logout'];


  constructor() { }

  ngOnInit(): void { }
  onClick(event: any) {
    this.asideName = event;
    console.log(this.asideName);
  }

}
