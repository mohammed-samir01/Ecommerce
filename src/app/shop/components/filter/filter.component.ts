<<<<<<< HEAD

import { Component, OnInit, Input}  from '@angular/core';

=======
import { Component, OnInit, Input}  from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@Component({
  selector: 'app-filter',
  templateUrl: './filter.component.html',
  styleUrls: ['./filter.component.css']
})
export class FilterComponent implements OnInit {


  @Input() numOfProducts : any = 0;
  @Input() page : any = 0;
  @Input() tableSize : any = 0;
  @Input() pagesNumber: number = 0;
<<<<<<< HEAD
  constructor() { }
=======
  constructor(public translate: TranslateService) { }
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  ngOnInit(): void {
  }

}
