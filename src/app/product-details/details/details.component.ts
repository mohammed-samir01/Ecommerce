import { ProductDetailsService } from './../services/product-details.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
<<<<<<< HEAD

=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@Component({
  selector: 'app-details',
  templateUrl: './details.component.html',
  styleUrls: ['./details.component.css']
})
export class DetailsComponent implements OnInit {

  id!:any

  data : any ={}
<<<<<<< HEAD
  constructor(private route:ActivatedRoute, private service:ProductDetailsService) { 
=======
  constructor(private route:ActivatedRoute, 
    private service:ProductDetailsService,
    public translate: TranslateService) { 
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
    
    this.id = this.route.snapshot.paramMap.get("id");
  }

  ngOnInit(): void {
    this.getProduct();
  }

  // images : any =[
  //   {"img": "../../../../assets/images/product-detail-1.jpg"},
  //   {"img": "../../../../assets/images/product-detail-2.jpg"},
  //   {"img": "../../../../assets/images/product-detail-3.jpg"},
  //   {"img": "../../../../assets/images/product-detail-4.jpg"},
  // ]

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
  
  getProduct(){
    this.service.getProductsByID(this.id).subscribe((res:any)=>{
      this.data = res;
    })
  }

}
