import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute } from '@angular/router';
import { ProductDetailsService } from './../services/product-details.service';

@Component({
  selector: 'app-related-product-item',
  templateUrl: './related-product-item.component.html',
  styleUrls: ['./related-product-item.component.css'],
})
export class RelatedProductItemComponent implements OnInit {
  @Input() relatedProduct: any = [];

  @Input() index: number = 0;

  @Output() getSingleProductOfRalated = new EventEmitter;

  constructor(
    public translate: TranslateService,
    private route: ActivatedRoute,
    private service: ProductDetailsService
  ) {}

  ngOnInit(): void {}

  getSingleRelated(){
    this.getSingleProductOfRalated.emit()
  }
}
