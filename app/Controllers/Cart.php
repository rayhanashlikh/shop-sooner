<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Cart extends BaseController
{
    protected $cart;

    public function __construct()
    {
        helper('view_helper');
        $this->cart = \Config\Services::cart();
    }

    public function cek()
    {
        $cart = $this->cart->contents();

        echo "<pre>";
        print_r($cart);
        echo "<pre>";
    }

    public function add()
    {
        // dd($this->cart);
        $this->cart->insert([
            'id' => $this->request->getPost('id'),
            'qty' => 1,
            'price' => $this->request->getPost('price'),
            'name' => $this->request->getPost('name'),
            'options' => [
                'gambar' => $this->request->getPost('gambar'),
                'berat' => $this->request->getPost('berat'),
            ]
        ]);
        session()->setFlashdata('msg', 'Barang berhasil dimasukkan ke keranjang !!');

        return redirect()->to(base_url('/'));
    }

    public function clear()
    {
        $this->cart->destroy();
    }

    public function getCart()
    {
        $data = ['cart' => $this->cart];

        return blade('cart.index', compact('data'));
    }

    public function update()
    {
        $this->cart->update([
            'rowid'   => $this->request->getPost('rowid'),
            'qty'     => $this->request->getPost('qty'),
        ]);
    }

    public function delete()
    {
        $this->cart->remove($this->request->getPost('rowid'));
    }
}
