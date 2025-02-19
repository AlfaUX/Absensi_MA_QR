<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2>Tambah Data Siswa</h2>

    <form action="<?= base_url('siswa/simpan') ?>" method="post">
        <?= csrf_field(); ?>
        
        <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>NISN</label>
            <input type="text" name="nisn" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control" required>
                <option value="">Pilih Kelas</option>
                <?php foreach ($kelas as $k) : ?>
                    <option value="<?= $k['id_kelas'] ?>"><?= $k['kelas'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>
