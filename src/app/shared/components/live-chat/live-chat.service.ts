import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class LiveChatService {
  constructor(private httpClient: HttpClient) {}

  sendMessage(content) {
    return this.httpClient.post(
      'http://127.0.0.1:8000/api/sendmessage',
      content
    );
  }

  playmessage() {
    return this.httpClient.get('http://127.0.0.1:8000/api/playmessage');
  }

  state(num: any) {
    return this.httpClient.post('http://127.0.0.1:8000/api/state', num);
  }

  createChat(id) {
    return this.httpClient.post('http://127.0.0.1:8000/api/createchat', id);
  }

  typing(typing) {
    return this.httpClient.put(
      'http://127.0.0.1:8000/api/typing' ,
      typing
    );
  }
}
