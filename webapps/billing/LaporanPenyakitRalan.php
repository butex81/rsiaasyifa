<?php
 include '../conf/conf.php';
    
?>
<html>
    <body>

    <?php
    reportsqlinjection();      
        $tanggal1      = $_GET['tanggal1']; 
        $tanggal2      = $_GET['tanggal2']; 

        $_sql = "select * from temporary";            
        $hasil=bukaquery($_sql);
        
        if(mysql_num_rows($hasil)!=0) { 
          echo "<table width='100%'  border='1' align='left' cellpadding='0' cellspacing='0' class='tbl_form'>
                 <caption><br/><center><font color='000000' size='4' face='Arial'>Laporan RL 53 10 Besar Penyakit Rawat jalan<br> Periode $tanggal1 s.d. $tanggal2 </font></center><br/></caption>
                 <tr class=isi15>
                    <td width='5%' align=center rowspan=2>No.Urut</td>
                    <td width='20%' align=center rowspan=2>Kode ICD 10</td>
                    <td width='15%' align=center rowspan=2>Deskripsi</td>
                    <td width='25%' align=center colspan=2>Pasien Keluar Hidup Menurut Jenis Kelamin</td>
                    <td width='25%' align=center colspan=2>Pasien Keluar Mati Menurut Jenis Kelamin</td>
                    <td width='10%' align=center rowspan=2>Jumlah</td>
                 </tr>
                 <tr class=isi15>
                    <td align=center>Laki-Laki</td>
                    <td align=center>Perempuan</td>
                    <td align=center>Laki-Laki</td>
                    <td align=center>Perempuan</td>
                 </tr>";
                 $i=1;
                 while($baris = mysql_fetch_array($hasil)) { 
					 echo "<tr>
					         <td>$i</td>
					         <td>$baris[1] &nbsp;</td>
					         <td>$baris[2] &nbsp;</td>
					         <td>$baris[4] &nbsp;</td>
					         <td>$baris[5] &nbsp;</td>
					         <td>$baris[6] &nbsp;</td>
					         <td>$baris[7] &nbsp;</td>
					         <td>$baris[8] &nbsp;</td>
					       </tr>";$i++;
                 }    
                 echo "</table>";            
        } else {echo "<b>Data masih kosong !</b>";}
    ?>

    </body>
</html>
