import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-desc-review',
  templateUrl: './desc-review.component.html',
  styleUrls: ['./desc-review.component.css']
})
export class DescReviewComponent implements OnInit {

  constructor(public translate: TranslateService) { }

  ngOnInit(): void {
  }

}
