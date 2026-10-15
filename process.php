<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Dynamic Form Processing with PHP | Tech Stream</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
    </head>
    <body>    
        <form action="" class="register">
            <h1>YouAreBUS Ticket Reservation</h1>
			<?php if(isset($_POST)==true && empty($_POST)==false): 
				$chkbox = $_POST['chk'];
				$BX_NAME=$_POST['BX_NAME'];
				$BX_age=$_POST['BX_age'];			
					
			?>

            <fieldset class="row2">
                <legend>Passenger Details
                </legend>				
                <table id="dataTable" class="form" border="1">
					<tbody>
					<?php foreach($BX_NAME as $a => $b){ ?>
						<tr>
							<p>
								<td >
									<?php echo $a+1; ?>
								</td>
								<td>
									<label>Name</label>
									<input type="text" readonly="readonly" name="BX_NAME[$a]" value="<?php echo $BX_NAME[$a]; ?>">
								</td>
								<td>
									<label for="BX_age">Age</label>
									<input type="text" readonly="readonly" class="small"  name="BX_age[]" value="<?php echo $BX_age[$a]; ?>">
								</td>
								<td>
									<label for="BX_gender">Gender</label>
									<input type="text" readonly="readonly" name="BX_gender[]" value="<?php echo $BX_gender[$a]; ?>">
								</td>
								<td>
									<label for="BX_birth">Berth Pre</label>
									<input type="text" readonly="readonly" name="BX_birth[]" value="<?php echo $BX_birth[$a]; ?>">
								</td>
							</p>
						</tr>
					<?php } ?>
					</tbody>
                </table>
				<div class="clear"></div>
            </fieldset>

		<?php endif;  ?>
        </form>
    </body>
</html>





