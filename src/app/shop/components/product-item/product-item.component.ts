
import { Component,  EventEmitter,  Input, OnInit, Output  } from '@angular/core';

@Component({
  selector: 'app-product-item',
  templateUrl: './product-item.component.html',
  styleUrls: ['./product-item.component.css']
})
export class ProductItemComponent implements OnInit {
  @Output() item = new EventEmitter()
  @Input() Product : any =[];
  addBoolean:boolean=false
  amount:number =0
  constructor() { }

  ngOnInit(): void {
  }
add(){

  this.item.emit({item:this.Product , quantity:this.amount});

}
addCart(){
 this.item.emit({item:this.Product});
//  console.log(this.Product);
}

}
