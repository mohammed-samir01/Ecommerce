import { Component, OnInit } from '@angular/core';
import { ShopService } from '../../services/shop.service';
import { TranslateService } from '@ngx-translate/core';


@Component({
  selector: 'app-all-products',
  templateUrl: './all-products.component.html',
  styleUrls: ['./all-products.component.css']
})
export class AllProductsComponent implements OnInit {

  Products : any[] = []; 
  Categories : any[]=[];

  page: number = 1;
  count: number = 0;
  tableSize: number = 12;
  tableSizes: any = [3, 6, 9, 12];
  pagesNumber: number = 1;

  constructor(private service:ShopService,
    public translate: TranslateService) {
  }

  ngOnInit(): void {
    this.getProducts();
    this.getAllCate();
  }


  getProducts(){
    this.service.getAllProducts().subscribe((res:any) => {
    this.Products= res;
    this.count = (this.Products).length;
    })
  }

  getAllCate(){
    this.service.getAllCate().subscribe((res:any) => {
    this.Categories= res;
    })
  }

  filter(event:any){
    let value = event.target.value;
    console.log(value);
    this.getProductsByCate(value)
  }

    getProductsByCate(keyword:string){
    this.service.getProductsByCate(keyword).subscribe((res:any) => {
    this.Products= res;
    })

  }



  onTableDataChange(event: any) {
    this.page = event;
    this.getAllCate();
  }
  onTableSizeChange(event: any): void {
    this.tableSize = event.target.value;
    this.page = 1;
    this.getAllCate();
  }
}
