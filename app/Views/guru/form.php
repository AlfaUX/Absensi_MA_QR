<form action="<?= isset($admin) ? base_url('/admin/update/'.$admin['id']) : base_url('/admin/store') ?>" method="post">
    <label>Username:</label>
    <input type="text" name="username" value="<?= isset($admin) ? $admin['username'] : '' ?>" required><br>

    <label>Password:</label>
    <input type="password" name="password" <?= isset($admin) ? '' : 'required' ?>><br>

    <button type="submit"><?= isset($admin) ? 'Update' : 'Create' ?></button>
</form>
