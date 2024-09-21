<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard breadcrumb
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Dashboard', route('dashboard'));
});
// fitur keuangan masjid
Breadcrumbs::for('keuangan', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Keuangan', route('keuangan'));
});
// create kuangan
Breadcrumbs::for('create_keuangan', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Keuangan', route('keuangan'));
    $trail->push('Create', route('create_dataKeuangan'));
});
// edit keuangan
Breadcrumbs::for('edit_keuangan', function ($trail , $id) {
    $trail->push('Admin');
    $trail->push('Keuangan', route('keuangan'));
    $trail->push('Edit', route('edit_dataKeuangan', $id));
});
// fitur GAS
Breadcrumbs::for('GAS', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('GAS (Gerakan Amal Sholeh)', route('gas'));
});
// create program gas
Breadcrumbs::for('create_program', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('GAS (Gerakan Amal Sholeh)', route('gas'));
    $trail->push('Create', route('create_program'));
});
// edit program gas
Breadcrumbs::for('edit_program', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('GAS (Gerakan Amal Sholeh)', route('gas'));
    $trail->push('Edit', route('edit_program', $id));
});
// view program gas
Breadcrumbs::for('view_program', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('GAS (Gerakan Amal Sholeh)', route('gas'));
    $trail->push('View Program', route('view_program', $id));
});
// create jamaah
Breadcrumbs::for('create_jamaah', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('GAS (Gerakan Amal Sholeh)', route('gas'));
    $trail->push('View Program', route('view_program', $id));
    $trail->push('Create', route('create_jamaah', $id));
});
// edit jamaah
Breadcrumbs::for('edit_jamaah', function ($trail, $id, $idJamaah) {
    $trail->push('Admin');
    $trail->push('GAS (Gerakan Amal Sholeh)', route('gas'));
    $trail->push('View Program', route('view_program', $id));
    $trail->push('Edit', route('edit_jamaah', ['id' => $id, 'idJamaah' => $idJamaah]));
});
// index zakat
Breadcrumbs::for('zakat', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Zakat Fitra', route('zakat'));
});
// create data program zakat
Breadcrumbs::for('create_zakat', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Zakat Fitra', route('zakat'));
    $trail->push('Create', route('create_zakat'));
});
// edit program zakat
Breadcrumbs::for('edit_zakat', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('Zakat Fitra', route('zakat'));
    $trail->push('Edit', route('edit_zakat', $id));
});
// view salur zakat
Breadcrumbs::for('view_zakat', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('Zakat Fitra', route('zakat'));
    $trail->push('View Zakat', route('view_zakat', $id));
});
// create data muzakki
Breadcrumbs::for('create_muzakki', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('Zakat Fitra', route('zakat'));
    $trail->push('View Zakat', route('view_zakat', $id));
    $trail->push('Create Muzakki', route('create_muzakki', $id));
});
// edit data muzakki
Breadcrumbs::for('edit_muzakki', function ($trail, $id, $idMuzakki) {
    $trail->push('Admin');
    $trail->push('Zakat Fitra', route('zakat'));
    $trail->push('View Zakat', route('view_zakat', $id));
    $trail->push('Edit Muzakki', route('edit_muzakki', ['id' => $id, 'idMuzakki' => $idMuzakki]));
});
// salur zakat
Breadcrumbs::for('salur_zakat', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('Zakat Fitra', route('zakat'));
    $trail->push('View Zakat', route('view_zakat', $id));
    $trail->push('Salur Zakat', route('salur_zakat', $id));
});
// create data mustahik
Breadcrumbs::for('create_mustahik', function ($trail, $id,) {
    $trail->push('Admin');
    $trail->push('Zakat Fitra', route('zakat'));
    $trail->push('View Zakat', route('view_zakat', $id));
    $trail->push('Salur Zakat', route('salur_zakat', $id));
    $trail->push('Create Mustahik', route('create_mustahik', $id));
});
// edit data mustahik
Breadcrumbs::for('edit_mustahik', function ($trail, $id, $idMustahik) {
    $trail->push('Admin');
    $trail->push('Zakat fitra', route('zakat'));
    $trail->push('View Zakat', route('view_zakat', $id));
    $trail->push('Salur Zakat', route('salur_zakat', $id));
    $trail->push('Edit Mustahik', route('edit_mustahik', ['id' => $id, 'idMustahik' => $idMustahik]));
});
// fitur qurban
Breadcrumbs::for('qurban', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Qurban', route('qurban'));
});
// create program qurban
Breadcrumbs::for('create_qurban', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Qurban', route('qurban'));
    $trail->push('Create', route('create_qurban'));
});
// edit program with form edit
Breadcrumbs::for('edit_qurban', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('Qurban', route('qurban'));
    $trail->push('Edit', route('edit_qurban', $id));
});
// view qurban
Breadcrumbs::for('view_qurban', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('Qurban', route('qurban'));
    $trail->push('View Qurban ', route('view_qurban', $id));
});
// create shohibul
Breadcrumbs::for('create_shohibul', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('Qurban', route('qurban'));
    $trail->push('View Qurban ', route('view_qurban', $id));
    $trail->push('Create Shohibul ', route('create_shohibul', $id));
});
// edit qurban form
Breadcrumbs::for('edit_shohibul', function ($trail, $id, $idShohibul) {
    $trail->push('Admin');
    $trail->push('Qurban', route('qurban'));
    $trail->push('View Qurban ', route('view_qurban', $id));
    $trail->push('Edit Shohibul ', route('edit_shohibul', ['id'=> $id, 'idShohibul' => $idShohibul]));
});
// pengurutan Qurban
Breadcrumbs::for('pengurutan_qurban', function ($trail, $id) {
    $trail->push('Admin');
    $trail->push('Qurban', route('qurban'));
    $trail->push('View Qurban ', route('view_qurban', $id));
    $trail->push('Pengurutan Shohibul ', route('pengurutan_shohibul', $id));
});
// setting  
Breadcrumbs::for('setting', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Setting', route('setting'));
});
Breadcrumbs::for('setting_profile', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Setting', route('setting'));
    $trail->push('Profile', route('setting_profile'));
});
Breadcrumbs::for('setting_password', function (BreadcrumbTrail $trail) {
    $trail->push('Admin');
    $trail->push('Setting', route('setting'));
    $trail->push('Password', route('setting_password'));
});