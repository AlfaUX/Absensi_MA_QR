<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Edit Absensi</h2>
    <form action="<?= base_url('absensi/update') ?>" method="POST">
        <input type="hidden" name="id_absensi" value="<?= $absensi['id_absensi'] ?>">

        <div class="mb-3">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" class="form-control" id="nisn" value="<?= esc($absensi['nisn']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="nama" value="<?= esc($absensi['nama_siswa']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="id_keterangan" class="form-label">Keterangan</label>
            <select name="id_keterangan" id="id_keterangan" class="form-control">
                <?php foreach ($keterangan as $ket): ?>
                    <option value="<?= $ket['id'] ?>" <?= $ket['id'] == $absensi['id_keterangan'] ? 'selected' : '' ?>>
                        <?= esc($ket['keterangan']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= base_url('absensi') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>
