<?php require_once 'layout/header.php' ?>

<?php require_once 'layout/menu.php' ?>


<main>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=gio-hang' ?>">Gio hang</a></li>
                                <li class="breadcrumb-item active">Don Hang</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body cart-table table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listDonHang as $key => $donHang): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $donHang['ma_don_hang'] ?></td>
                                            <td><?= $donHang['ngay_dat'] ?></td>
                                            <td><?= $donHang['tong_tien'] ?></td>
                                            <td><?= $donHang['ten_trang_thai'] ?></td>

                                            <td>
                                                <a  href="<?= BASE_URL . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>">
                                                    Xem
                                                </a>
                                                <hr>
                                                <a onclick="return confirm('Xac nhan huy ?')" href="<?= BASE_URL . '?act=huy-don&id_don_hang=' . $donHang['id'] ?>">
                                                    Huy
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</main>

<?php require_once 'layout/miniCart.php' ?>
<?php require_once 'layout/footer.php' ?>