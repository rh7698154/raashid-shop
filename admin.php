<?php
require_once __DIR__ . '/db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = filter_var($_POST['price'] ?? '', FILTER_VALIDATE_FLOAT);
    $image_url = trim($_POST['image_url'] ?? '');

    if ($name === '' || $price === false || $price < 0) {
        $message = 'Please enter a product name and a valid price.';
    } else {
        $stmt = $conn->prepare('INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssds', $name, $description, $price, $image_url);
        if ($stmt->execute()) {
            $message = 'Product added successfully.';
        } else {
            $message = 'Could not save the product. Please try again.';
        }
        $stmt->close();
    }
}
$products = $conn->query('SELECT id, name, price FROM products ORDER BY id DESC');
?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Manage Products | Raashid Shop</title><link rel="stylesheet" href="style.css"></head>
<body>
<header class="topbar"><a class="logo" href="index.php">Raashid<span>Shop</span></a><nav><a href="index.php">View shop</a></nav></header>
<main class="admin-wrap">
  <p class="eyebrow">STORE ADMIN</p><h1>Manage products</h1>
  <p class="muted">Use this local admin page to add products to your MySQL database.</p>
  <?php if ($message): ?><p class="notice"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
  <form class="admin-form" method="post">
    <label>Product name<input name="name" required maxlength="150" placeholder="e.g. Wireless Headphones"></label>
    <label>Description<textarea name="description" rows="3" placeholder="Short product description"></textarea></label>
    <label>Price (USD)<input name="price" type="number" min="0" step="0.01" required placeholder="25.00"></label>
    <label>Image URL (optional)<input name="image_url" type="url" placeholder="https://example.com/image.jpg"></label>
    <button class="button" type="submit">Add product</button>
  </form>
  <h2>Current products</h2>
  <div class="table-wrap"><table><thead><tr><th>Name</th><th>Price</th></tr></thead><tbody>
  <?php if ($products && $products->num_rows): while ($p = $products->fetch_assoc()): ?>
    <tr><td><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></td><td>$<?= number_format((float)$p['price'], 2) ?></td></tr>
  <?php endwhile; else: ?><tr><td colspan="2">No products added yet.</td></tr><?php endif; ?>
  </tbody></table></div>
</main>
<footer><p>Raashid Shop · Local admin demo</p></footer>
</body></html>
