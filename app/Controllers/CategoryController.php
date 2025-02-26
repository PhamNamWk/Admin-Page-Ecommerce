<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use Rakit\Validation\Validator;

class CategoryController extends Controller
{
    private $categoryModel;
    private $productModel;
    public function __construct()
    {
        $this->categoryModel = new Category();
        $this->productModel = new product();
    }
    public function list()
    {
        if (isset($_GET['keyWord']) && $_GET['keyWord'] != '') {
            $keyWord = $_GET['keyWord'];
            $categories = $this->categoryModel->search($keyWord, $_GET['page'] ?? 1, $_GET['limit'] ?? 10);
        } else {
            $categories = $this->categoryModel->paginate($_GET['page'] ?? 1, $_GET['limit'] ?? 10);
        }

        view('admin.categories.list-category', compact(['categories']));
    }

    public function add()
    {
        view('admin.categories.add-category');
    }
    public function store()
    {
        try {
            $validator = new Validator;
            $validation = $validator->validate(
                [
                    'name' => $_POST['name'],
                    'image' => $_FILES['image'],
                    'description' => $_POST['description'],
                ],
                [
                    'name' => 'required|max:100',
                    'image' => 'uploaded_file:0,2M,png,jpg,jpeg',
                    'description' => 'max:200',
                ]
            );
            if ($validation->fails()) {
                $_SESSION['errors'] = $validation->errors()->firstOfAll();
                redirect($_ENV['BASE_URL'] . 'category/add');
            } else {
                $image = $this->uploadFile($_FILES['image']);
                $name = $_POST['name'];
                $description = $_POST['description'];
                $status = $_POST['status'] == 'on' ? 1 : 0;
                $this->categoryModel->insert(compact('name', 'description', 'image', 'status'));
                redirect($_ENV['BASE_URL'] . 'category');
            }
        } catch (\Throwable $th) {
            echo "ERROR: " . $th->getMessage();
        }
    }
    public function show($id)
    {
        $category = $this->categoryModel->find($id);
        view('admin.categories.show-category', compact('category'));
    }
    public function update($id)
    {
        $category = $this->categoryModel->find($id);
        view('admin.categories.update-category', compact('category'));
    }
    public function postUpdate($id)
    {
        try {
            $validator = new Validator;
            $validation = $validator->validate(
                [
                    'name' => $_POST['name'],
                    'image' => $_FILES['image'],
                    'description' => $_POST['description'],
                ],
                [
                    'name' => 'required|max:100',
                    'image' => 'uploaded_file:0,2M,png,jpg,jpeg',
                    'description' => 'max:200',
                ]
            );
            if ($validation->fails()) {
                $_SESSION['errors'] = $validation->errors()->firstOfAll();
                redirect($_ENV['BASE_URL'] . 'category/update/' . $id);
            } else {
                $category = $this->categoryModel->find($id);
                if ($_FILES['image']['tmp_name'] != '' && isset($_FILES['image'])) {
                    $image = $this->uploadFile($_FILES['image']);
                    unlink($category['image']);
                } else {
                    $image = $category['image'];
                }
                $name = $_POST['name'];
                $description = $_POST['description'];
                $status = $_POST['status'] == 'on' ? 1 : 0;
                $this->categoryModel->update($id, compact('name', 'description', 'image', 'status'));
                redirect($_ENV['BASE_URL'] . 'category');
            }
        } catch (\Throwable $th) {
            echo "ERROR: " . $th->getMessage();
        }
    }
    public function delete($id)
    {
        try {
            $category = $this->categoryModel->find($id);
            $products = $this->productModel->findByIdCategory($id);
            if (file_exists($category['image'])) {
                unlink($category['image']);
            }
            foreach ($products as $product) {
                $this->categoryModel->updateProductCategory($product['id']);
            }
            $this->categoryModel->delete($id);
            $_SESSION['messages']['delete'] = 'Xóa thành công';
            redirect($_ENV['BASE_URL'] . 'category');
        } catch (\Throwable $th) {
            echo 'ERROR: ' . $th->getMessage();
        }
    }
}
