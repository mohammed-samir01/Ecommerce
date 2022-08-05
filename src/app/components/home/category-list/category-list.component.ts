import { Component, OnInit } from '@angular/core';
import  category  from '../../../../assets/category.json';
import { Category } from '../../../interfaces/category';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-category-list',
  templateUrl: './category-list.component.html',
  styleUrls: ['./category-list.component.css']
})
export class CategoryListComponent implements OnInit {

  categories : Array<Category> = category;

  constructor(public translate: TranslateService) { }

  ngOnInit(): void {
  }

}
