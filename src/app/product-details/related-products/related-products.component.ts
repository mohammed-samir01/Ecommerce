import { Component, OnInit, Input } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-related-products',
  templateUrl: './related-products.component.html',
  styleUrls: ['./related-products.component.css'],
})
export class RelatedProductsComponent implements OnInit {
  @Input() RelatedProducts: any = [];

  constructor(public translate: TranslateService) {}

  ngOnInit(): void {}
}
