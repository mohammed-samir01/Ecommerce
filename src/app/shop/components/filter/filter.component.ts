import { Component, OnInit, Input}  from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-filter',
  templateUrl: './filter.component.html',
  styleUrls: ['./filter.component.css'],
})
export class FilterComponent implements OnInit {
  @Input() Meta: any = [];

  // @Input() count :number = 0
  // @Input() to :number =0
  // @Input() perPge :number =0
  // @Input() page : any = 0;
  // @Input() tableSize : any = 0;
  // @Input() pagesNumber: number = 0;

  constructor(public translate: TranslateService) {}

  ngOnInit(): void {
    // throw new Error('Method not implemented.');
  }
}
