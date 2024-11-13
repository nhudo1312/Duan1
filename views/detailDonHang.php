<?php require_once 'layout/header.php' ?>

<?php require_once 'layout/menu.php' ?>

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=gio-hang' ?>">Gio hang</a></li>
                            <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=don-hang' ?>">Don Hang</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thong tin don hang</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Đơn hàng: <?= $donHang['ma_don_hang'] ?></h1>
            </div>
            <!-- option trạng thái đơn hàng -->

            <!-- end option  -->
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Hiển thị trạng thái đơn hàng theo id  -->
                <?php
                if ($donHang['trang_thai_id'] == 1) {
                    $colorAlerts = 'primary';
                } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                    $colorAlerts = 'warning';
                } elseif ($donHang['trang_thai_id'] == 10) {
                    $colorAlerts = 'success';
                } else {
                    $colorAlerts = 'danger';
                }
                ?>
                <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                    Đơn hàng: <?= $donHang['ten_trang_thai'] ?>
                </div>

                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                Shop bán điện thoại VDK -
                                <small class="float-right">Ngày đặt: <?= formatDate($donHang['ngay_dat']); ?></small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Người nhận
                            <address>
                                <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                                Email: <?= $donHang['email_nguoi_nhan'] ?><br>
                                Số điện thoại: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Thông tin
                            <address>
                                <strong>Mã đơn hàng: <?= $donHang['ma_don_hang'] ?></strong><br>

                                Ghi chú: <?= $donHang['ghi_chu'] ?><br>
                                Thanh toán: <?= $donHang['ten_phuong_thuc'] ?><br>
                            </address>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $tong_tien = 0; ?>
                                    <?php
                                    foreach ($sanPhamDonHang as $key => $sanPham): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $sanPham['ten_san_pham'] ?></td>
                                            <td><?= $sanPham['don_gia'] ?></td>
                                            <td><?= $sanPham['so_luong'] ?></td>
                                            <td><?= $sanPham['thanh_tien'] ?></td>
                                        </tr>
                                        <?php $tong_tien += $sanPham['thanh_tien']; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->

                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Ngày đặt hàng: <?= $donHang['ngay_dat'] ?></p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Thành tiền:</th>
                                        <td>
                                            <?= $tong_tien ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Vận chuyển:</th>
                                        <td>200.000</td>
                                    </tr>
                                    <tr>
                                        <th>Tông tiền:</th>
                                        <td><?= $tong_tien + 200000 ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->

                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


<?php require_once 'layout/miniCart.php' ?>
<?php require_once 'layout/footer.php' ?>