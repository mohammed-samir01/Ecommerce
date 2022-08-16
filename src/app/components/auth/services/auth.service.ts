import { Injectable } from '@angular/core';
import {HttpClient, HttpRequest, HttpEventType, HttpHeaders, HttpParams, HttpEvent, HttpErrorResponse, HttpResponse,} from '@angular/common/http';
import { Verify } from './../../../models/verify';
import { Login } from './../../../models/login';
import { User } from './../../../models/user';
import { Password } from 'src/app/models/password';


@Injectable({
  providedIn: 'root',
})
export class AuthService {
  constructor(private httpClient: HttpClient) {}

  getToken() {
    return localStorage.getItem('token');
  }

  // loginAuth(user: User) {
  //   return this.httpClient.post('http://127.0.0.1:8000/api/login', user);
  // }

  loginAuth(log: Login) {
    return this.httpClient.post('http://127.0.0.1:8000/api/login', log);
  }

  registerAuth(user: User) {
    return this.httpClient.post('http://127.0.0.1:8000/api/register', user);
  }

  verifyUser(verify: Verify) {
    return this.httpClient.post(
      'http://127.0.0.1:8000/api/verifyAccount',
      verify
    );
  }

  loginOut() {
    return this.httpClient.get('http://127.0.0.1:8000/api/logout');
  }

  forgetPassword(email: Login) {
    return this.httpClient.post(
      'http://127.0.0.1:8000/api/forgetPassword',
      email
    );
  }

 newPassword(password: any , email  : any) {
  
  let params = new HttpParams()
    .set('password', password)
    .set('confirmation_password', password)
    .set('email', email);
    return this.httpClient.put('http://127.0.0.1:8000/api/updatePassword', {
      params,
    });
  }

  isLoggedIn() {
    let token = localStorage.getItem('token');
    if (token) {
      return true;
    } else {
      return false;
    }
  }
}


