<!DOCTYPE html>
<html lang="id" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UMKM Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: "Poppins", Arial, sans-serif;
      background: #f8f9fa;
      color: #111;
    }

    /* Navbar */
    .navbar {
      transition: all 0.3s ease;
      background: transparent;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }

    .navbar.scrolled {
      background: linear-gradient(90deg, #0071e3, #6a5acd);
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: 700;
      font-size: 1.4rem;
    }

    .nav-link {
      color: #fff !important;
      margin: 0 10px;
      font-weight: 500;
    }

    .cart-badge {
      position: absolute;
      top: -6px;
      right: -6px;
      background: #ff4757;
      color: white;
      border-radius: 50%;
      padding: 0.25rem 0.5rem;
      font-size: 0.7rem;
    }

    /* Carousel Hero */
    .carousel-item {
      height: 100vh;
      min-height: 500px;
    }

    .carousel-item img {
      object-fit: cover;
      filter: brightness(70%);
      height: 100%;
      width: 100%;
    }

    .carousel-caption {
      bottom: 30%;
    }

    .carousel-caption h1 {
      font-size: 3rem;
      font-weight: 700;
    }

    .carousel-caption p {
      font-size: 1.2rem;
    }

    /* Produk */
    .product-card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background: #fff;
    }

    .product-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .product-image {
      height: 250px;
      object-fit: cover;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
    }

    .product-price {
      font-size: 1.3rem;
      font-weight: 700;
      color: #0071e3;
    }

    .add-to-cart-btn {
      background: linear-gradient(45deg, #0071e3, #6a5acd);
      border: none;
      border-radius: 12px;
      color: #fff;
      font-weight: 500;
      padding: 10px;
      transition: all 0.3s ease;
    }

    .add-to-cart-btn:hover {
      background: linear-gradient(45deg, #005bb5, #483d8b);
      transform: scale(1.05);
    }

    footer {
      background: #111;
      color: #bbb;
      padding: 40px 0;
      text-align: center;
    }

    .alert-toast {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      border-radius: 12px;
    }

    .navbar-toggler-icon {
      filter: invert(1);
    }
  </style>
</head>

<body>
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = ['name'=>$product_name,'price'=>$product_price,'quantity'=>1];
    }
    $_SESSION['toast_message'] = "✔ $product_name ditambahkan ke keranjang";
    header("Location: ".$_SERVER['PHP_SELF']); exit();
}

$category_filter = $_GET['category'] ?? '';
$search_term = $_GET['search'] ?? '';

$query = "SELECT * FROM produk WHERE stok > 0";
if ($category_filter) {
    $category_filter = mysqli_real_escape_string($conn, $category_filter);
    $query .= " AND LOWER(kategori) = LOWER('$category_filter')";
}
if ($search_term) {
    $search_term = mysqli_real_escape_string($conn, $search_term);
    $query .= " AND (nama_produk LIKE '%$search_term%' OR deskripsi LIKE '%$search_term%')";
}
$query .= " ORDER BY id_produk DESC";
$result = mysqli_query($conn, $query);
$cart_count = array_sum(array_column($_SESSION['cart'], 'quantity'));
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <i class="fas fa-store me-2"></i>UMKM Store
    </a>
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index2.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="?category=">Semua Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <!-- Foto Profil -->
        <img src="img/bb.png" alt="Profil Toko" class="rounded-circle" width="40" height="40">

        <!-- Keranjang -->
        <a href="cart.php" class="btn btn-light position-relative">
          <i class="fas fa-shopping-bag"></i>
          <span class="cart-badge"><?= $cart_count ?></span>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/bg.png" class="d-block w-100" alt="Produk UMKM 1">
      <div class="carousel-caption">
        <h1>Produk UMKM Premium</h1>
        <p>Temukan produk berkualitas dengan harga terjangkau</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/bg4.png" class="d-block w-100" alt="Produk UMKM 2">
      <div class="carousel-caption">
        <h1>Dukung Bisnis Lokal</h1>
        <p>Setiap pembelian berarti dukungan untuk UMKM Indonesia</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/bg4.png" class="d-block w-100" alt="Produk UMKM 3">
      <div class="carousel-caption">
        <h1>Belanja Mudah & Cepat</h1>
        <p>Nikmati pengalaman belanja online modern</p>
      </div>
    </div>
  </div>
  <!-- Navigasi Carousel -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- Filter & Produk -->
