import { Component, OnInit ,Input, Output, EventEmitter } from '@angular/core';
import { Options , LabelType } from 'ng5-slider';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-aside',
  templateUrl: './aside.component.html',
  styleUrls: ['./aside.component.css'],
})
export class AsideComponent implements OnInit {
  @Input() Categories: any = [];


  filters: Array<string> = [
    'Returns Accepted',
    'Returns Accepted',
    'Completed Items',
    'Sold Items',
    'Deals &amp; Savings',
    'Authorized Seller',
  ];
  formats: Array<string> = [
    'All Listings',
    'Best Offer',
    'Auction',
    'Buy It Now',
  ];

  @Output() seletedValue = new EventEmitter();

  constructor(public translate: TranslateService) {}

  ngOnInit(): void {}

  filterData(event: any) {
    this.seletedValue.emit(event);
  }

  minValue: number = 1000;
  maxValue: number = 4000;
  options: Options = {
    floor: 0,
    ceil: 5000,
    translate: (value: number, label: LabelType): string => {
      switch (label) {
        case LabelType.Low:
          return '$' + value;
        case LabelType.High:
          return '$' + value;
        default:
          return '$' + value;
      }
    },
  };
}
