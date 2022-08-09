<?php

namespace App\Http\Livewire\Frontend;

use App\Models\PaymentMethod;
use App\Models\ProductCoupon;
use App\Models\ShippingCompany;
use App\Models\UserAddress;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $cart_subtotal;
    public $cart_tax;
    public $cart_total;
    public $cart_coupon;
    public $cart_shipping;
    public $cart_discount;
    public $coupon_code;
    public $addresses;
    public $customer_address_id = 0;
    public $shipping_companies;
    public $shipping_company_id = 0;
    public $payment_methods;
    public $payment_method_id = 0;
    public $payment_method_code;

    protected $listeners = [
        'updateCart' => 'mount'
    ];

    public function mount()
    {
        $this->customer_address_id = session()->has('saved_customer_address_id') ? session()->get('saved_customer_address_id') : '';
        $this->shipping_company_id = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';

        $this->addresses = auth()->user()->addresses;

        $this->cart_subtotal = getNumbers()->get('subtotal');
        $this->cart_tax = getNumbers()->get('productTaxes');
        $this->cart_discount = getNumbers()->get('discount');
        $this->cart_shipping = getNumbers()->get('shipping');
        $this->cart_total = getNumbers()->get('total');
        if ($this->customer_address_id == '') {
            $this->shipping_companies = collect([]);
        } else {
            $this->updateShippingCompanies();
        }
        $this->payment_methods = PaymentMethod::whereStatus(true)->get();
    }

    public function applyDiscount()
    {
        if (getNumbers()->get('subtotal') > 0) {
            $coupon = ProductCoupon::whereCode($this->coupon_code)->first();
            if(!$coupon) {
                $this->cart_coupon = '';
                $this->alert('error', 'Coupon is invalid!');
            } else {
                $couponValue = $coupon->discount($this->cart_subtotal);
                if ($couponValue > 0) {
                    session()->put('coupon', [
                        'code' => $coupon->code,
                        'value' => $coupon->value,
                        'discount' => $couponValue,
                    ]);
                    $this->coupon_code = session()->get('coupon')['code'];
                    $this->emit('updateCart');

                    $this->alert('success', 'coupon is applied successfully');
                } else {
                    $this->alert('error', 'product coupon is invalid');
                }

            }

        } else {
            $this->cart_coupon = '';
            $this->alert('error', 'No products available in your cart');
        }
    }

    public function removeCoupon()
    {
        session()->remove('coupon');
        $this->coupon_code = '';
        $this->emit('updateCart');
        $this->alert('success', 'Coupon is removed');
    }

    public function updateShippingCompanies()
    {
        $addressCounty = UserAddress::whereId($this->customer_address_id)->first();
        $this->shipping_companies = ShippingCompany::whereHas('countries', function ($query) use ($addressCounty) {
            $query->where('country_id', $addressCounty->country_id);
        })->get();
    }

    public function updatingCustomerAddressId()
    {
        session()->forget('saved_customer_address_id');
        session()->forget('saved_shipping_company_id');
        session()->forget('shipping');
        session()->put('saved_customer_address_id', $this->customer_address_id);

        $this->customer_address_id = session()->has('saved_customer_address_id') ? session()->get('saved_customer_address_id') : '';
        $this->shipping_company_id = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
        $this->emit('updateCart');
    }

    public function updatedCustomerAddressId()
    {
        session()->forget('saved_customer_address_id');
        session()->forget('saved_shipping_company_id');
        session()->forget('shipping');
        session()->put('saved_customer_address_id', $this->customer_address_id);

        $this->customer_address_id = session()->has('saved_customer_address_id') ? session()->get('saved_customer_address_id') : '';
        $this->shipping_company_id = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
        $this->emit('updateCart');
    }

    public function updatingShippingCompanyId()
    {
        session()->forget('saved_shipping_company_id');
        session()->put('saved_shipping_company_id', $this->customer_address_id);

        $this->customer_address_id = session()->has('saved_customer_address_id') ? session()->get('saved_customer_address_id') : '';
        $this->shipping_company_id = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
        $this->emit('updateCart');
    }

    public function updatedShippingCompanyId()
    {
        session()->forget('saved_shipping_company_id');
        session()->put('saved_shipping_company_id', $this->shipping_company_id);

        $this->customer_address_id = session()->has('saved_customer_address_id') ? session()->get('saved_customer_address_id') : '';
        $this->shipping_company_id = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
        $this->emit('updateCart');
    }

    public function updateShippingCost()
    {
        $selectedShippingCompany = ShippingCompany::whereId($this->shipping_company_id)->first();
        session()->put('shipping', [
            'code' => $selectedShippingCompany->code,
            'cost' => $selectedShippingCompany->cost,
        ]);
        $this->emit('updateCart');
        $this->alert('success', 'Shipping cost is applied successfully');
    }

    public function updatePaymentMethod()
    {
        $payment_method = PaymentMethod::whereId($this->payment_method_id)->first();
        $this->payment_method_code = $payment_method->code;
    }

    public function render()
    {
        return view('livewire.frontend.checkout-component');
    }
}
