<?php
require "koneksi.php";

// Ambil semua postingan dengan nama pengarang
$query = "SELECT posts.id, posts.title, posts.create_at, users.fullname 
          FROM posts 
          JOIN users ON posts.user_id = users.id 
          ORDER BY posts.create_at DESC";

$result = mysqli_query($conn, $query);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Sederhana</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../../index.php">Post</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->

<!-- Konten -->
<div class="container mt-5 pt-5">
  <h1 class="mb-3">Posts</h1>
  <a href="tambah.php" class="btn btn-primary mb-3">Tambah Post</a>

  <table class="table table-striped table-bordered">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars($row['fullname']) ?></td>
          <td><?= $row['create_at'] ?></td>
          <td>
            <a href="detail.php?post_id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Detail</a>
            <form action="hapus_proses.php" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
           <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
          </form>

        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
