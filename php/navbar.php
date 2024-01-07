<?php
session_start();

$button; 

if (isset($_SESSION['kullaniciadi'])) {
    $kullaniciadi = $_SESSION['kullaniciadi'];
    if($kullaniciadi === 'admin'){
        $button = '
        <a href="admin.php" class="btn btn-primary shadow-none me-lg-2 me-3 "> <i class="bi bi-person-fill"></i> ' . $kullaniciadi . '</a>
        <a href="../Project/php/cikis.php" class="btn btn-outline-dark shadow-none">Çıkış Yap</a>
        ';
    }else 
        $button = '
        <a href="kullanici.php" class="btn btn-primary shadow-none me-lg-2 me-3 "> <i class="bi bi-person-fill"></i> ' . $kullaniciadi . '</a>
        <a href="../Project/php/cikis.php" class="btn btn-outline-dark shadow-none">Çıkış Yap</a>
        ';
    
} else {
    $button = '
    <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#girisModal">Giriş Yap</button>
    <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#kayitModal">Kayıt Ol</button>
    ';
    
}
?>

<!-- Navbar Başlangıç -->
<nav class="navbar navbar-expand-lg navbar-light bg-white bg-gradient px-lg-3 py-lg-2 shadow-sm sticky-top mb-3 ">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Uysal Otel</a>
        <button class="navbar-toggler  shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage === 'index') echo 'active'; ?> me-2" <?php if($currentPage === 'index') echo 'aria-current="page"'; ?> href="index.php">Ana Sayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage === 'odalar') echo 'active'; ?> me-2" <?php if($currentPage === 'odalar') echo 'aria-current="page"'; ?> href="odalar.php">Odalar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage === 'iletisim') echo 'active'; ?> me-2" <?php if($currentPage === 'iletisim') echo 'aria-current="page"'; ?> href="iletisim.php">İletişim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage === 'hakkimizda') echo 'active'; ?> me-2" <?php if($currentPage === 'hakkimizda') echo 'aria-current="page"'; ?> href="hakkimizda.php">Hakkımızda</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php echo $button; ?>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar Bitiş -->

<!-- Giriş ve Kayıt Modal Başlangıç -->
<div class="modal fade" id="girisModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../Project/php/giris.php" class="form" method="POST">
                <div class="modal-header ">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person fs-3 me-2 "></i> Giriş
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input name="email" type="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Şifre</label>
                        <input name="sifre" type="password" class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">Giriş Yap</button>
                        <a href="javascript: void(0);" class="text-secondary text-decoration-none shadow-none">Şifremi Unuttum</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="kayitModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../Project/php/kayit.php" class="form" method="POST" enctype="multipart/form-data">
                <div class="modal-header ">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-add fs-3 me-2"></i>Kayıt
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                    Not: Kayıt bilgilerinizin kimlik bilgilerinizle aynı olması gerekmektedir.
                </span>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label">Ad</label>
                            <input name="ad" type="text" class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label">E-mail</label>
                            <input name="email" type="email" class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label ">Telefon</label><br>
                            <input id="phone" type="number" class="form-control shadow-none" name="phone" />
                        </div>
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label">Profil Resmi</label>
                            <input name="resim" type="file" class="form-control shadow-none">
                        </div>
                        <div class="col-md-12 ps-0 mb-3">
                            <label class="form-label">Adres</label>
                            <textarea name="adres" class="form-control" rows="1"></textarea>
                        </div>
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label ">Zip Kodu</label><br>
                            <input name="zip_kodu" type="number" class="form-control shadow-none"/>
                        </div>
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label">Doğum Tarihi</label>
                            <input name="dogum_gunu" type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label ">Şifre</label><br>
                            <input name="sifre"type="password" class="form-control shadow-none"/>
                        </div>
                        <div class="col-md-6 ps-0 mb-3">
                            <label class="form-label ">Şifreyi Doğrula</label><br>
                            <input name="sifre_dogrula" type="password" class="form-control shadow-none"/>
                        </div>                                                      
                    </div>
                </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">Kayıt Ol</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Giriş ve Kayıt Modal Bitiş -->

<script src="../Project/js/navbar.js"></script>


