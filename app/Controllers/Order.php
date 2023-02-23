<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\BarangModel;
use App\Models\OrderProductModel;
use App\Controllers\BaseController;

class Order extends BaseController
{
    protected $model, $cart, $curl, $key;

    public function __construct()
    {
        helper('view_helper');
        $this->model = new OrderModel();
        $this->cart = \Config\Services::cart();
        $this->curl = \Config\Services::curlrequest();
        $this->key = '6ad3f8fdab9c0f53358385f14d03db24';
    }

    public function index()
    {
        $user_id = session()->get('user_id');
        $data = $this->model->where('user_id', $user_id)->findAll();

        return blade('orders.index', compact('data'));
    }

    public function checkout()
    {
        $user_id = session()->get('user_id');
        $product_order = new OrderProductModel();
        $try = 0;

        try {
            $this->model->db->transBegin();
            $data = [
                'user_id' => (int) $user_id,
                'total_jumlah' => (int) $this->request->getPost('total_jumlah'),
                'total_harga' => (int) $this->request->getPost('total_harga'),
                'total_berat' => (int) $this->request->getPost('total_berat'),
                'tgl_pesan' => date('Y-m-d H:i:s'),
                'batas_bayar' => date('Y-m-d H:i:s', strtotime('+3 day'))
            ];
            // dd($data);

            $model = $this->model->save($data);
            $model = $this->model->db->query('SELECT LAST_INSERT_ID()');
            $model = json_decode(json_encode($model->getResult()), true);
            $model = $model[0]['LAST_INSERT_ID()'];
            // $try = $model;
            // dd($try);
            // dd();
    
            foreach($this->cart->contents() as $cart) {
                $product_order->insert([
                    'order_id' => $model,
                    'barang_id' => $cart['id'],
                    'nama_barang' => $cart['name'],
                    'jumlah' => $cart['qty'],
                    'total_berat' => $cart['options']['berat'],
                    'harga' => $cart['price'],
                ]);
            }
            $this->cart->destroy();
            $this->model->db->transCommit();
            session()->setFlashdata('success', 'Sukses tambah data');
                
            return redirect('order');
        } catch (\Exception $e) {
            $this->model->db->transRollback();
            exit($e->getMessage());
        }
    }

    public function confirm_checkout($id)
    {
        $user = new UserModel();
        $order_barang = new OrderProductModel();
        $barang = new BarangModel();
        $data = $this->model->find($id);

        $order_barang = $order_barang->where('order_id', $data['id'])->first();
        $barang_id = $order_barang['barang_id'];

        $barang = $barang->find($barang_id);
        $barang = $barang['kota_barang'];

        $user = $user->find($data['user_id']);
        $allProvinsi = $this->curl->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'Accept' => 'application/json',
                'key' => $this->key
            ]
        ]);
        $allProvinsi = json_decode($allProvinsi->getBody(), true);
        $allProvinsi = $allProvinsi['rajaongkir']['results'];

        return blade('orders.confirm', compact('data', 'allProvinsi', 'user', 'barang'));
    }

    public function action()
    {
        $allKota = $this->curl->request('GET', 'https://api.rajaongkir.com/starter/city?province='. $this->request->getVar('province_id'), [
            'headers' => [
                'Accept' => 'application/json',
                'key' => $this->key
            ]
        ]);
        $allKota = json_decode($allKota->getBody(), true);
        // dd($allKota);
        $allKota = $allKota['rajaongkir']['results'];
        $allKota = json_encode($allKota);

        echo $allKota;
    }

    public function getCourierServices()
    {
        $services = $this->curl->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'Accept' => 'application/json',
                'key' => $this->key
            ],
            'form_params' => [
                'origin' => $this->request->getPost('origin'),
                'destination' => $this->request->getPost('destination'),
                'weight' => $this->request->getPost('weight'),
                'courier' => $this->request->getPost('courier')
            ],
        ]);

        $services = json_decode($services->getBody(), true);
        // dd($services);
        $services = $services['rajaongkir']['results'];
        $services = json_encode($services);
        // dd($services);

        echo $services;
    }

    public function confirm($id)
    {
        $validation = Services::validation();
        $validation->setRules([
            'provinsi' => ['label' => 'provinsi', 'rules' => 'required'],
            'kota' => ['label' => 'kota', 'rules' => 'required'],
            'kurir' => ['label' => 'kurir', 'rules' => 'required'],
            'total_harga' => ['label' => 'total_harga', 'rules' => 'required'],
            'metode_pembayaran' => ['label' => 'metode_pembayaran', 'rules' => 'required'],
            'alamat' => ['label' => 'alamat', 'rules' => 'required'],
        ]);

        $data = [
            'provinsi' => (int) $this->request->getPost('provinsi'),
            'kota' => (int) $this->request->getPost('kota'),
            'kurir' => $this->request->getPost('kurir'),
            'total_harga' => (int) $this->request->getPost('total_harga'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'alamat' => $this->request->getPost('alamat'),
            'status' => 'dikonfirmasi'
        ];

        $isValid = $validation->withRequest($this->request)->run();
        
        if (!$isValid) {
            $err_msg = $validation->getErrors();
            // dd($err_msg);

            return redirect()->back()->withInput()->with('error', $validation->getErrors());
            // return blade('mahasiswa.new', compact('err_msg'));
        } else {
            $this->model->update($id, $data);
            session()->setFlashdata('success', 'Data Pemesanan berhasil dikonfirmasi');
            
            return redirect('order');
        }
    }
}
