<?php
// Load file koneksi.php
include "../koneksi.php";
ini_set("error_reporting",1);
// Load plugin PHPExcel nya
require_once '../PHPExcel/Classes/PHPExcel.php';
// Panggil class PHPExcel nya
$excel = new PHPExcel();
// Settingan awal file excel
$excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Laporan Pengiriman1")
             ->setSubject("Laporan Pengiriman2")
             ->setDescription("Laporan Pengiriman3")
             ->setKeywords("Laporan Pengiriman4");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
    'font' => array('bold' => true), // Set font nya jadi bold
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
    'borders' => array(
      'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
      'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
      'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
      'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
  );

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
    'alignment' => array(
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
    'borders' => array(
      'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
      'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
      'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
      'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
  );

// Buat sebuah variabel untuk menampung pengaturan style dengan memberi warna background dari isi tabel sesuai kondisi
$style_row_color = array(
  'alignment' => array(
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  ),
  'fill' => array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID, // Set background color dengan type solid
    'color' => array('rgb' => 'FF962C') // Set warna background color
  )
  );

  //Insert Gambar 1
  $gdImage = imagecreatefromjpeg('../images/Kop_ITTI.jpg');
  // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
  $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
  $objDrawing->setName('Sample image');
  $objDrawing->setDescription('Sample image');
  $objDrawing->setImageResource($gdImage);
  $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
  $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
  $objDrawing->setHeight(120);
  $objDrawing->setCoordinates('A1');
  $objDrawing->setWorksheet($excel->getActiveSheet());

  //Insert Gambar 2
  $gdImage2 = imagecreatefromjpeg('../images/Kop_ITTI_2.jpg');
  // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
  $objDrawing2 = new PHPExcel_Worksheet_MemoryDrawing();
  $objDrawing2->setName('Sample image');
  $objDrawing2->setDescription('Sample image');
  $objDrawing2->setImageResource($gdImage2);
  $objDrawing2->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
  $objDrawing2->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
  $objDrawing2->setHeight(80);
  $objDrawing2->setCoordinates('L1');
  $objDrawing2->setWorksheet($excel->getActiveSheet());
  //$excel->getActiveSheet()->mergeCells('A1:D4'); // Set Merge Cell pada kolom A3 sampai O3

  $excel->setActiveSheetIndex(0)->setCellValue('A7', "LAPORAN PENGIRIMAN"); // Set kolom A7 dengan tulisan "LAPORAN PENGIRIMAN"
  $excel->getActiveSheet()->mergeCells('A7:O7'); // Set Merge Cell pada kolom A7 sampai O7
  $excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(TRUE); // Set bold kolom A7
  $excel->getActiveSheet()->getStyle('A7')->getFont()->setSize(15); // Set font size 15 untuk kolom A7
  $excel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A7

  // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A9', "NO"); // Set kolom A9 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('B9', "TANGGAL BUAT"); // Set kolom B9 dengan tulisan "TANGGAL BUAT"
    $excel->setActiveSheetIndex(0)->setCellValue('C9', "TANGGAL KIRIM"); // Set kolom C9 dengan tulisan "TANGGAL KIRIM"
    $excel->setActiveSheetIndex(0)->setCellValue('D9', "NO SJ"); // Set kolom D9 dengan tulisan "NO SJ"
    $excel->setActiveSheetIndex(0)->setCellValue('E9', "WARNA"); // Set kolom E9 dengan tulisan "WARNA"
    $excel->setActiveSheetIndex(0)->setCellValue('F9', "ROLL"); // Set kolom F9 dengan tulisan "ROLL"
    $excel->setActiveSheetIndex(0)->setCellValue('G9', "QUANTITY (KG)"); // Set kolom G9 dengan tulisan "QUANTITY (KG)"
    $excel->setActiveSheetIndex(0)->setCellValue('H9', "YARD/METER"); // Set kolom H9 dengan tulisan "YARD/METER"
    $excel->setActiveSheetIndex(0)->setCellValue('I9', "BUYER"); // Set kolom I9 dengan tulisan "BUYER"
    $excel->setActiveSheetIndex(0)->setCellValue('J9', "NO PO"); // Set kolom J9 dengan tulisan "NO PO"
    $excel->setActiveSheetIndex(0)->setCellValue('K9', "NO ORDER"); // Set kolom K9 dengan tulisan "NO ORDER"
    $excel->setActiveSheetIndex(0)->setCellValue('L9', "NO ITEM"); // Set kolom L9 dengan tulisan "NO ITEM"
    $excel->setActiveSheetIndex(0)->setCellValue('M9', "JENIS KAIN"); // Set kolom M9 dengan tulisan "JENIS KAIN"
    $excel->setActiveSheetIndex(0)->setCellValue('N9', "LOT"); // Set kolom N9 dengan tulisan "LOT"
    $excel->setActiveSheetIndex(0)->setCellValue('O9', "FOC"); // Set kolom O9 dengan tulisan "FOC"

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('I9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('J9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('K9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('L9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('M9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('N9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('O9')->applyFromArray($style_col);
    // Set height baris ke 1, 2 dan 3
    $excel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
    $excel->getActiveSheet()->getRowDimension('8')->setRowHeight(20);
    $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);

    // Buat query untuk menampilkan semua laporan
    if($_GET['awal']!="" AND $_GET['buyer']!=""){
        $tgll= " tmp_hapus='0' AND tgl_buat BETWEEN '".$_GET['awal']."' AND '".$_GET['akhir']."' AND buyer LIKE '%".$_GET['buyer']."%' ";
        }else if($_GET['awal']!=""){
        $tgll= " tmp_hapus='0' AND tgl_buat BETWEEN '".$_GET['awal']."' AND '".$_GET['akhir']."' ";
        }else{$tgll= " tmp_hapus='0' AND tgl_update!='' ";}	  
      if($_GET['no_sj']!=""){
        $sj= " AND no_sj='".$_GET['no_sj']."' ";
        }
      if($_POST['buyer']!=""){
        $buyer= " AND buyer LIKE '%".$_GET['buyer']."%' ";
      }	 
      $sql=mysqli_query($con,"SELECT
      id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,panjang,buyer,no_po,no_order,no_item,jenis_kain,lot,tujuan,ket,foc,approve_acc
  FROM
      tbl_pengiriman
  WHERE
      not no_sj='' AND ISNULL(kategori) AND $tgll $sj $buyer
  ORDER BY no_sj asc");
//$sql->execute(); // Eksekusi querynya
$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 10; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data=mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['tgl_buat']);
  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['tgl_kirim']);
  
  // Khusus untuk no sj. kita set type kolom nya jadi STRING
  $excel->setActiveSheetIndex(0)->setCellValueExplicit('D'.$numrow, $data['no_sj'], PHPExcel_Cell_DataType::TYPE_STRING);
  
  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['warna']);
  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['rol']);
  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['qty']);
  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['panjang']);
  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['buyer']);
  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['no_po']);
  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['no_order']);
  $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data['no_item']);
  $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data['jenis_kain']);
  $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data['lot']);
  $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data['foc']);

  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  if($data['approve_acc']=="Approve"){$style_baris=$style_row_color;}else{$style_baris=$style_row;}
  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_baris);
  $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_baris);
  
  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
  
  $no++; // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping
  $row=$row+1;
  $totrol=$totrol+ $data['rol'];
  $totqty=$totqty+ $data['qty'];
  $totpjg=$totpjg+ $data['panjang'];

}
$total=$row+10;
$excel->setActiveSheetIndex(0)->setCellValue('A'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('B'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('C'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('D'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('E'.$total, "TOTAL");
$excel->setActiveSheetIndex(0)->setCellValue('F'.$total, $totrol);
$excel->setActiveSheetIndex(0)->setCellValue('G'.$total, $totqty);
$excel->setActiveSheetIndex(0)->setCellValue('H'.$total, $totpjg);
$excel->setActiveSheetIndex(0)->setCellValue('I'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('J'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('K'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('L'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('M'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('N'.$total, "");
$excel->setActiveSheetIndex(0)->setCellValue('O'.$total, "");

$excel->getActiveSheet()->getStyle('A'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('B'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('C'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('D'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('E'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('F'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('G'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('H'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('I'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('J'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('K'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('L'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('M'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('N'.$total)->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('O'.$total)->applyFromArray($style_row);


// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom F
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom G
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10); // Set width kolom H
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20); // Set width kolom I
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom J
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom K
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10); // Set width kolom L
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(20); // Set width kolom M
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(10); // Set width kolom N
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(5); // Set width kolom O   
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Laporan Pengiriman");
$excel->setActiveSheetIndex(0);
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Lap-Pengiriman-".date($_GET['awal'])." s/d ".date($_GET['akhir']).".xls"); // Set nama file excel nya
header('Cache-Control: max-age=0');
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>