import { AuthService } from './auth.service';
import { Injectable } from '@angular/core';
import {
    HttpEvent,
    HttpHandler,
  HttpInterceptor, HttpRequest, HTTP_INTERCEPTORS,
} from '@angular/common/http';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root',
})
export class AuthInterceptor implements HttpInterceptor {
  constructor() {    
}
    token : any = localStorage.getItem('token');

    intercept(req: HttpRequest<any>, next: HttpHandler) {
        let newRequest = req.clone({
            setHeaders : {
                Authorization : `Bearer ${this.token}`
            }
        })
        return next.handle(newRequest);
    }

}

