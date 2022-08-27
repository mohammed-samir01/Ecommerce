import { Component, OnInit, Input, Output, EventEmitter}  from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-filter',
  templateUrl: './filter.component.html',
  styleUrls: ['./filter.component.css'],
})
export class FilterComponent implements OnInit {
  @Input() Meta: any = [];

  @Output() ProductByFilters = new EventEmitter();

  Filters = [
    'Default Sorting',
    'Popularity',
    'Price from Low to High',
    'Price from High to Low',
  ];

  // FiltersSlug = [
  //   'DefaultSorting',
  //   'Popularity',
  //   'PriceFromLowToHigh',
  //   'PriceFromHighToLow',
  // ];

  constructor(public translate: TranslateService) {}

  ngOnInit(): void {
    // throw new Error('Method not implemented.');
  }

  filterDataByFilter(event: any) {
    this.ProductByFilters.emit(event);
  }
}
