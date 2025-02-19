<form action="<?= base_url('siswa/simpan') ?>"  method="post" >

    <label>NISN</label>
    <input type="text" name="nisn" class="form-control" required>

    <label>Nama Siswa</label>
    <input type="text" name="nama_siswa" class="form-control" required>

    <label for="kelas">Pilih Kelas</label>
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
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>


    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control">

    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>
