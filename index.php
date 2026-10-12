<?php
require_once __DIR__ . '/db.php';

$search = trim($_GET['search'] ?? '');
if ($search !== '') {
    $stmt = $conn->prepare("SELECT id, name, description, price, image_url FROM products WHERE name LIKE ? OR description LIKE ? ORDER BY id DESC");
    $like = "%{$search}%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $products = $stmt->get_result();
} else {
    $products = $conn->query("SELECT id, name, description, price, image_url FROM products ORDER BY id DESC");
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Raashid Shop</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
  <a class="logo" href="index.php">Raashid<span>Shop</span></a>
  <nav><a href="index.php">Home</a><a href="#products">Products</a><a href="admin.php">Manage products</a></nav>
</header>
<section class="hero">
  <div>
    <p class="eyebrow">WELCOME TO OUR STORE</p>
    <h1>Find your next<br><span>favorite thing.</span></h1>
    <p>Simple shopping, great products, and prices you’ll love.</p>
    <a class="button" href="#products">Explore products</a>
  </div>
  <div class="hero-art" aria-hidden="true">🛍️</div>
</section>
<main id="products" class="main">
  <div class="section-head">
    <div><p class="eyebrow">OUR COLLECTION</p><h2>Popular products</h2></div>
    <form class="search" method="get">
      <input type="search" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">
      <button type="submit">Search</button>
    </form>
  </div>
  <div class="grid">
  <?php if ($products && $products->num_rows > 0): ?>
    <?php while ($p = $products->fetch_assoc()): ?>
      <article class="card">
        <div class="product-image">
          <?php if (!empty($p['image_url'])): ?>
            <img src="<?= htmlspecialchars($p['image_url'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>">
          <?php else: ?><span>🛒</span><?php endif; ?>
        </div>
        <div class="card-content">
          <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>
          <p><?= htmlspecialchars($p['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
          <div class="card-bottom"><strong>$<?= number_format((float)$p['price'], 2) ?></strong><a href="mailto:shop@example.com?subject=Order%20<?= rawurlencode($p['name']) ?>">Order</a></div>
        </div>
      </article>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="empty">No products found. Add products from the Manage products page.</p>
  <?php endif; ?>
  </div>
</main>
<footer><p>© <?= date('Y') ?> Raashid Shop · Made with HTML, CSS, PHP & MySQL</p></footer>
</body>
</html>
