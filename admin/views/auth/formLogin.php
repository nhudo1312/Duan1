<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập ADMIN</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="./assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css?v=3.2.0">
    <script nonce="c2277def-7503-408e-adfe-d95deb7a874d">
        try {
            (function(w, d) {
                ! function(bk, bl, bm, bn) {
                    if (bk.zaraz) console.error("zaraz is loaded twice");
                    else {
                        bk[bm] = bk[bm] || {};
                        bk[bm].executed = [];
                        bk.zaraz = {
                            deferred: [],
                            listeners: []
                        };
                        bk.zaraz._v = "5807";
                        bk.zaraz._n = "c2277def-7503-408e-adfe-d95deb7a874d";
                        bk.zaraz.q = [];
                        bk.zaraz._f = function(bo) {
                            return async function() {
                                var bp = Array.prototype.slice.call(arguments);
                                bk.zaraz.q.push({
                                    m: bo,
                                    a: bp
                                })
                            }
                        };
                        for (const bq of ["track", "set", "debug"]) bk.zaraz[bq] = bk.zaraz._f(bq);
                        bk.zaraz.init = () => {
                            var br = bl.getElementsByTagName(bn)[0],
                                bs = bl.createElement(bn),
                                bt = bl.getElementsByTagName("title")[0];
                            bt && (bk[bm].t = bl.getElementsByTagName("title")[0].text);
                            bk[bm].x = Math.random();
                            bk[bm].w = bk.screen.width;
                            bk[bm].h = bk.screen.height;
                            bk[bm].j = bk.innerHeight;
                            bk[bm].e = bk.innerWidth;
                            bk[bm].l = bk.location.href;
                            bk[bm].r = bl.referrer;
                            bk[bm].k = bk.screen.colorDepth;
                            bk[bm].n = bl.characterSet;
                            bk[bm].o = (new Date).getTimezoneOffset();
                            if (bk.dataLayer)
                                for (const bx of Object.entries(Object.entries(dataLayer).reduce(((by, bz) => ({
                                        ...by[1],
                                        ...bz[1]
                                    })), {}))) zaraz.set(bx[0], bx[1], {
                                    scope: "page"
                                });
                            bk[bm].q = [];
                            for (; bk.zaraz.q.length;) {
                                const bA = bk.zaraz.q.shift();
                                bk[bm].q.push(bA)
                            }
                            bs.defer = !0;
                            for (const bB of [localStorage, sessionStorage]) Object.keys(bB || {}).filter((bD => bD.startsWith("_zaraz_"))).forEach((bC => {
                                try {
                                    bk[bm]["z_" + bC.slice(7)] = JSON.parse(bB.getItem(bC))
                                } catch {
                                    bk[bm]["z_" + bC.slice(7)] = bB.getItem(bC)
                                }
                            }));
                            bs.referrerPolicy = "origin";
                            bs.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bk[bm])));
                            br.parentNode.insertBefore(bs, br)
                        };
                        ["complete", "interactive"].includes(bl.readyState) ? zaraz.init() : bk.addEventListener("DOMContentLoaded", zaraz.init)
                    }
                }(w, d, "zarazData", "script");
                window.zaraz._p = async j => new Promise((k => {
                    if (j) {
                        j.e && j.e.forEach((l => {
                            try {
                                const m = d.querySelector("script[nonce]"),
                                    n = m?.nonce || m?.getAttribute("nonce"),
                                    o = d.createElement("script");
                                n && (o.nonce = n);
                                o.innerHTML = l;
                                o.onload = () => {
                                    d.head.removeChild(o)
                                };
                                d.head.appendChild(o)
                            } catch (p) {
                                console.error(`Error executing script: ${l}\n`, p)
                            }
                        }));
                        Promise.allSettled((j.f || []).map((q => fetch(q[0], q[1]))))
                    }
                    k()
                }));
                zaraz._p({
                    "e": ["(function(w,d){})(window,document)"]
                });
            })(window, document)
        } catch (e) {
            throw fetch("/cdn-cgi/zaraz/t"), e;
        };
    </script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="./assets/index2.html" class="h1">VDK</a>
            </div>
            <div class="card-body">

                <?php if (isset($_SESSION['error'])) { ?>
                    <p class="text-danger login-box-msg"><?= $_SESSION['error'] ?></p>
                <?php } else {?>
                    <p class="login-box-msg">Đăng nhập tài khoản của bạn</p>
                <?php } ?>
                <form action="<?= BASE_URL_ADMIN . '?act=check-login-admin' ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>

                    </div>
                </form>
                <p class="mb-1">
                    <a href="#">Quên mật khẩu</a>
                </p>
            </div>

        </div>

    </div>


    <script src="./assets/plugins/jquery/jquery.min.js"></script>

    <script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="./assets/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>