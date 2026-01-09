<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
   
          function ganti()
{     var lprn= document.forms['form1']['lprn'].value;  
if(lprn=="Manual"){
	window.location.href="index1.php?p=mutasi_kain_masuk";
	}

}
function myFungsi() {
                var no_mutasi= document.forms['form1']['no_mutasi'].value;
				
                if(no_mutasi==null || no_mutasi=="")
                    {
                        alert("No Mutasi Belum di Input!!!");
                        return false;
                    }
					
					        }
           </script> 
           </script>
</head>

<body>
<form name="form1" action="pages/lihat_data_mutasi_kain_masuk_online.php" method="post" onsubmit="return myFungsi()">
<table width="100%" border="0">
  <tr>
    <th colspan="3" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="3" scope="row">Mutasi Kain Masuk Online</th>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row" align="right">Masuk</th>
    <td>:</td>
    <td><label for="select"></label>
      <select name="lprn" onchange="ganti()">
        <option value="Online" selected="selected" >Online</option>
        <option value="Manual">Manual</option>
      </select></td>
  </tr>
  <tr>
    <th width="29%" scope="row" align="right">No Mutasi Masuk</th>
    <td width="1%">:</td>
    <td width="70%"><label for="no_mutasi"></label>
      <input type="text" name="no_mutasi" id="no_mutasi" />
      <input type="submit" name="button" id="button" value="Lihat Data" /></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <th scope="row">&nbsp;</th>
    <th scope="row">&nbsp;</th>
  </tr>
</table>
</form>
</body>
</html>