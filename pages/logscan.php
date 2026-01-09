<?php
include("../koneksi.php");
ini_set("error_reporting",1);
//--
$idkk=$_GET['nokk'];

//-
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.rol{
    width: 100%;
    height: 400px;
    overflow: scroll;
} 
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detail Masuk Kain Jadi</title>
</head>

<body>
<div class="rol">
  <table width="100%" border="0">
                  <tr>
                    <td><span class="boldCD6">DATA LOG SCAN IN/OUT KARTU KERJA</span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="normal9black"><?php
$sql="select
			x.SONumber,x.TglSO,x.PONumber,x.DocumentNo,x.Quantity,udq.UnitName,x.PCBID,x.PCID,x.NoKK,x.LotNo,x.TglKK,x.Bruto, 
			udw.UnitName as WeightUnitName, x.ChildLevel,x.RootID,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK,convert(char(10),pcb.Dated,103) as TglKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where pcb.DocumentNo='$idkk'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID desc, x.PCBID";
				 //--lot
$qry=sqlsrv_query($conn,$sql);
$row=sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC);

		$child=$row['ChildLevel'];
		
		if($child > 0){
			$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='".$row['RootID']."' and ChildLevel='0'");
			$rowgp=sqlsrv_fetch_array($sqlgetparent, SQLSRV_FETCH_ASSOC);
			
			//$nomLot=substr("$row2[LotNo]",0,1);
			$nomLot=$rowgp['LotNo'];
			$nomorLot="$nomLot/K".$row['ChildLevel']."&nbsp;";				
								
		}else{
			$nomorLot=$row['LotNo'];
				
		}
					
			$sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='".$row['PCID']."' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn,$sqlLot) 
								or die('A error occured : ');
								
					  	$rowLot=sqlsrv_fetch_array($qryLot, SQLSRV_FETCH_ASSOC);	
						 $lotnya="".$rowLot['TotalLot']."-$nomorLot";
					  
					
					  //--

echo "<table>";
echo "<tr><td>No Kartu Kerja / Lot </td><td>: ".$row['NoKK']." / $lotnya </td></tr>";
echo "<tr><td>Kode Produk </td><td>: ".$row['ProductNumber']." </td></tr>";
echo "<tr><td>Warna </td><td>: ".$row['Color']." </td></tr>";
echo "<tr><td>No Order </td><td>: ".$row['DocumentNo']." </td></tr>";
echo"</table>";
echo "<hr>";		
     echo " <table width='95%' border='0'>";
      echo "  <tr>";
	  echo "   <td class='tombol'><div align='center'>No. </div></td>";
	 
	  echo "   <td class='tombol'><div align='center'>Tanggal Jam </div></td>";
	  echo "   <td class='tombol'><div align='center'>Status </div></td>";
       
	   echo "   <td class='tombol'><div align='center'>IN Dept </div></td>";
          echo "<td class='tombol'><div align='center'>OUT ke Dept</div></td>";
		  
        echo "</tr>";
		
		
//--
				
$sql2="select convert(char(10),p.Dated,103) as Tgl,convert(char(10),p.Dated,108) as Jam,p.PCBID,p.Status,d.DepartmentName as DepIn,d2.DepartmentName as DepOut from PCCardPosition p left join 
Departments d on d.ID=p.DepartmentID left join
Departments d2 on d2.ID=p.CounterDepartmentID
where p.PCBID='".$row['PCBID']."'
order by p.ID";
//order by p.Dated,d.DepIn,p.Status desc";

$sql2b = sqlsrv_query($conn,$sql2) or die('A error occured : ');
		//--
		$c=0;
		while ($row2=sqlsrv_fetch_array($sql2b, SQLSRV_FETCH_ASSOC)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
			
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "   <td class='normal333'  valign=top>$c</td>";

	  echo "   <td class='normal333'  valign=top>".$row2['Tgl']."_".$row2['Jam']."</td>";
	  
	  if ($row2['Status']==1){
	  	$stat="IN";
	  }else{
	  	$stat="OUT";
	  }
		echo "<td class='normal333'  valign=top>$stat</td>";
		
	//	echo "<td width='120' class='normal333'  valign=top><a href='order.php?bin=$row2[DocumentNo]' target=_blank>$row2[DocumentNo]</a></td>";
          
		 
		  echo "<td class='normal333' valign=top>".$row2['DepIn']."</td>";
		  echo "<td class='normal333' valign=top>".$row2['DepOut']."</td>";
        echo "</tr>";
        
		}
		
		//echo "<tr><td>$c</td><td></td><td></td><td></td><td>---</td></tr>";
     echo "</table>";
	

	//--
	//mssql_free_result($sql);
	//mssql_close($conn);
	//--
?></td>
                  </tr>
                  <tr>
                    <td class="normal9black">&nbsp;</td>
                  </tr>
              </table>
</div>
</body>
</html>