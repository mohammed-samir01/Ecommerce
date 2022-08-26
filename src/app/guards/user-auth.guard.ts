import { User } from './../models/user';
import { tap } from 'rxjs/operators';
import { AuthService } from './../components/auth/services/auth.service';
import { Injectable, Pipe } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class UserAuthGuard implements CanActivate {
  constructor(private authService: AuthService,public router:Router) {}

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ):
    | Observable<boolean | UrlTree>
    | Promise<boolean | UrlTree>
    | boolean
    | UrlTree {
    
      if(this.authService.isLoggedIn()){
        return true;
      }
      else{
        this.router.navigateByUrl('/');
        return false;
      }
  }
}
