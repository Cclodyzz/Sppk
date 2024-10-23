<?php
session_start();
require 'config/config.php';
require 'classes/Penyiar.php';
require 'classes/Penilaian.php';
require 'assets/fpdf/fpdf.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Generate PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Laporan Penilaian Penyiar', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$penyiarModel = new Penyiar($conn);
$bestPenyiar = $penyiarModel->getBestPenyiar();

$pdf->Cell(0, 10, 'Penyiar Terbaik: ' . $bestPenyiar['nama'], 0, 1);
$pdf->Cell(0, 10, 'Rata-rata Kualitas Suara: ' . round($bestPenyiar['avg_kualitas'], 2), 0, 1);
$pdf->Cell(0, 10, 'Rata-rata Keterampilan Komunikasi: ' . round($bestPenyiar['avg_komunikasi'], 2), 0, 1);
$pdf->Cell(0, 10, 'Rata-rata Penguasaan Materi: ' . round($bestPenyiar['avg_materi'], 2), 0, 1);
$pdf->Cell(0, 10, 'Rata-rata Kreatifitas: ' . round($bestPenyiar['avg_kreatifitas'], 2), 0, 1);
$pdf->Cell(0, 10, 'Rata-rata Engagement: ' . round($bestPenyiar['avg_engagement'], 2), 0, 1);

$pdf->Output();
