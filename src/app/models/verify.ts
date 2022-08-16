export class Verify {
  private email: any;

  private verification_code: any;

  constructor(email: any, verification_code: any) {
    this.email = email;
    this.verification_code = verification_code;
  }
}
