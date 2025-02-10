<h1>Edit Data Guru</h1>

<form action="<?= base_url('guru/update') ?>" method="post">
    <input type="hidden" name="id" value="<?= esc($guru['id']) ?>">

    <label for="nama">Nama Guru:</label>
    <input type="text" id="nama" name="nama" value="<?= esc($guru['nama']) ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= esc($guru['email']) ?>"><br>

    <label for="nuptk">NUPTK:</label>
    <input type="text" id="nuptk" name="nuptk" value="<?= esc($guru['nuptk']) ?>" required><br>

    <button type="submit">Update</button>
</form>
