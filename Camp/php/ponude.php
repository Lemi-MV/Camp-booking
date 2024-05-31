<?php 

if(isset($_SESSION['Nivo']))
{
	if($_SESSION['Nivo'] > 4)
	{
		require_once("php/konekcija.php");
		$upit = "SELECT * FROM ponuda where Obrisan=0";
		$rez = $mysqli->query($upit);	
 ?>
		<div class="slike">
		    <div class="slikaPonuda">
			    <img src="images/satorNaObali.jpg" alt="Slika 4" width="700px" height="450px">
		    </div>
	    </div><br><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Sifra ponude</th>
					<th>Naziv ponude</th>
					<th>Opis</th>
					<th>Popust</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			while($red = $rez->fetch_assoc()){
			 ?>
			<tr>
				<td width="60"><?php echo $red['SifraPonude']; ?></td>
				<td width="150"><?php echo $red['NazivPonude']; ?></td>
				<td width="150"><?php echo $red['Opis']; ?></td>
				<td width="60"><?php echo $red['Popust']; ?></td>
			</tr>
			<?php } ?>			
		</tbody>
		</tr>
	</table>
<?php 
	}
	else if($_SESSION['Nivo'] < 4)
	{
		require_once("php/konekcija.php");
		$upit = "SELECT * FROM ponuda where Obrisan=0";
		$rez = $mysqli->query($upit);	
	 ?>
	 	<div class="slike">
		    <div class="slikaPonuda">
			    <img src="images/satorNaObali.jpg" alt="Slika 4" width="700px" height="450px">
		    </div>
	    </div><br><br>
		<a class="btn btn-primary btn-sm active" href="kreiranjePonude.php">Kreiraj novu ponudu</a><br><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Sifra ponude</th>
					<th>Naziv ponude</th>
					<th>Opis</th>
					<th>Popust</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				while($red = $rez->fetch_assoc()){
	
				 ?>
				<tr>
					<td width="60"><?php echo $red['SifraPonude']; ?></td>
					<td width="150"><?php echo $red['NazivPonude']; ?></td>
					<td width="150"><?php echo $red['Opis']; ?></td>
					<td width="60"><?php echo $red['Popust']; ?></td>
					<td>
						<a class="btn btn-warning btn-sm active" href="izmenaPonude.php?idPonuda=<?php echo $red['SifraPonude']; ?>">Izmeni</a> |
						<a class="btn btn-danger btn-sm active" href="brisanjePonude.php?idPonuda=<?php echo $red['SifraPonude']; ?>">Briši</a>
					</td>
				</tr>
				<?php } ?>			
			</tbody>
			</tr>
		</table>
	<?php

	}
}
else{
 ?>
		<h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br>
		<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br>
		</strong>
		
<?php } ?>
