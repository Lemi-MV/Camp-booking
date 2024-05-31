<?php
if(isset($_SESSION['Nivo']) && $_SESSION['Nivo'] < 2)
{
    require_once("php/konekcija.php");

    $upit = "SELECT * FROM rola";
    $rez = $mysqli->query($upit);
?>

    <h3>Postojece role</h3><br>
    <table class="table table-hover">
			<thead>
				<tr>
					<th>RolaID</th>
					<th>Naziv role</th>
					<th>Nivo</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				while($red=$rez->fetch_assoc()) 
				{
					?>
					<tr>
                        <td width="60"><?php echo $red['RolaID']; ?></td>
						<td width="150"><?php echo $red['NazivRole']; ?></td>
						<td width="60"><?php echo $red['Nivo']; ?></td>
					</tr>
					<?php 
				} ?>			
			</tbody>
	</table><br><br>

	<p>-----------------------------------------------------------------------------------------------------------------------------------------</p><br>

<?php
	if(!isset($_POST["Izmeni"]))
	{
		$upit2 = "SELECT * FROM korisnici WHERE KorisnikID='". $_GET['korisnikID'] ."'";
		$rez2 = $mysqli->query($upit2);
		$red2 = $rez2->fetch_assoc();

		$KorisnikID=$red2['KorisnikID'];
		$Username=$red2['Username'];
		$Email=$red2['Email'];
		$RolaID=$red2['RolaID'];

		
?>
		<h3>Korisnici</h3><br>
			<form action="izmenaRole.php" method="post">
				<div class="form-group">
            		<label class="control-label col-md-2" for="SifraPonude">Korisnik ID</label>
            		<div class="col-md-10">
                		<input class="form-control text-box single-line" readonly id="KorisnikID" name="KorisnikID" type="number" value="<?php echo $KorisnikID ?>">
            		</div>
        		</div>
				<div class="form-group">
            		<label class="control-label col-md-2" for="Username">Username</label>
            		<div class="col-md-10">
                		<input class="form-control text-box single-line" readonly id="Username" name="Username" type="text" value="<?php echo $Username ?>">
            		</div>
        		</div>
				<div class="form-group">
            		<label class="control-label col-md-2" for="Email">Email</label>
            		<div class="col-md-10">
                		<input class="form-control text-box single-line" readonly id="Email" name="Email" type="text" value="<?php echo $Email ?>">
            		</div>
        		</div>
				<div class="form-group">
            		<label class="control-label col-md-2" for="RolaID">Rola ID</label>
            		<div class="col-md-10">
                		<input class="form-control text-box single-line" id="RolaID" name="RolaID" type="number" value="<?php echo $RolaID ?>">
            		</div>
        		</div>
				<div class="form-group">
            		<div class="col-md-offset-2 col-md-10">
                		<input type="submit" value="Sacuvaj izmene" name="Izmeni" class="btn btn-default">
            		</div>
            	<div>
                <a class="btn btn-info btn-sm active" href="rolaIndex.php">Odustani - nazad na listu</a>
            </div>
        </div>
			</form><br>

<?php
	}
	else if($_POST['Izmeni'] = "Izmeni")
	{
		$upit3 = "UPDATE korisnici set RolaID ='" .$_POST['RolaID']."' where KorisnikID = '" .$_POST['KorisnikID']."'";
		$rez3 = $mysqli->query($upit3);
		if($rez3)
		{
 ?>
 			<h3>Uspesno ste izmenili rolu korisnika!</h3>
			<div>
                <a class="btn btn-info btn-sm active" href="rolaIndex.php">Nazad na listu</a>
            </div>
<?php
		}
	}
}else
{
	?>
		<h3>Niste ulogovani, nemate mogucnost ove radnje!</h3><br><br>
		<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br><br></strong>
<?php 
}
?>