<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<?= $this->include('admin/account/sections/styles'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?= $this->include('admin/account/sections/content'); ?>
<?= $this->endSection(); ?>

<?= $this->section('modals'); ?>
<?= $this->include('admin/account/sections/modals'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<?= $this->include('admin/account/sections/scripts'); ?>
<?= $this->endSection(); ?>