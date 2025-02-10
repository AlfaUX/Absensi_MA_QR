<h1>Edit Data Siswa</h1>
<form action="<?= base_url('siswa/update') ?>" method="post">
    <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
    <input type="text" name="nama" value="<?= $siswa['nama'] ?>" required><br>
    <input type="text" name="kelas" value="<?= $siswa['kelas'] ?>" required><br>
    <input type="email" name="email" value="<?= $siswa['email'] ?>"><br>
    <input type="text" name="nisn" value="<?= $siswa['nisn'] ?>" required><br>
    <input type="text" name="nis" value="<?= $siswa['nis'] ?>" required><br>
    <button type="submit">Update</button>
</form>
