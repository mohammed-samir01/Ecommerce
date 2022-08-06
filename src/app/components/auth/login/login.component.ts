import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators,FormBuilder } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
<<<<<<< HEAD
=======
import { TranslateService } from '@ngx-translate/core';
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  
<<<<<<< HEAD
  constructor(private formBuilder: FormBuilder) {
=======
  constructor(private formBuilder: FormBuilder,
    public translate: TranslateService) {
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

  }
  
  registerForm:any =  FormGroup;
  submitted = false;
  
  ngOnInit(): void {
<<<<<<< HEAD
       this.registerForm = this.formBuilder.group({
    email: ['', [Validators.required, Validators.email]],
    password: ['', [Validators.required,Validators.minLength(8),
         Validators.maxLength(64),]],
=======
      this.registerForm = this.formBuilder.group({
    email: ['', [Validators.required, Validators.email]],
    password: ['', [Validators.required,Validators.minLength(8),
        Validators.maxLength(64),]],
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf

    });
  }

  


    get f() { return this.registerForm.controls; }
  onSubmit() {
    
    this.submitted = true;
    // stop here if form is invalid
    if (this.registerForm.invalid) {
        return;
    }
    //True if all the fields are filled
    if(this.submitted)
    {
      alert("Great!!");
    }
  
  }
}
