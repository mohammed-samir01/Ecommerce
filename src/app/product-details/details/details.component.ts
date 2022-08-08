import { ProductDetailsService } from './../services/product-details.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-details',
  templateUrl: './details.component.html',
  styleUrls: ['./details.component.css']
})
export class DetailsComponent implements OnInit {

  slug!:any

  data : any =[];
  
  images : any =[];


  constructor(private route:ActivatedRoute, 
    private service:ProductDetailsService,
    public translate: TranslateService) { 
    
    this.slug = this.route.snapshot.paramMap.get("slug");
  }

  ngOnInit(): void {
    this.getProduct();
  }


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
    this.service.getSingleProduct(this.slug).subscribe((res:any)=>{
      this.data = res['Product']['Product'];
      this.images = res['Product']['Product']['media'];

    })
  }

}
