<?php

class AdminDanhMucController
{
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDanhMuc()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }

    public function formAddDanhMuc()
    {
        // Hàm này dùng để hiển thị form nhập

        // Kiểm tra xem dữ liệu cs phải đc submit lên không
        require_once './views/danhmuc/addDanhMuc.php';

        deleteSessionError();
    }

    public function postAddDanhMuc()
    {
        // Hàm này dùng để xử lý thêm dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // Tạo 1 mảng trống để lấy dữ liệu
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            $_SESSION['error'] = $errors;
            // Nếu k có lỗi thì tiến hành thêm danh mục
            if (empty($errors)) {
                // var_dump('ok');
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            }else{
                $_SESSION['flash'] = true;
                 
                header("location: " . BASE_URL_ADMIN . '?act=form-them-danh-muc');
                exit();
            }
        }
    }

    public function formEditDanhMuc()
    {
        // Hàm này dùng để hiển thị form nhập
        // lấy ra thông tin của danh mục cần sửa
        $id = $_GET['id_danh_muc'];
        $danhmuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if($danhmuc){
            require_once './views/danhmuc/editDanhMuc.php';
        } else{
            header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }

    public function postEditDanhMuc()
    {
        // Hàm này dùng để xử lý sửa dữ liệu

        // Kiểm tra xem dữ liệu cs phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // Tạo 1 mảng trống để lấy dữ liệu
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }

            // Nếu k có lỗi thì tiến hành sửa danh mục
            if (empty($errors)) {
            // Nếu k có lỗi thì tiến hành sửa danh mục
                // var_dump('ok');
                $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            }else{
                // trả về form và lỗi
                $danhmuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta'=> $mo_ta ];
                require_once './views/danhmuc/editDanhMuc.php';
            }
        }
    }

    public function deleteDanhMuc(){
        // Hàm xóa danh mục
        $id = $_GET['id_danh_muc'];
        $danhmuc = $this->modelDanhMuc->getDetailDanhMuc($id);

        if($danhmuc){
            $this->modelDanhMuc->destroyDanhMuc($id);
        }
        header("location: " . BASE_URL_ADMIN . '?act=danh-muc');
        exit();
    }
}