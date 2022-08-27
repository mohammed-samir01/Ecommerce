import { Component, OnInit, Input } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-desc-review',
  templateUrl: './desc-review.component.html',
  styleUrls: ['./desc-review.component.css'],
})
export class DescReviewComponent implements OnInit {
  @Input() data: any = [];

  @Input() Reviews: any = [];

  @Input() ReviewsLength: number = 0;

  constructor(public translate: TranslateService) {}

  ngOnInit(): void {}
}
