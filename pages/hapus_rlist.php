<h1>HAPUS PACKING LIST</h1>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmbb" target="_self">
<table width="100%" border="0">
  <tr>
    <td width="12%">No List</td>
    <td width="1%">:</td>
    <td width="87%" align="left"><?php echo $_GET['nolist'];?></td>
  </tr>
  <tr>
    <td height="16">Nokk</td>
    <td>:</td>
    <td align="left"><?php echo $_GET['nokk'];?></td>
  </tr>
  <tr>
    <td colspan="3"><label for="bs"></label></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><table width="46%" border="0" cellpadding="2" cellspacing="3">
      <tr bgcolor="#9966CC">
        <th width="9%" scope="row">NO</th>
        <th width="11%">Netto</th>
        <th width="9%">Yard</th>
        <th width="9%">Roll</th>
        <th width="14%">Satuan</th>
        <th width="8%">Ket</th>
        <th width="40%"><a href="?p=hapus_smlist&dono=<?php echo $_GET['dono'];?>&nolist=<?php echo $_GET['nolist']; ?>&nokk=<?php echo $_GET['nokk']; ?>&nosj=<?php echo $_GET['nosj'];?>">Hapus-Semua</a></th>
      </tr>
      <?php $myqry=mysqli_query($con,"SELECT
	detail_pergerakan_stok.id,weight,yard_,no_roll,satuan,grade,sisa
FROM
	packing_list
LEFT JOIN detail_pergerakan_stok ON packing_list.listno = detail_pergerakan_stok.refno
WHERE
	packing_list.listno = '".$_GET['nolist']."' and detail_pergerakan_stok.nokk='".$_GET['nokk']."'
ORDER BY no_roll ASC");
$c=1;
$n=1;
while($rl=mysqli_fetch_array($myqry)){ $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';?>
      <tr bgcolor="<?Php echo $bgcolor;?>"> 
        <th scope="row"><?php echo $n;?></th>
        <td><?php echo $rl['weight'];?></td>
        <td><?php echo $rl['yard_'];?></td>
        <td><?php echo $rl['no_roll'];?></td>
        <td><?php echo $rl['satuan'];?></td>
        <td><?php echo $rl['ket'];?></td>
        <td align="center"><a href="?p=hapus_slist&id=<?php echo $rl['id'];?>&dono=<?php echo $_GET['dono'];?>&nolist=<?php echo $_GET['nolist']; ?>&nokk=<?php echo $_GET['nokk']; ?>&nosj=<?php echo $_GET['nosj'];?>">Hapus</a></td>
      </tr>
      <?php $n++; }?>
    </table></td>
  </tr>
                </table>
</form>