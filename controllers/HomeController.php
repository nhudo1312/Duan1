<?php

class HomeController
{
    public $modelSanPham;

    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        deleteSessionError();
        $listDanhMuc = $this->modelSanPham->getAllDanhMucSanPham();
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listSanPhamHot = $this->modelSanPham->getAllHotProducts();
        require_once './views/home.php';
    }

    public function chiTietSanPham()
    {
        deleteSessionError();
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);


        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("location: " . BASE_URL);
            exit();
        }
    }

    public function formLogin()
    {
        require_once './views/auth/formLogin.php';

        deleteSessionError();
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy email và password từ form
            $email = $_POST['email'];
            $password = $_POST['password'];

            // var_dump($email, $password);
            // // Xử lý ktra thông tin đăng nhập

            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($user == $email) { //Trường hợp đn thành công
                // Lưu thông tin vào session

                $_SESSION['user_client'] = $user;
                header('location:' . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);die;
                $_SESSION['flash'] = true;

                header('location:' . BASE_URL . '?act=login');
                exit();
            }
        }
    }

    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                // Lấy dữ liệu giỏ hàng của ng dùng
                // var_dump($mail['id']);die;
                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];

                $checkSanPham = false;
                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);

                        $checkSanPham = true;
                        break;
                    }
                }

                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }

                header('location:' . BASE_URL . '?act=gio-hang');
            } else {
                var_dump('Chưa đăng nhập');
                die;
            }
        }
    }

    public function gioHang()
    {
        // deleteSessionError();
        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // Lấy dữ liệu giỏ hàng của ng dùng
            // var_dump($mail['id']);die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            // var_dump($chiTietGioHang);die;

            require_once './views/gioHang.php';
        } else {
            header("Location:" . BASE_URL . '?act=login');
        }
    }

    public function thanhToan()
    {
        deleteSessionError();
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // Lấy dữ liệu giỏ hàng của ng dùng
            // var_dump($mail['id']);die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            // var_dump($chiTietGioHang);die;

            require_once './views/thanhToan.php';
        } else {
            var_dump('Chưa đăng nhập');
            die;
        }
    }

    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];

            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            $ma_don_hang = 'DH-' . rand(1000, 9999);

            $don_hang_id = $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $ma_don_hang,
                $trang_thai_id,
            );

            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            // var_dump($gioHang);
            // die;
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            // var_dump($chiTietGioHang);
            // die;

            foreach ($chiTietGioHang as $key => $sanPham) {
                if ($sanPham['gia_khuyen_mai']) {
                    $don_gia = $sanPham['gia_khuyen_mai'];
                } else {
                    $don_gia = $sanPham['gia_san_pham'];
                }
                $thanh_tien = $don_gia * $sanPham['so_luong'];
                $this->modelDonHang->addDetailDonHang($don_hang_id, $sanPham['san_pham_id'], $don_gia, $sanPham['so_luong'], $thanh_tien);
            }

            $this->modelGioHang->deleteGioHang($gioHang['id']);

            //them thong tin vào db

            $_SESSION['flash'] = true;

            header("Location: " . BASE_URL . '?act=gio-hang');
        }
    }

    public function listDonHang()
    {
        deleteSessionError();
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        $tai_khoan_id = $user['id'];
        $listDonHang = $this->modelDonHang->getAllDonHang($tai_khoan_id);
        require_once './views/listDonHang.php';
    }

    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don_hang'];

        // lấy thông tin đơn hàng ở bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        //lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi_tiet_don_hangs
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
        // var_dump($sanPhamDonHang);
        // die;

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        require_once './views/detailDonHang.php';
    }

    public function formRegister()
    {
        require_once './views/auth/formRegister.php';

        deleteSessionError();
    }

    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $confirm_password = $_POST['confirm_password'];

            // Kiểm tra xem email đã tồn tại chưa
            $existingUser = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
            if ($existingUser) {
                echo "Email đã được sử dụng.";
                return;
            }

            // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp không
            if ($mat_khau !== $confirm_password) {
                echo "Mật khẩu không khớp.";
                return;
            }

            // Mã hóa mật khẩu trước khi lưu
            $hashedPassword = password_hash($mat_khau, PASSWORD_DEFAULT);

            $chuc_vu_id = 2;


            // Thêm người dùng mới vào database
            $this->modelTaiKhoan->addTaiKhoan($ho_ten, $email, $hashedPassword, $chuc_vu_id);


            session_start();
            $_SESSION['success_message'] = "Đăng ký thành công! Hãy đăng nhập.";
            // Chuyển hướng về trang chủ hoặc trang đăng nhập
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function logout()
    {
        // Bắt đầu session nếu chưa có
        session_start();

        // Xóa tất cả dữ liệu trong session
        session_unset();

        // Hủy session
        session_destroy();

        // Chuyển hướng về trang đăng nhập
        header('Location: ' . BASE_URL . '?act=login');
        exit;
    }

    public function account()
    {

        $email = $_GET['email'];

        $khachHang = $this->modelTaiKhoan->getDetailAccount($email);

        require_once './views/auth/account.php';
    }

    public function huyDonHang()
    {
        $id = $_GET['id_don_hang'];
        // var_dump($id);
        // die;

        $this->modelDonHang->huyDonHang($id);

        header('Location: ' . BASE_URL . '?act=don-hang');
    }

    public function danhMuc()
    {
        $id = $_GET['id'];

        $listSanPham = $this->modelSanPham->getListSanPhamDanhMuc($id);

        $total = count($listSanPham);

        $danhMuc = $this->modelSanPham->getNameDanhMuc($id);
        // var_dump($danhMuc);die;

        require_once './views/danhMuc.php';
    }

    public function xoaHang()
    {
        $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        
        $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
        
        $idSanPham = $_GET['id'];
        $idGioHang = $gioHang['id'];

        $this->modelGioHang->deleteSPGioHang($idGioHang,$idSanPham);
        // var_dump($check);die;
        header('Location: ' . BASE_URL . '?act=gio-hang');
    }
}
