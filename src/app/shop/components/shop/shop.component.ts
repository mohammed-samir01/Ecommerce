import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ShopService } from '../../services/shop.service';

@Component({
  selector: 'app-shop',
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css'],
})
export class ShopComponent implements OnInit {
  Categories: any = [];

  constructor(
    private service: ShopService,
    public translate: TranslateService
  ) {}

  ngOnInit(): void {
    // this.getAllCategories();
    this.getSubCategories();
  }

  // getAllCategories() {
  //   this.service.getAllCategories().subscribe((res: any) => {
  //     this.Categories = res['Categories'];
  //   });
  // }

  getSubCategories() {
    this.service.getSubCategories().subscribe((res: any) => {
      this.Categories = res;
    });
  }
}
