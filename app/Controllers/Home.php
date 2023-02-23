<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Home extends BaseController
{
    protected $model;
    protected $curl;

    public function __construct()
    {
        helper('view_helper');
        $this->model = new BarangModel();
        $this->curl = \Config\Services::curlrequest();
    }

    public function index()
    {
        $search = $this->request->getVar('search');

        if ($search == '') {
            $data = $this->model->select('*')->paginate(12);
        } else {
            $data = $this->model->select('*')
                        ->orLike('nama', $search)
                        ->orLike('deskripsi', $search)
                        ->paginate(12);
        }

        return blade('barang.home', compact('data'));
    }

    public function detail($id)
    {
        $data = $this->model->find($id);
        $provinsi = $data['provinsi_brg'];
        $kota = $data['kota_barang'];
        $kota = $this->curl->request('GET', 'https://api.rajaongkir.com/starter/city?id='. $kota .'&province='. $provinsi, [
            'headers' => [
                'Accept' => 'application/json',
                'key' => '6ad3f8fdab9c0f53358385f14d03db24'
            ]
        ]);

        $kota = json_decode($kota->getBody(), true);
        $kota = $kota['rajaongkir']['results']['city_name'];
        
        return blade('barang.detail', compact('data', 'kota'));
    }
}
