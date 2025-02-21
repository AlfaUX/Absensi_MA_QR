<h2>Tambah Admin</h2>

<form action="<?= site_url('admin/store') ?>" method="post">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= site_url('admin/index') ?>">Kembali</a>
</form>
