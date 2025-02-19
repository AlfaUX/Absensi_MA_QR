<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Guru</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('guru/simpan') ?>" method="post">
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email (Opsional):</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>NUPTK:</label>
                    <input type="text" name="nuptk" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="sumbit">Kembali</button>
            </form>
        </div>
    </section>
</div>
