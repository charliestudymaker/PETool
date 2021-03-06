<head>
	  <link rel="stylesheet" href="style.css" type="text/css">
	  <LINK REL="SHORTCUT ICON" HREF="favicon.ico">
	  <title>QUAADRICs CONTROL Message</title>
	</head>

<script>

function pagePrint()
   {
    saveHTML = document.getElementById('navOps').innerHTML;
    document.getElementById('navOps').innerHTML='';
    window.print();
    document.getElementById('navOps').innerHTML=saveHTML;
    }
</script>

	<div class="page">
		<div class="titlebox">
			<div class="titletext">
				PE Pretest Probability <br>Assessment (Version 2.1Q2)
			</div>

			<div class="logo">
				<img src="images/logosmall.GIF" >
			</div>

			<div class=peform> 
			<table>
			   <tr><td width=100>Study ID : </td>
			   <td><B><font color=blue>
			     <?php
			        echo $_POST['StudyID'];
			     ?>
			     </td></tr>


		<tr>
		     <td>Time : </td>
		     <td><B> <?php echo date("H:i    m/d/y"); ?>
		</tr>
			     <tr>
			        <td valign=top>Action : </td>
				<td><B>This patient has been randomized to the Study Control Group. <P>Thank you for participating in this research study</td>
				</tr>

    <tr>
    <td colspan=2><DIV id=navOps>
	<input type=button value='Print Study Assignment' onclick=pagePrint();>        
        </DIV>
    </td>
    </tr>
			</table>

			</div>
			
		</div>

	</div>