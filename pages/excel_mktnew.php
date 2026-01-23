<?php
// Load file koneksi.php
include "../koneksi.php";
ini_set("error_reporting",1);
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Panggil class PhpSpreadsheet nya
$spreadsheet = new Spreadsheet();
// Settingan awal file excel
$spreadsheet->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Laporan Pengiriman1")
             ->setSubject("Laporan Pengiriman2")
             ->setDescription("Laporan Pengiriman3")
             ->setKeywords("Laporan Pengiriman4");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = [
    'font' => [
        'bold' => true, // Set font nya jadi bold
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ],
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border top dengan garis tipis
        ],
        'right' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border right dengan garis tipis
        ],
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border bottom dengan garis tipis
        ],
        'left' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border left dengan garis tipis
        ]
    ]
];

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = [
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ],
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border top dengan garis tipis
        ],
        'right' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border right dengan garis tipis
        ],
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border bottom dengan garis tipis
        ],
        'left' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border left dengan garis tipis
        ]
    ]
];

// Buat sebuah variabel untuk menampung pengaturan style dengan memberi warna background dari isi tabel sesuai kondisi
$style_row_color = [
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ],
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border top dengan garis tipis
        ],
        'right' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border right dengan garis tipis
        ],
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border bottom dengan garis tipis
        ],
        'left' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, // Set border left dengan garis tipis
        ]
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'FF962C',
        ]
    ]
];
//Insert Gambar 1
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing();
$gdImage = imagecreatefromjpeg('../images/Kop_ITTI.jpg');
$drawing->setName('Sample image');
$drawing->setDescription('Sample image');
$drawing->setImageResource($gdImage);
$drawing->setCoordinates('A1');
$drawing->setHeight(120);
$drawing->setRenderingFunction(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_JPEG);
$drawing->setMimeType(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_DEFAULT);
$drawing->setWorksheet($spreadsheet->getActiveSheet());

//Insert Gambar 2
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
$drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing();
$gdImage2 = imagecreatefromjpeg('../images/Kop_ITTI_2.jpg');
$drawing2->setName('Sample image');
$drawing2->setDescription('Sample image');
$drawing2->setImageResource($gdImage2);
$drawing2->setCoordinates('L1');
$drawing2->setHeight(80);
$drawing2->setRenderingFunction(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_JPEG);
$drawing2->setMimeType(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_DEFAULT);
$drawing2->setWorksheet($spreadsheet->getActiveSheet());

  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A7', "LAPORAN PENGIRIMAN"); // Set kolom A7 dengan tulisan "LAPORAN PENGIRIMAN"
  $spreadsheet->getActiveSheet()->mergeCells('A7:O7'); // Set Merge Cell pada kolom A7 sampai O7
  $spreadsheet->getActiveSheet()->getStyle('A7')->getFont()->setBold(TRUE); // Set bold kolom A7
  $spreadsheet->getActiveSheet()->getStyle('A7')->getFont()->setSize(15); // Set font size 15 untuk kolom A7
  $spreadsheet->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A7

  // Buat header tabel nya pada baris ke 3
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('A9', "NO"); // Set kolom A9 dengan tulisan "NO"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('B9', "TANGGAL BUAT"); // Set kolom B9 dengan tulisan "TANGGAL BUAT"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('C9', "TANGGAL KIRIM"); // Set kolom C9 dengan tulisan "TANGGAL KIRIM"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('D9', "NO SJ"); // Set kolom D9 dengan tulisan "NO SJ"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('E9', "WARNA"); // Set kolom E9 dengan tulisan "WARNA"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('F9', "ROLL"); // Set kolom F9 dengan tulisan "ROLL"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('G9', "QUANTITY (KG)"); // Set kolom G9 dengan tulisan "QUANTITY (KG)"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('H9', "YARD/METER"); // Set kolom H9 dengan tulisan "YARD/METER"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('I9', "BUYER"); // Set kolom I9 dengan tulisan "BUYER"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('J9', "NO PO"); // Set kolom J9 dengan tulisan "NO PO"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('K9', "NO ORDER"); // Set kolom K9 dengan tulisan "NO ORDER"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('L9', "NO ITEM"); // Set kolom L9 dengan tulisan "NO ITEM"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('M9', "JENIS KAIN"); // Set kolom M9 dengan tulisan "JENIS KAIN"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('N9', "LOT"); // Set kolom N9 dengan tulisan "LOT"
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('O9', "FOC"); // Set kolom O9 dengan tulisan "FOC"

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $spreadsheet->getActiveSheet()->getStyle('A9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('B9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('C9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('D9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('E9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('F9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('G9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('H9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('I9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('J9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('K9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('L9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('M9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('N9')->applyFromArray($style_col);
    $spreadsheet->getActiveSheet()->getStyle('O9')->applyFromArray($style_col);
    // Set height baris ke 1, 2 dan 3
    $spreadsheet->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
    $spreadsheet->getActiveSheet()->getRowDimension('8')->setRowHeight(20);
    $spreadsheet->getActiveSheet()->getRowDimension('9')->setRowHeight(20);

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
      $sql=sqlsrv_query($con,"SELECT
      id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,panjang,buyer,no_po,no_order,no_item,jenis_kain,lot,tujuan,ket,foc,approve_acc
  FROM
      tbl_pengiriman
  WHERE
      not no_sj='' AND ISNULL(kategori) AND $tgll $sj $buyer
  ORDER BY no_sj asc");
//$sql->execute(); // Eksekusi querynya
$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 10; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data=sqlsrv_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['tgl_buat']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['tgl_kirim']);
  
  // Khusus untuk no sj. kita set type kolom nya jadi STRING
  $spreadsheet->setActiveSheetIndex(0)->setCellValueExplicit('D'.$numrow, $data['no_sj'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
  
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['warna']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['rol']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['qty']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['panjang']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['buyer']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['no_po']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['no_order']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data['no_item']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data['jenis_kain']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data['lot']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data['foc']);

  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  if($data['approve_acc']=="Approve"){$style_baris=$style_row_color;}else{$style_baris=$style_row;}
  $spreadsheet->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_baris);
  $spreadsheet->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_baris);
  
  $spreadsheet->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
  
  $no++; // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping
  $row=$row+1;
  $totrol=$totrol+ $data['rol'];
  $totqty=$totqty+ $data['qty'];
  $totpjg=$totpjg+ $data['panjang'];

}
$total=$row+10;
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$total, "TOTAL");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$total, $totrol);
$spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$total, $totqty);
$spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$total, $totpjg);
$spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('J'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('K'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('L'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('M'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('N'.$total, "");
$spreadsheet->setActiveSheetIndex(0)->setCellValue('O'.$total, "");

$spreadsheet->getActiveSheet()->getStyle('A'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('B'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('C'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('D'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('E'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('F'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('G'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('H'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('I'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('J'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('K'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('L'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('M'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('N'.$total)->applyFromArray($style_row);
$spreadsheet->getActiveSheet()->getStyle('O'.$total)->applyFromArray($style_row);


// Set width kolom
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom F
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom G
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10); // Set width kolom H
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20); // Set width kolom I
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom J
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom K
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10); // Set width kolom L
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(20); // Set width kolom M
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10); // Set width kolom N
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(5); // Set width kolom O   
// Set orientasi kertas jadi LANDSCAPE
$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
// Set judul file excel nya
$spreadsheet->getActiveSheet(0)->setTitle("Laporan Pengiriman");
$spreadsheet->setActiveSheetIndex(0);
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=Lap-Pengiriman-".date($_GET['awal'])." s/d ".date($_GET['akhir']).".xls"); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$write->save('php://output');
?>