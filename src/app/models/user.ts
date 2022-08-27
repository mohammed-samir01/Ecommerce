export class User {
  private first_name : any;
  private last_name : any;
  private username : any;
  private email : any;
  private mobile : any;
  private password : any;
  private confirmation_password : any;

  constructor(
    first_name: any,
    last_name: any,
    username: any,
    email: any,
    mobile: any,
    password: any,
    confirmation_password: any
  ) {
    this.first_name = first_name;
    this.last_name = last_name;
    this.username = username;
    this.email = email;
    this.mobile = mobile;
    this.password = password;
    this.confirmation_password = confirmation_password;
  }


}
