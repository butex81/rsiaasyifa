<?php
 include '../conf/conf.php';
?>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body bgcolor='#ffffff'>

    <?php
        $petugas = str_replace("_"," ",$_GET['petugas']); 
        $tanggal = str_replace("_"," ",$_GET['tanggal']); 
        reportsqlinjection();   
        $nonota= str_replace(": ","",getOne("select temp2 from temporary where temp1='No.Nota'"));
        $norawat=getOne("select no_rawat from nota_jalan where no_nota='$nonota'");
        $kodecarabayar=getOne("select kd_pj from reg_periksa where no_rawat='$norawat'");
        $carabayar=getOne("select png_jawab from penjab where kd_pj='$kodecarabayar'");
         
         
        $_sql = "select temp1, temp2, temp3, temp4, temp5, temp6, temp7, temp8, temp9, temp10, temp11, temp12, temp13, temp14 from temporary order by no asc";   
        $hasil=bukaquery($_sql);
        
        if(mysql_num_rows($hasil)!=0) { 
            $setting=  mysql_fetch_array(bukaquery("select nama_instansi,alamat_instansi,kabupaten,propinsi,kontak,email,logo from setting"));
            echo "   
            <table width='".getOne("select notaralan from set_nota")."' bgcolor='#ffffff' align='left' border='0' padding='0' class='tbl_form' cellspacing='0' cellpadding='0'>
            <tr class='isi12' padding='0'>
				<td colspan='7' padding='0'>
					   <table width='100%' bgcolor='#ffffff' align='left' border='0' class='tbl_form' cellspacing='0' cellpadding='0'>
							<tr>
								<td  width='20%'>
                                                                    <img width='45' height='45' src='data:image/jpeg;base64,". base64_encode($setting['logo']). "'/>
                                                                </td>
                                                                <td>
                                                                    <center>
                                                                        <font color='000000' size='3'  face='Tahoma'>".$setting["nama_instansi"]."</font><br>
                                                                        <font color='000000' size='1'  face='Tahoma'>
                                                                            ".$setting["alamat_instansi"].", ".$setting["kabupaten"].", ".$setting["propinsi"]."<br/>
                                                                            ".$setting["kontak"].", E-mail : ".$setting["email"]."
                                                                             <br>BILLING
                                                                        </font> 
                                                                    </center>
                                                                </td>
                                                                <td  width='20%'><font color='000000' size='2'  face='Tahoma' align='right'>$carabayar</font></td>
							</tr>
					  </table>
				</td>
            </tr>
            ";  $z=1;
                while($inapdrpasien = mysql_fetch_array($hasil)) {
                      echo "<tr class='isi12' padding='0'>
                                <td padding='0' width='30%'><font color='000000' size='1'  face='Tahoma'>".str_replace("  ","&nbsp;&nbsp;",$inapdrpasien[0])."</td> 
                                <td padding='0' width='40%' colspan='6'><font color='000000' size='1'  face='Tahoma'>$inapdrpasien[1]</td>              
                             </tr>";  
                   $z++;                                   
                }  
                 
                   
            echo "
                        <tr class='isi12' padding='0'>
			    <td colspan='7' padding='0'>
                                <table width='100%' bgcolor='#ffffff' align='left' border='0' padding='0' cellspacing='0' cellpadding='0'>
                                    <tr class='isi12' padding='0'>
                                     <td padding='0' width='50%' align=center><font color='000000' size='1'  face='Tahoma'>&nbsp;</td>   
                                     <td padding='0' width='50%' align='center'><font color='000000' size='1'  face='Tahoma'>".getOne("select kabupaten from setting").", ".$tanggal."</font></td>              
                                    </tr>  
                                    <tr class='isi12' padding='0'>
                                     <td padding='0' width='50%' align=center><font color='000000' size='1'  face='Tahoma'>Petugas</td> 
                                     <td padding='0' width='50%' align='center'><font color='000000' size='1'  face='Tahoma'>Penanggung Jawab Pasien</font></td>              
                                    </tr>  
                                    <tr class='isi12' padding='0'>
                                     <td padding='0' width='50%'><font color='000000' size='1'  face='Tahoma'>&nbsp;</td> 
                                     <td padding='0' width='50%' align='right'><font color='000000' size='1'  face='Tahoma'></font></td>              
                                    </tr> 
                                    <tr class='isi12' padding='0'>
                                     <td padding='0' width='50%'><font color='000000' size='1'  face='Tahoma'>&nbsp;</td> 
                                     <td padding='0' width='50%' align='right'><font color='000000' size='1'  face='Tahoma'></font></td>              
                                    </tr> 
                                    <tr class='isi12' padding='0'>
                                     <td padding='0' width='50%' align=center><font color='000000' size='1'  face='Tahoma'>( ";
                                        if(getOne("select count(nama) from petugas where nip='$petugas'")>=1){
											echo getOne("select nama from petugas where nip='$petugas'");                                            
                                        }else{
                                            echo " .............................. ";
                                        }
                                        echo " )</td>     
                                     <td padding='0' width='50%' align='center'><font color='000000' size='1'  face='Tahoma'>(.............)</font></td>              
                                    </tr>   
                              </table>
                            </td>
                        </tr>
                  </table>                                
            "; 
        } else {echo "<font color='000000' size='1'  face='Times New Roman'><b>Data  Billing masih kosong !</b>";}

    ?>  

    </body>
</html>
