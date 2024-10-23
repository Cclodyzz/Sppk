<?php
session_start();
require 'config/config.php';
require 'classes/User.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Tampilkan konten
echo "<h1>Selamat Datang di Sistem Penilaian Penyiar</h1>";
echo "<a href='penilaian.php'>Berikan Penilaian</a><br>";
echo "<a href='laporan.php'>Lihat Laporan</a><br>";
echo "<a href='logout.php'>Logout</a>";
