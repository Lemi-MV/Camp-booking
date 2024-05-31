<?php 
if(isset($_SESSION['Nivo']))
{
	require_once("php/konekcija.php");

	if($_SESSION['Nivo'] < 6){
		$upit = "SELECT * FROM specifikacija";

		$rez = $mysqli->query($upit); ?>

	<h3>Specifikacije</h3><br>
		<div class="slike">
			<div class="slikaSpecifikacije">
				<img src="images/gomilaSatora3.jpg" alt="Slika 6" width="500px" height="700px">
			</div>
		</div><br><br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Sifra specifikacije</th>
				<th>Datum kreiranja</th>
				<th>Sifra rezervacije</th>
				<th>Sifra gosta</th>
				<th>Sifra ponude</th>
				<th>Redni broj mesta</th>
				<th>KorisnikID</th>
				<th>Broj nocenja</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			while($red = $rez->fetch_assoc())
			{
			 ?>
			<tr>
				<td width="50"><?php echo $red['SifraSpecifikacije']; ?></td>
				<td width="50"><?php echo $red['DatumKreiranja']; ?></td>
				<td width="130"><?php echo $red['SifraRezervacije']; ?></td>
				<td width="130"><?php echo $red['SifraGosta']; ?></td>
				<td width="130"><?php echo $red['SifraPonude']; ?></td>
				<td width="50"><?php echo $red['RedniBrojMesta']; ?></td>				
				<td width="30"><?php echo $red['KorisnikID']; ?></td>
				<td width="30"><?php echo $red['BrojNocenja']; ?></td>
				<td>
					<a class="btn btn-success btn-sm active" href="specifikacije.php?sifspec=<?php echo $red['SifraSpecifikacije']?>">Detalji</a>
				</td>
			</tr>
			<?php } 	
			
			if($rez->num_rows < 1)
			{  ?>
	  		<h3>Nema specifikacija! </h3><br>
			<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu ⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
			</strong> 
		
	<?php   }  ?>
		</tbody>
	</table>

<?php 
	}
	else if($_SESSION['Nivo'] > 6)
	{

		$korID = $_SESSION['ID'];
		$upit2 = "SELECT SifraGosta FROM gost WHERE KorisnikID = " .$korID;
		$rez2 = $mysqli->query($upit2);

		$red2 = $rez2->fetch_assoc();
		$sifg = $red2['SifraGosta'];

		$upit = "SELECT * FROM specifikacija WHERE SifraGosta = " .$sifg;
		$rez = $mysqli->query($upit); 

		if($rez->num_rows < 1)
				{  ?>
				<h3>Nema specifikacija! </h3><br>
				<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu ⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
				</strong> 
		<?php   
		}  
		else{   ?>

			<h3>Specifikacije</h3><br>
		<div class="slike">
			<div class="slikaSpecifikacije">
				<img src="images/gomilaSatora3.jpg" alt="Slika 6" width="500px" height="700px">
			</div>
		</div><br><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Sifra specifikacije</th>
					<th>Datum kreiranja</th>
					<th>Sifra rezervacije</th>
					<th>Sifra gosta</th>
					<th>Sifra ponude</th>
					<th>Redni broj mesta</th>
					<th>KorisnikID</th>
					<th>Broj nocenja</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				while($red = $rez->fetch_assoc())
				{
				?>
				<tr>
					<td width="50"><?php echo $red['SifraSpecifikacije']; ?></td>
					<td width="50"><?php echo $red['DatumKreiranja']; ?></td>
					<td width="130"><?php echo $red['SifraRezervacije']; ?></td>
					<td width="130"><?php echo $red['SifraGosta']; ?></td>
					<td width="130"><?php echo $red['SifraPonude']; ?></td>
					<td width="50"><?php echo $red['RedniBrojMesta']; ?></td>				
					<td width="30"><?php echo $red['KorisnikID']; ?></td>
					<td width="30"><?php echo $red['BrojNocenja']; ?></td>
					<td>
						<a class="btn btn-success btn-sm active" href="specifikacije.php?sifspec=<?php echo $red['SifraSpecifikacije']?>">Detalji</a>
					</td>
				</tr>
				<?php } 	
				}  ?>
			</tbody>
		</table>
 <?php	
	}	?>

		
<?php 		
	}	

else{    ?>
 	<h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br><br>
	<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a></strong><br><br>

<?php } ?>