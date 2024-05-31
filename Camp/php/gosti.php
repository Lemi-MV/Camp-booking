<?php 	

if(isset($_SESSION['Nivo']))
{
	require_once("php/konekcija.php"); 
	if($_SESSION['Nivo'] < 6)
	{

	$upit = "SELECT * FROM gost WHERE Obrisan = 0";
	$rez=$mysqli->query($upit);

	?>
		<h3>Gosti</h3><br>
		<div class="slike">
			<div class="slikaGosti">
				<img src="images/satoriNaObali.jpg" alt="Slika 2" width="800px" height="450px">
			</div>
		</div><br><br>
		<a class="btn btn-primary btn-sm active" href="kreiranjeGosta.php">Kreiraj novog gosta</a><br><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Sifra gosta</th>
					<th>KorisnikID</th>
					<th>Ime</th>
					<th>Prezime</th>
					<th>Broj licne karte</th>
					<th>Adresa</th>
					<th>Broj telefona</th>
					<th>Status gosta</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				while($red=$rez->fetch_assoc()) 
				{
					?>
					<tr>
						<td width="60"><?php echo $red['SifraGosta']; ?></td>
						<td width="60"><?php echo $red['KorisnikID']; ?></td>
						<td width="110"><?php echo $red['Ime']; ?></td>
						<td width="110"><?php echo $red['Prezime']; ?></td>
						<td width="120"><?php echo $red['BrojLicneKarte']; ?></td>
						<td width="220"><?php echo $red['Adresa']; ?></td>
						<td width="120"><?php echo $red['BrojTelefona']; ?></td>
						<td width="120"><?php echo $red['StatusGosta']; ?></td>
						<td>
							<a class="btn btn-warning btn-sm active" href="izmenaGosta.php?idGost=<?php echo $red['SifraGosta']; ?>">Izmeni</a> | 
							<a class="btn btn-danger btn-sm active" href="brisanjeGosta.php?idGost=<?php echo $red['SifraGosta']; ?>">Briši</a>
						</td>
					</tr>
					<?php 
				}
				?>			
			</tbody>
		</tr>
	</table><br><br>
	<a class="btn btn-primary btn-sm active" href="gostIndex.php?gos=pri">Prijavljeni gosti</a>
<?php 
	}
	else if($_SESSION['Nivo'] > 6)
	{
		$korID = $_SESSION['ID'];
		$upit2 = "SELECT * FROM gost WHERE KorisnikID=".$korID;
		$rez2=$mysqli->query($upit2);
		
		?>
		<h3>Podaci o gostu</h3><br><br>
		<div class="slike">
			<div class="slikaGosti">
				<img src="images/satoriNaObali.jpg" alt="Slika 2" width="800px" height="450px">
			</div>
		</div><br><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Sifra gosta</th>
					<th>Ime</th>
					<th>Prezime</th>
					<th>Broj licne karte</th>
					<th>Adresa</th>
					<th>Broj telefona</th>
					<th>Status gosta</th>
				</tr>
			</thead>
			<tbody>
			<?php
                while($red2=$rez2->fetch_assoc()) 
                { ?>
					<tr>
						<td width="60"><?php echo $red2['SifraGosta']; ?></td>
						<td width="150"><?php echo $red2['Ime']; ?></td>
						<td width="150"><?php echo $red2['Prezime']; ?></td>
						<td width="120"><?php echo $red2['BrojLicneKarte']; ?></td>
						<td width="220"><?php echo $red2['Adresa']; ?></td>
						<td width="120"><?php echo $red2['BrojTelefona']; ?></td>
						<td width="120"><?php echo $red2['StatusGosta']; ?></td>
					</tr>	
					<?php 
                }  
            		?>	
			</tbody>
		</tr>		
	</table><br><br>
	<?php 
		if($rez2->num_rows < 1)
		{  ?>
			<a class="btn btn-primary btn-sm active" href="kreiranjeGosta.php">Unesi podatke</a><br><br>
		<?php
		}
	}
}else
{
	?>
	<h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br><br>
	<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br><br> 
		</strong>
	<?php }  ?>