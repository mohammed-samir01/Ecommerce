import { Component, OnInit ,Input, Output, EventEmitter } from '@angular/core';
// import { Options , LabelType } from 'ng5-slider';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute } from '@angular/router';
import { ShopService } from '../../services/shop.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-aside',
  templateUrl: './aside.component.html',
  styleUrls: ['./aside.component.css'],
})
export class AsideComponent implements OnInit {
  @Input() Categories: any = [];

  @Input() Tags: any = [];

  @Output() getAllProducts = new EventEmitter();

  @Output() ProductByCategory = new EventEmitter();

  @Output() ProductByTags = new EventEmitter();

  constructor(
    private route: ActivatedRoute,
    private shopservice: ShopService,
    public translate: TranslateService,
    public router: Router
  ) {}

  ngOnInit(): void {
    console.log(this.Categories);
    console.log(this.Tags);
  }

  allProducts() {
    this.getAllProducts.emit();
  }

  filterDataByCate(event: any) {
    this.ProductByCategory.emit(event);
  }

  filterDataByTags(event: any) {
    this.ProductByTags.emit(event);
  }

  // minValue: number = 1000;
  // maxValue: number = 4000;

  // options: Options = {
  //   floor: 0,
  //   ceil: 5000,
  //   translate: (value: number, label: LabelType): string => {
  //     switch (label) {
  //       case LabelType.Low:
  //         return '$' + value;
  //       case LabelType.High:
  //         return '$' + value;
  //       default:
  //         return '$' + value;
  //     }
  //   },
  // };

  // filters: Array<string> = [
  //   'Returns Accepted',
  //   'Returns Accepted',
  //   'Completed Items',
  //   'Sold Items',
  //   'Deals &amp; Savings',
  //   'Authorized Seller',
  // ];
  // formats: Array<string> = [
  //   'All Listings',
  //   'Best Offer',
  //   'Auction',
  //   'Buy It Now',
  // ];
}



