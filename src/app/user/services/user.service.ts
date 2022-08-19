import { Address } from './../../models/address';
import { UpdateProfile } from './../../models/profile';
import { Injectable } from '@angular/core';
import {HttpClient,HttpRequest,HttpEventType,HttpHeaders,HttpParams,HttpEvent,HttpErrorResponse,HttpResponse,} from '@angular/common/http';


@Injectable({
  providedIn: 'root',
})
export class UserService {
  constructor(private httpClient: HttpClient) {}

  getUserData() {
    return this.httpClient.get('http://127.0.0.1:8000/api/user-profile');
  }

  updateUserData(updateProfile: UpdateProfile) {
    // let params = new HttpHeaders().set('updateProfile', updateProfile); ;
    return this.httpClient.patch(
      'http://127.0.0.1:8000/api/update_profile',
      updateProfile
    );
  }

  deleteUserImage() {
    // let params = new HttpHeaders().set('updateProfile', updateProfile); ;
    return this.httpClient.delete(
      'http://127.0.0.1:8000/api/profile/remove-image'
    );
  }

  addAddress(address :Address) {
    return this.httpClient.post('http://127.0.0.1:8000/api/add-user-address', address);
  }

  userAddresses() {
    return this.httpClient.get('http://127.0.0.1:8000/api/get-user-addresses');
  }

  removeAddress() {
    return this.httpClient.delete(
      'http://127.0.0.1:8000/api/get-user-addresses'
    );
  }
}
