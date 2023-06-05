<?php
require('fpdf/fpdf.php');

// Create a new PDF instance with landscape orientation
$pdf = new FPDF('L');
$pdf->AddPage();

// Set font settings
$pdf->SetFont('Arial', 'B', 14);

// Add a title
$pdf->Cell(0, 10, 'Data Siswa', 0, 1, 'C');
$pdf->Ln(10);

// Set font settings for table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'Foto', 1, 0, 'C');
$pdf->Cell(30, 10, 'NIS', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(40, 10, 'Jenis Kelamin', 1, 0, 'C');
$pdf->Cell(40, 10, 'Telepon', 1, 0, 'C');
$pdf->Cell(65, 10, 'Alamat', 1, 1, 'C');

// Set font settings for table content
$pdf->SetFont('Arial', '', 12);

// Load file koneksi.php
include "koneksi.php";

// Fetch student data from the database
$sql = $pdo->prepare("SELECT * FROM siswa");
$sql->execute();

// Iterate through the student data and add rows to the PDF table
while ($data = $sql->fetch()) {
    

    // Get the image file path
    $imagePath = 'images/' . $data['foto'];
    // Check if the image file exists
    if (file_exists($imagePath)) {
        // Get the image dimensions
        list($width, $height) = getimagesize($imagePath);

        // Calculate the aspect ratio to fit the image within the cell
        $aspectRatio = $width / $height;

        // Calculate the maximum width and height of the image within the cell
        $maxWidth = 50;
        $maxHeight = 50 / $aspectRatio;

        // Save the current position
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        // Add the image to the cell
        $pdf->Cell(50, 50, '', 1, 0, 'C'); // Empty cell for foto
        $pdf->Image($imagePath, $x + 5, $y + 5, 40, 40); // Add the photo to the cell

        // Move the position to the right of the image
        $pdf->SetXY($x + $maxWidth, $y);
    } else {
        // If the image file doesn't exist, display alternative text
        $pdf->Cell(40, 50, 'Gambar Tidak Ditemukan', 1, 0, 'C');
    }

    $pdf->Cell(30, 50, $data['nis'], 1, 0, 'C');
    $pdf->Cell(50, 50, $data['nama'], 1, 0, 'C');
    $pdf->Cell(40, 50, $data['jenis_kelamin'], 1, 0, 'C');
    $pdf->Cell(40, 50, $data['telp'], 1, 0, 'C');
    $pdf->MultiCell(65, 50, $data['alamat'], 1, 'C');
}

// Output the PDF
$pdf->Output();