import { Component, OnInit } from '@angular/core';
import { ValidationErrors } from '@angular/forms';
import { FormBuilder, FormGroup, Validators,FormControl, ValidatorFn, AbstractControl } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  signForm:any =  FormGroup;
  submitted = false;


  checkPasswords= (group: FormGroup):  ValidationErrors | null => {
    let pass = group.get('password')?.value;
    let confirmPass = group.get('confirmPassword')?.value
    return pass === confirmPass ? null : { notSame: true }
  }


  constructor(private formBuilder: FormBuilder) {

  }


  ngOnInit(): void {

    this.signForm = this.formBuilder.group({
    fullName: ['', Validators.required, Validators.minLength(3), Validators.maxLength(32), Validators.pattern('[a-zA-Z]*')],
    email: ['', [Validators.required, Validators.email, Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')]],
    password: ['', [Validators.required,Validators.minLength(8),
                    Validators.maxLength(64),Validators.pattern('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$')]],
    confirmPassword: ['']
    },{validator: this.checkPasswords})
  }

      get f() { return this.signForm.controls; }
  onSubmit() {
    
    this.submitted = true;
    // stop here if form is invalid
    if (this.signForm.invalid) {
        return;
    }
    //True if all the fields are filled
    if(this.submitted)
    {
      alert("Great!!");
    }
  
  }

}
