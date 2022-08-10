import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-live-chat',
  templateUrl: './live-chat.component.html',
  styleUrls: ['./live-chat.component.scss']
})
export class LiveChatComponent implements OnInit {
  chatInputMessage: string = "";

  currentUser = {
    name: 'Muhammad',
    id: 1,
    profileImageUrl: '../../../../assets/chat/profileChat2.png'
  }
  user1 = {
    name: 'Fatema',
    id: 2,
    profileImageUrl: '../../../../assets/chat/profileChat1.png'
  }

  chatMessages : {
    user: any,
    message: string,
    created_at: number
  } [] = [
    {
      user: this.currentUser,
      message: "hello, how are you?",
      created_at: Date.now()
    },
    {
      user: this.user1,
      message: "iam fine thank you.",
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