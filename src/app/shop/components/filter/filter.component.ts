
import { Component, OnInit, Input}  from '@angular/core';

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
  constructor() { }

  ngOnInit(): void {
  }

}
