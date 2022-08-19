import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import  Pusher  from 'pusher-js';

@Component({
  selector: 'app-live-chat',
  templateUrl: './live-chat.component.html',
  styleUrls: ['./live-chat.component.scss']
})
export class LiveChatComponent implements OnInit {
  chatInputMessage: string = "";

  serviceCustomers = {
    name: 'Muhammad',
    id: 1,
    profileImageUrl: '../../../../assets/chat&goToTop/profileChat2.png'
  }
  currentUser = {
    name: 'Marina',
    id: 2,
    profileImageUrl: '../../../../assets/chat&goToTop/profileChat1.png'
  }

  chatMessages : {
    user: any,
    message: string,
    created_at: number
  } [] = [
    {
      user: this.serviceCustomers,
      message: "Hello, how can i help you?",
      created_at: Date.now()
    },
    {
      user: this.currentUser,
      message: "Hello, i have a problem with order ...",
      created_at: Date.now()
    }
  ];

  send(): void {
    this.chatMessages.push({
      message: this.chatInputMessage,
      user: this.currentUser,
      created_at: Date.now()
    });
    this.chatInputMessage = "";
  }

  constructor(public translate: TranslateService,
    private http: HttpClient) { }

  ngOnInit(): void {
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    const pusher = new Pusher('ae3729af8928e35a5d8f', {
    cluster: 'eu'
  });

    const channel = pusher.subscribe('iti-chat');
    channel.bind('chatInputMessage', data => {
    this.chatMessages.push(data);
  });
}

  submit(): void {
    this.http.post<any>('http://127.0.0.1:8000/api/chat', {
      user: this.currentUser,
      message: this.chatInputMessage,
      created_at: Date.now()
    }).subscribe(next => {this.chatInputMessage = ''});
  }

}