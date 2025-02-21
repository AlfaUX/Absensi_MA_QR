<h2>Daftar Admin</h2>
<a href="<?= base_url('/admin/create') ?>">Tambah Admin</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($admins as $admin): ?>
    <tr>
        <td><?= $admin['id']; ?></td>
        <td><?= $admin['username']; ?></td>
        <td>
            <a href="<?= base_url('/admin/edit/'.$admin['id']); ?>">Edit</a> |
            <a href="<?= base_url('/admin/delete/'.$admin['id']); ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php if(session()->getFlashdata('message')): ?>
    <p><?= session()->getFlashdata('message'); ?></p>
<?php endif; ?>
