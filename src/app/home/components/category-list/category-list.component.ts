import { Component, OnInit } from '@angular/core';
import { HomeService } from '../../service/home.service';


@Component({
  selector: 'app-category-list',
  templateUrl: './category-list.component.html',
  styleUrls: ['./category-list.component.css']
})
export class CategoryListComponent implements OnInit {

  categories :any[]=[];

  constructor(private homeService :HomeService) { }

  ngOnInit(): void {
    this.getAllCategory();
  }

  getAllCategory(){
    this.homeService.getAllCategory().subscribe((res:any) => {
    this.categories = res['Categories']
    console.log(this.categories);
   
    })
  }

}
