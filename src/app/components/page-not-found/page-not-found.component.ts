import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
<<<<<<< HEAD

=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

@Component({
  selector: 'app-page-not-found',
  templateUrl: './page-not-found.component.html',
  styleUrls: ['./page-not-found.component.css']
})
export class PageNotFoundComponent implements OnInit {

<<<<<<< HEAD
  constructor(private router:Router) { }
=======
  constructor(private router:Router,
    public translate: TranslateService) { }
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  ngOnInit(): void {
  }

    backToHome(){
    this.router.navigate(['/']);
  }

}
