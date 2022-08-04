import { Component, OnInit } from '@angular/core';
import  category  from '../../../../assets/category.json';
import { Category } from '../../../interfaces/category';

@Component({
  selector: 'app-category-list',
  templateUrl: './category-list.component.html',
  styleUrls: ['./category-list.component.css']
})
export class CategoryListComponent implements OnInit {

  categories : Array<Category> = category;

  constructor() { }

  ngOnInit(): void {
  }

}
