<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use \App\Models\Products;

class Product extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    protected $db;
    protected $help;
    protected $Products;
    protected $format = 'json';
    public function __construct()
    {
        $this->db                       = \Config\Database::connect();
        $this->help                     = helper(['form', 'date']);

        $this->Products                 = new Products();
    }
    public function index()
    {
        $data['products'] = $this->Products->findAll();

        return $this->respond(['status' => 'success',  'data' => $data], 200);
    }
    public function getProductId($id)
    {
        $data = $this->Products->find($id);
        return $this->respond(['status' => 'success',  'data' => $data], 200);
    }
    public function insert()
    {
        if ($json = $this->request->getJSON()) {

            echo "<pre>";
            print_r($json);
            echo "</pre>";
            exit;

            # code...
            if (!$json || !isset($json->name) || !isset($json->price)) {
                return $this->fail('Invalid data', 400);
            }

            $data = [
                'name'  => $json->name,
                'price' => $json->price
            ];
            $this->model->insert($data);

            return $this->respondCreated([
                'status' => 'success',
                'message' => 'User added successfully',
                'data' => $data
            ]);
            return $this->respond(['status' => 'success',  'data' => $data], 200);
        }
        return view('products/insert');
    }
}
