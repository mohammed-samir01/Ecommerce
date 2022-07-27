import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-details',
  templateUrl: './details.component.html',
  styleUrls: ['./details.component.css']
})
export class DetailsComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }

  images : any =[
    {"img": "../../../../assets/images/product-detail-1.jpg"},
    {"img": "../../../../assets/images/product-detail-2.jpg"},
    {"img": "../../../../assets/images/product-detail-3.jpg"},
    {"img": "../../../../assets/images/product-detail-4.jpg"},
  ]

  quentity : number = 1;

  i=1;

  plus(){
    if(this.i !=100){
      this.i++;
      this.quentity=this.i;
    }
}

  minus(){
    if(this.i !=0){
      this.i--;
      this.quentity=this.i;
    }
}
  
}
