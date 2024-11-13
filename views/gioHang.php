<?php require_once 'layout/header.php' ?>

<?php require_once 'layout/menu.php' ?>

<main>
    <!-- breadcrumb area start -->

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gio hang</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    <?php if (isset($_SESSION['flash'])) { ?>
        <div class="container bg-success">
            <div class="row">
                <p class="login-box-msg text-center mt-3 mb-3" style="color:white">Thanh toan thanh cong</p>
            </div>
        </div>
    <?php } ?>
    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="d-md-flex">
                        <div class="cart-update">
                            <a href="<?= BASE_URL . '?act=don-hang' ?>" class="btn btn-sqr">Danh sach don hang cua toi</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Cart Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Ảnh sản phẩm</th>
                                        <th class="pro-title">Tên sản phẩm</th>
                                        <th class="pro-price">Giá tiền</th>
                                        <th class="pro-quantity">Số lượng</th>
                                        <th class="pro-subtotal">Tổng tiền</th>
                                        <th class="pro-remove">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tongGioHang = 0;
                                    foreach ($chiTietGioHang as $key => $sanPham):

                                    ?>
                                        <tr>
                                            <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="Product" /></a></td>
                                            <td class="pro-title"><a href="#"><?= $sanPham['ten_san_pham'] ?></a></td>
                                            <td class="pro-price"><span>
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <?= formatPrice($sanPham['gia_khuyen_mai']) . ' đ' ?>
                                                    <?php } else { ?>
                                                        <?= formatPrice($sanPham['gia_san_pham']) . ' đ' ?>
                                                    <?php } ?>

                                                </span></td>
                                            <td class="pro-quantity">
                                                <div class="pro-qty"><input type="text" value="<?= $sanPham['so_luong'] ?>"></div>
                                            </td>
                                            <td class="pro-subtotal"><span>
                                                    <?php
                                                    $tongTien = 0;
                                                    if ($sanPham['gia_khuyen_mai']) {
                                                        $tongTien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                    } else {
                                                        $tongTien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                    }
                                                    $tongGioHang += $tongTien;
                                                    echo formatPrice($tongTien) . ' đ';
                                                    ?>

                                                </span></td>
                                            <td class="pro-remove"><a href="<?= BASE_URL . '?act=xoa-gio-hang&id='. $sanPham['san_pham_id'] ?>"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <?php if ($chiTietGioHang) { ?>
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->

                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h6>Tổng đơn hàng</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Tổng tiền sản phẩm</td>
                                                <td><?= formatPrice($tongGioHang) . ' đ' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Vận chuyển</td>
                                                <td>30.000 đ</td>
                                            </tr>
                                            <tr class="total">
                                                <td>Tổng thanh toán</td>
                                                <td class="total-amount"><?= formatPrice($tongGioHang + 30000) . ' đ' ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr d-block">Tiến hành đặt hàng</a>
                            </div>



                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <p class="login-box-msg text-center mt-3 mb-3" style="color:gray">Trống</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
</main>



<?php require_once 'layout/miniCart.php' ?>
<?php require_once 'layout/footer.php' ?>