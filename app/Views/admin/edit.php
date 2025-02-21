<h2>Edit Admin</h2>

<form action="<?= site_url('admin/update/' . $admin['id_admin']) ?>" method="post">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $admin['nama'] ?>" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= $admin['username'] ?>" required><br><br>

    <label>Password (kosongkan jika tidak diubah):</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Update</button>
    <a href="<?= site_url('admin/index') ?>">Kembali</a>
</form>
