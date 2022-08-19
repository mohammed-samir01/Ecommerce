export class UpdateProfile {
  private username: any;
  private first_name: any;
  private last_name: any;
  private email: any;
  private mobile: any;
  private password: any;
  private confirmation_password: any;
  private user_image: any;

  constructor(
    username: any,
    first_name: any,
    last_name: any,
    email: any,
    mobile: any,
    password?: any,
    confirmation_password?: any,
    user_image?: any
  ) {
    this.username = username;
    this.first_name = first_name;
    this.last_name = last_name;
    this.email = email;
    this.mobile = mobile;
    this.password = password;
    this.confirmation_password = confirmation_password;
    this.user_image = user_image;

  }
}
