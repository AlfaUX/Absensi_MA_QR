<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Edit Siswa</h2>

<form method="post" action="<?= base_url('data_siswa/edit/'.$siswa['id_siswa']) ?>">
    <label>NISN</label>
    <input type="text" name="nis" class="form-control" value="<?= $siswa['nisn'] ?>" required>

    <label>Nama Siswa</label>
    <input type="text" name="nama_siswa" class="form-control" value="<?= $siswa['nama_siswa'] ?>" required>

    <label>Kelas</label>
    <select name="id_kelas" required>
        <option value="">Pilih Kelas</option>
        <?php foreach ($kelas as $row): ?>
            <option value="<?= $row['id_kelas']; ?>">
                <?= $row['kelas']; ?>
            </option>
        <?php endforeach; ?>
    </select>


    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-control" required>
        <option value="Laki-laki" <?= ($siswa['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
        <option value="Perempuan" <?= ($siswa['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
    </select>

    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control" value="<?= $siswa['no_hp'] ?>">

    <button type="submit" class="btn btn-warning mt-3">Update</button>
</form>

<?= $this->endSection() ?>
