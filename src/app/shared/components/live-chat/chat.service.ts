import { Injectable } from '@angular/core';
import {HttpClient, HttpRequest, HttpEventType, HttpHeaders, HttpParams, HttpEvent, HttpErrorResponse, HttpResponse,} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ChatService {

  constructor (private httpClient: HttpClient) { }

  getToken() {
    return localStorage.getItem('token');
  }
}
