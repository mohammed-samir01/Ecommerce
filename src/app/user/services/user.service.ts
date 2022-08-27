import { Address } from './../../models/address';
import { UpdateProfile } from './../../models/profile';
import { Injectable } from '@angular/core';
import {HttpClient,HttpRequest,HttpEventType,HttpHeaders,HttpParams,HttpEvent,HttpErrorResponse,HttpResponse,} from '@angular/common/http';


@Injectable({
  providedIn: 'root',
})
export class UserService {
  constructor(private httpClient: HttpClient) {}

  //////////////////////////profile//////////////////////////////////

  getUserData() {
    return this.httpClient.get('http://127.0.0.1:8000/api/user-profile');
  }

  updateUserData(updateProfile : UpdateProfile) {
    return this.httpClient.post(
      'http://127.0.0.1:8000/api/update_profile',
      updateProfile
    );
  }

  deleteUserImage(id){
    // let params = new HttpHeaders().set('updateProfile', updateProfile); ;
    return this.httpClient.delete(
      'http://127.0.0.1:8000/api/delete-user-address/'+id
    );
  }

  // addUserImage(user_image) {
  //   // let params = new HttpHeaders().set('updateProfile', updateProfile); ;
  //   return this.httpClient.post(
  //     'http://127.0.0.1:8000/api/update_image_profile',
  //     user_image
  //   );
  // }

  //////////////////////////address//////////////////////////////////

  addAddress(address: Address) {
    return this.httpClient.post(
      'http://127.0.0.1:8000/api/add-user-address',
      address
    );
  }

  userAddresses() {
    return this.httpClient.get('http://127.0.0.1:8000/api/get-user-addresses');
  }

  removeAddress(id) {
    return this.httpClient.delete(
      'http://127.0.0.1:8000/api/delete-user-address/' + id
    );
  }

  // updateUserAddress(id , address: Address) {
  //   return this.httpClient.post(
  //     'http://127.0.0.1:8000/api/update-user-address/' + id,
  //     address
  //   );
  // }

  // getSingleAddress(id: any) {
  //   return this.httpClient.get(
  //     'http://127.0.0.1:8000/api/get-user-address/' + id
  //   );
  // }

  getCountries() {
    return this.httpClient.get('http://127.0.0.1:8000/api/countries');
  }

  getStates(state: any) {
    return this.httpClient.get('http://127.0.0.1:8000/api/states/' + state);
  }

  getCities(city: any) {
    return this.httpClient.get('http://127.0.0.1:8000/api/cities/' + city);
  }

  deleteAddress(city: any) {
    return this.httpClient.get('http://127.0.0.1:8000/api/cities/' + city);
  }

  //////////////////////////orders//////////////////////////////////

  getAllorders() {
    return this.httpClient.get('http://127.0.0.1:8000/api/get-user-orders');
  }

  getOrder(id: any) {
    return this.httpClient.get(
      'http://127.0.0.1:8000/api/show-user-order/' + id
    );
  }

  deleteOrder(id: any) {
    let params = new HttpParams().set('order_id', id);
    return this.httpClient.delete(
      'http://127.0.0.1:8000/api/delete-user-order?order_id=' + id
    );
  }

  deleteAllOrders() {
    return this.httpClient.delete(
      'http://127.0.0.1:8000/api/delete-user-orders'
    );
  }
}
