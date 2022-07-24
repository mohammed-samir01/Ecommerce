import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { HomeComponent } from './components/home/home.component';
import { PageNotFoundComponent } from './shared/page-not-found/page-not-found.component';

const routes: Routes = [
  {
    path : 'home',
    component : HomeComponent
  },

  // {
  //   path : '',
  //   redirectTo : 'home',
  //   pathMatch : 'full'
  // },
{ path: 'page-not-found', component: PageNotFoundComponent },
  { 
    path: '**', 
    pathMatch: 'full', 
    component: PageNotFoundComponent 
  },


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
