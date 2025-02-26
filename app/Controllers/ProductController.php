<?php

namespace App\Controllers;

use App\Models\Product;
use Rakit\Validation\Validator;

class ProductController extends Controller
{
    protected $productModel;
    public function __construct()
    {
        $this->productModel = new Product();
    }
    public function list()
    {
        if (isset(($_GET['keyWord']))) {
            $products = $this->productModel->search($_GET['keyWord'], $_GET['page'] = 1, $_GET['limit'] = 10);
        } else {
            $products = $this->productModel->paginate($_GET['page'] = 1, $_GET['limit'] = 10);
        }

        view('admin.products.list-product', compact('products'));
    }
    public function add()
    {
        $categories = $this->productModel->getCategory();
        view('admin.products.add-product', compact('categories'));
    }
    public function store()
    { {
            try {
                $validator = new Validator;
                $validation = $validator->validate(
                    [
                        'name' => $_POST['name'],
                        'image' => $_FILES['image'],
                        'price' => $_POST['price'],
                        'stock' => $_POST['stock'],
                        'category' => $_POST['category'],
                        'description' => $_POST['description'],
                    ],
                    [
                        'name' => 'required|max:100',
                        'image' => 'required|uploaded_file:0,2M,png,jpg,jpeg',
                        'price' => 'required|integer|min:0',
                        'stock' => 'required|integer|min:0',
                        'category' => 'required',
                        'description' => 'max:200',
                    ]
                );
                if ($validation->fails()) {
                    $_SESSION['errors'] = $validation->errors()->firstOfAll();
                    redirect($_ENV['BASE_URL'] . 'product/add');
                } else {
                    $image = $this->uploadFile($_FILES['image']);
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $stock = $_POST['stock'];
                    $categoryId = $_POST['category'];
                    $description = $_POST['description'];
                    $this->productModel->insert(
                        [
                            'name' => $name,
                            'category_id' => $categoryId,
                            'description' => $description,
                            'price' => $price,
                            'stock' => $stock,
                            'image' => $image,
                        ]
                    );
                    redirect($_ENV['BASE_URL'] . 'product');
                }
            } catch (\Throwable $th) {
                echo "ERROR: " . $th->getMessage();
            }
        }
    }
    public function update($id)
    {
        $categories = $this->productModel->getCategory();
        $product = $this->productModel->find($id);
        view('admin.products.update-product', compact('categories', 'product'));
    }
    public function postUpdate($id)
    { {
            try {
                $validator = new Validator;
                $validation = $validator->validate(
                    [
                        'name' => $_POST['name'],
                        'image' => $_FILES['image'],
                        'price' => $_POST['price'],
                        'stock' => $_POST['stock'],
                        'category' => $_POST['category'],
                        'description' => $_POST['description'],
                    ],
                    [
                        'name' => 'required|max:100',
                        'image' => 'uploaded_file:0,2M,png,jpg,jpeg',
                        'price' => 'required|integer|min:0',
                        'stock' => 'required|integer|min:0',
                        'category' => 'required',
                        'description' => 'max:200',
                    ]
                );
                if ($validation->fails()) {
                    $_SESSION['errors'] = $validation->errors()->firstOfAll();
                    redirect($_ENV['BASE_URL'] . 'product/update/' . $id);
                } else {
                    $product = $this->productModel->find($id);
                    if ($_FILES['image']['tmp_name'] != '' && isset($_FILES['image'])) {
                        $image = $this->uploadFile($_FILES['image']);
                        unlink($product['image']);
                    } else {
                        $image = $product['image'];
                    }
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $stock = $_POST['stock'];
                    $categoryId = $_POST['category'];
                    $description = $_POST['description'];
                    $this->productModel->update(
                        $id,
                        [
                            'name' => $name,
                            'category_id' => $categoryId,
                            'description' => $description,
                            'price' => $price,
                            'stock' => $stock,
                            'image' => $image,
                        ]
                    );
                    redirect($_ENV['BASE_URL'] . 'product');
                }
            } catch (\Throwable $th) {
                echo "ERROR: " . $th->getMessage();
            }
        }
    }
    public function delete($id)
    {
        try {
            $product = $this->productModel->find($id);
            if (file_exists($product['image'])) {
                unlink($product['image']);
            }
            $this->productModel->delete($id);
            $_SESSION['messages']['delete'] = 'Xóa thành công';
            redirect($_ENV['BASE_URL'] . 'product');
        } catch (\Throwable $th) {
            echo 'ERROR: ' . $th->getMessage();
        }
    }
    public function show($id)
    {
        $product = $this->productModel->find($id);
        view('admin.products.show-product', compact('product'));
    }
}
