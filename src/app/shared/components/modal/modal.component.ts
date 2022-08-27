import { Component, OnInit , Input} from '@angular/core';
import { HomeService } from 'src/app/home/service/home.service';

@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.css'],
})
export class ModalComponent implements OnInit {
  @Input() singleProduct: any = [];
  

  constructor(private homeService: HomeService) {}

  ngOnInit(): void {}

  quentity: number = 1;
  i = 1;

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

  modal: boolean = false;

  openModal() {
    this.modal = !this.modal;
  }
  close() {
    this.modal = !this.modal;
  }
}
