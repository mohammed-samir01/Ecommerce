import { Component, OnInit, Input } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-details',
  templateUrl: './details.component.html',
  styleUrls: ['./details.component.css']
})
export class DetailsComponent implements OnInit {


  @Input() data: any = [];

  @Input() images: any = [];

  @Input() currentRate: number = 0;

  @Input() DefaultImage: string = "";

  quentity: number = 1;

  i = 1;



  constructor(
    public translate: TranslateService) {

  }

  ngOnInit(): void {

  }

  plus() {
    if (this.i != 100) {
      this.i++;
      this.quentity = this.i;
    }
  }

  minus() {
    if (this.i != 0) {
      this.i--;
      this.quentity = this.i;
    }
  }

  imageClick(img: any) {
    this.DefaultImage = img;
  }



}
