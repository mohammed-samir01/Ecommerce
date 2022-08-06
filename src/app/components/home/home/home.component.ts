import { Component, OnInit } from '@angular/core';
<<<<<<< HEAD

=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

<<<<<<< HEAD
  constructor() { }
=======
  constructor(public translate: TranslateService) { }
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  ngOnInit(): void {
  }

}
