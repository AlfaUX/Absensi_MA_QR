<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2>Edit Data Siswa</h2>

    <form action="<?= base_url('siswa/update/' . $siswa['id_siswa']) ?>" method="post">
        <?= csrf_field(); ?>
        
        <div class="form-group">
            <label>NISN</label>
            <input type="text" name="nisn" class="form-control" value="<?= esc($siswa['nisn']) ?>" required>
        </div>

        <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="<?= esc($siswa['nama_siswa']) ?>" required>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control" required>
                <?php foreach ($kelas as $k) : ?>
                    <option value="<?= $k['id_kelas'] ?>" <?= ($k['id_kelas'] == $siswa['id_kelas']) ? 'selected' : '' ?>>
                        <?= $k['kelas'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="L" <?= ($siswa['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= ($siswa['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="<?= esc($siswa['no_hp']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('siswa') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>
