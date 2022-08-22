import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-live-chat',
  templateUrl: './live-chat.component.html',
  styleUrls: ['./live-chat.component.scss']
})
export class LiveChatComponent implements OnInit {
  chatInputMessage: string = "";

  serviceCustomers = {
    name: 'Marina',
    id: 2,
    profileImageUrl: '../../../../assets/chat&goToTop/profileChat1.png'
  }
  currentUser = {
    name: 'Muhammad',
    id: 1,
    profileImageUrl: '../../../../assets/chat&goToTop/profileChat2.png'
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

  send() {
    this.chatMessages.push({
      message: this.chatInputMessage,
      user: this.currentUser,
      created_at: Date.now()
    });
    this.chatInputMessage = "";
  }

  constructor() { }

  ngOnInit(): void {
  }

}
