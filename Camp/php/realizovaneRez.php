<?php 

if(isset($_SESSION['Nivo']) && $_SESSION['Nivo'] < 4)
{
	require_once("php/konekcija.php");
	$upit = "SELECT * FROM rezervacija WHERE StatusRezervacije = 'Realizovana' OR StatusRezervacije ='Otkazana'";
	$rez = $mysqli->query($upit);
 ?>
 	<h2>Realizovane i otkazane rezervacije</h2><br><br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Sifra rezervacije</th>
				<th>Redni broj mesta</th>
				<th>Datum pocetka</th>
				<th>Datum zavrsetka</th>
				<th>Broj kampera</th>
				<th>Status rezervacije</th>
				<th>KorisnikID</th>
				<th>Sifra gosta</th>
				<th>Napomena</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			while($red = $rez->fetch_assoc())
			{
			 ?>
			<tr>
				<td width="30"><?php echo $red['SifraRezervacije']; ?></td>
				<td width="30"><?php echo $red['RedniBrojMesta']; ?></td>
				<td width="130"><?php echo $red['DatumPocetka']; ?></td>
				<td width="130"><?php echo $red['DatumZavrsetka']; ?></td>
				<td width="30"><?php echo $red['BrojKampera']; ?></td>
				<td width="130"><?php echo $red['StatusRezervacije']; ?></td>
				<td width="30"><?php echo $red['KorisnikID']; ?></td>
				<td width="30"><?php echo $red['SifraGosta']; ?></td>
				<td width="200"><?php echo $red['Napomena']; ?></td>
			</tr>
			<?php } 	
			
			if($rez->num_rows < 1)
			{  ?>
	  		<h3>Ne postoje trazene rezervacije! </h3><br>
			<strong><a style="color:black; font-size: 20px;" href="rezervacijaIndex.php?cmd=cek">Povratak na prethodnu listu ⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
			</strong> 
		
	<?php   }  ?>
		</tbody>
		</tr>
	</table>
	<br>
	<div>
		<a class="btn btn-info btn-sm active" href="rezervacijaIndex.php?cmd=cek">Vratite se na listu</a>
	</div>
<?php }
else{
 ?>
 		<h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br><br>
		<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br><br> 
		</strong>
<?php } ?>
