import { Component, OnInit } from '@angular/core';
// import  category  from '../../../../assets/category.json';
// import { Category } from '../../../interfaces/category';
import {HomeService} from '../../service/home.service'

@Component({
  selector: 'app-category-list',
  templateUrl: './category-list.component.html',
  styleUrls: ['./category-list.component.css']
})
export class CategoryListComponent implements OnInit {

  categories :any[]=[];

  constructor(private homeservices :HomeService) { }

  ngOnInit(): void {
    this.getCategory();
  }
  getCategory(){
    this.homeservices.getCategory().subscribe((res:any) => {
    this.categories = res['Categories']
    // console.log(res['Categories']['name']);
    console.log(this.categories)
   
    })
  }

}
