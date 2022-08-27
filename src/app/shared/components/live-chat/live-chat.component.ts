import { LiveChatService } from './live-chat.service';
import { HttpClient } from '@angular/common/http';
import { Component, OnInit, ViewChild } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import {
  FormControl,
  FormGroup,
  Validators,
  FormBuilder,
} from '@angular/forms';
// import  Pusher  from 'pusher-js';

@Component({
  selector: 'app-live-chat',
  templateUrl: './live-chat.component.html',
  styleUrls: ['./live-chat.component.scss'],
})
export class LiveChatComponent {
  chatForm: any = FormGroup;
  submitted = false;
  typingState = 0

  serviceCustomers = {
    name: 'Muhammad',
    id: 1,
    profileImageUrl: '../../../../assets/chat&goToTop/profileChat2.png',
  };
  currentUser = {
    name: 'Marina',
    id: 2,
    profileImageUrl: '../../../../assets/chat&goToTop/profileChat1.png',
  };

  chatMessages: {
    user: any;
    message: string;
    created_at: number;
  }[] = [
    {
      user: this.serviceCustomers,
      message: 'Hello, how can i help you?',
      created_at: Date.now(),
    },
    {
      user: this.currentUser,
      message: 'Hello, i have a problem with order ...',
      created_at: Date.now(),
    },
  ];

  // @ViewChild('scrollMe') scrollMe:any;
  // items : Array<srting> =[];

  messages: any = [];
  result: any;
  constructor(
    public translate: TranslateService,
    // private http: HttpClient,
    public liveChatService: LiveChatService,
    public formBuilder: FormBuilder
  ) {}

  ngOnInit(): void {
    this.playmessage();

    setInterval(() => {
      this.playmessage();
    }, 10000);

    this.chatForm = this.formBuilder.group({
      content: ['', [Validators.required]],
    });
  }

  get f() {
    return this.chatForm.controls;
  }

  onSubmit() {
    this.submitted = true;
    if (this.chatForm.invalid) {
      return;
    }

    let data = this.chatForm.value;

    this.liveChatService.sendMessage(data).subscribe((res) => {
      this.result = res;
      this.playmessage();
      console.log(res);
    });

    this.chatForm.reset();
    // var element = document.getElementById('toscroll');
    // element.scrollTop = Element.scrollHeight;
  }

  // ngOnInit(): void {
  //   /* setInterval(()=>{
  //     this.playmessage();
  //   },1000); */
  //   // Enable pusher logging - don't include this in production
  //   //   Pusher.logToConsole = true;
  //   //    const pusher = new Pusher('ae3729af8928e35a5d8f', {
  //   //   cluster: 'eu'
  //   // });
  //   //   const channel = pusher.subscribe('iti-chat');
  //   //   channel.bind('chatInputMessage', data => {
  //   //   this.chatMessages.push(data);
  //   // });
  // }

  state(event) {
    let state = event.target.value;
    this.liveChatService.state(state).subscribe((res) => {
      console.log(res);
    });
  }

  playmessage() {
    this.liveChatService.playmessage().subscribe((res) => {
      this.result = res;
      this.messages = this.result.data.data;
      console.log(this.messages);
    });
  }

  typing() {
    this.typingState = 1;
    this.liveChatService.typing(this.typingState).subscribe((res) => {
      console.log(res);
      console.log(this.typingState);
    });
  }

  notTyping(){
    this.typingState = 0;
    this.liveChatService.typing(this.typingState).subscribe((res) => {
      console.log(res);
      console.log(this.typingState);
    });
  }
}