<div class="container my-5 pt-5">
  <form method="GET" action="" class="category-filter mb-4">
    <div class="row g-2">
      <div class="col-md-6">
        <select class="form-select" name="category" onchange="this.form.submit()">
          <option value="">Semua Kategori</option>
          <option value="sticky milk" <?= $category_filter == 'sticky milk' ? 'selected' : '' ?>>Sticky Milk</option>
          <option value="kopi" <?= $category_filter == 'kopi' ? 'selected' : '' ?>>Kopi</option>
        </select>
      </div>
      <div class="col-md-6">
        <div class="d-flex gap-2">
          <input type="text" class="form-control" name="search" placeholder="Cari produk..." value="<?= htmlspecialchars($search_term) ?>">
          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
          <?php if ($search_term || $category_filter): ?>
            <a href="index2.php" class="btn btn-secondary"><i class="fas fa-times"></i></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </form>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    <?php if(mysqli_num_rows($result) > 0): ?>
      <?php while($product = mysqli_fetch_assoc($result)): ?>
      <div class="col">
        <div class="card product-card h-100">
          <img src="img/<?= $product['foto'] ? htmlspecialchars($product['foto']) : 'no-image.png' ?>" 
               class="product-image" 
               alt="<?= htmlspecialchars($product['Nama_produk']) ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($product['Nama_produk']) ?></h5>
            <p class="text-muted small mb-3"><?= substr(htmlspecialchars($product['deskripsi']), 0, 80) ?>...</p>
            <div class="mt-auto">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="product-price">Rp <?= number_format($product['harga'], 0, ',', '.') ?></span>
                <small class="text-muted">Stok: <?= $product['stok'] ?></small>
              </div>
              <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?= $product['id_produk'] ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['Nama_produk']) ?>">
                <input type="hidden" name="product_price" value="<?= $product['harga'] ?>">
                <button type="submit" name="add_to_cart" class="btn add-to-cart-btn w-100">
                  <i class="fas fa-plus me-2"></i>Keranjang
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12 text-center"><p class="text-muted">Produk tidak ditemukan</p></div>
    <?php endif; ?>
  </div>
</div>

<!-- Tentang Kami -->
<section id="tentang" class="py-5" style="background: linear-gradient(135deg, #0071e3, #6a5acd); color: white;">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">Tentang UMKM Store</h2>
    <p class="lead mb-4">
      UMKM Store hadir untuk mendukung bisnis lokal dengan menyediakan platform belanja online modern.
      Setiap pembelian Anda berarti dukungan nyata bagi pengusaha kecil Indonesia.
    </p>
    <img src="img/team.jpg" class="img-fluid rounded-4 shadow" alt="Tim UMKM" style="max-width: 400px;">
  </div>
</section>

<!-- Footer -->
<footer id="footer">
  <div class="container">
    <p>&copy; 2024 UMKM Store — <i class="fas fa-heart text-danger"></i> Support Local Business</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Navbar scroll effect
  window.addEventListener("scroll", function() {
    let navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 50);
  });
</script>

<?php if (isset($_SESSION['toast_message'])): ?>
  <div class="alert alert-success alert-toast" role="alert">
    <?= $_SESSION['toast_message'] ?>
  </div>
  <script>
    setTimeout(() => document.querySelectorAll('.alert-toast').forEach(el => el.remove()), 2500);
  </script>
  <?php unset($_SESSION['toast_message']); ?>
<?php endif; ?>
</body>
</html>
