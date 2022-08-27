export class EditAddress {
  private address_title: any;
  private default_address: any;
  private first_name: any;
  private last_name: any;
  private email: any;
  private mobile: any;
  private address: any;
  private address2: any;
  private country_id: any;
  private state_id: any;
  private city_id: any;
  private zip_code: any;
    private po_box: any

  constructor(
    address_title: any,
    default_address: any,
    first_name: any,
    last_name: any,
    email: any,
    mobile: any,
    address: any,
    address2: any,
    country_id: any,
    state_id: any,
    city_id: any,
    zip_code:any,
	po_box:any
  ) {
    this.address_title = address_title;
    this.default_address = default_address;
    this.first_name = first_name;
    this.last_name = last_name;
    this.email = email;
    this.mobile = mobile;
    this.address = address;
    this.address2 = address2;
    this.country_id = country_id;
    this.state_id = state_id;
    this.city_id = city_id;
    this.zip_code = zip_code;
    this.po_box =	po_box
  }
}
