<?php

namespace App\Http\Livewire\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartItemComponent extends Component
{
    public $item;
    public $item_quantity = 1;

    public function mount()
    {
        $this->item_quantity = Cart::instance('default')->get($this->item)->qty ?? 1;
    }

    public function decreaseQuantity($rowId)
    {
        if ($this->item_quantity > 1) {
            $this->item_quantity = $this->item_quantity-1;
            Cart::instance('default')->update($rowId, $this->item_quantity);
            $this->emit('updateCart');
        }
    }

    public function increaseQuantity($rowId)
    {
        if ($this->item_quantity > 0) {
            $this->item_quantity = $this->item_quantity+1;
            Cart::instance('default')->update($rowId, $this->item_quantity);
            $this->emit('updateCart');
        }
    }

    public function removeFromCart($rowId)
    {
        $this->emit('removeFromCart', $rowId);
    }

    public function render()
    {
        return view('livewire.frontend.cart-item-component', [
            'cartItem' => Cart::instance('default')->get($this->item)
        ]);
    }
}
