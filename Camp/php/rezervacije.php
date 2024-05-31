<?php 
if(isset($_SESSION['Nivo']))
{
    require_once("php/konekcija.php");

    if($_SESSION['Nivo'] > 6 ){
        $upit = "SELECT * FROM rezervacija WHERE KorisnikID=" . $_SESSION['ID'] . " AND (StatusRezervacije='Cekanje' OR StatusRezervacije='Aktivna')";
        $rez = $mysqli->query($upit); 
           ?>
           <h3>Rezervacije</h3>
           <br>
		   <div class="slike">
				<div class="slikaRezervacije">
					<img src="images/dvaSatoraUSumi.jpg" alt="Slika 5" width="900px" height="600px">
				</div>
			</div><br><br>
           <a class="btn btn-primary btn-sm active" href="procRez.php?tip=biraj">Kreiraj rezervaciju</a><br><br>
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
            <?php } ?>

        </tbody>
    </tr>
</table>	<?php 
			if($rez->num_rows > 0)
			{  ?>
			<br><br><br>
			<h4><strong>NAPOMENA: Ukoliko zelite da otkazete svoju rezervaciju kontaktirajte recepciju kampa putem telefona! Hvala na razumevanju!</strong></h4>
			<br><br>
	<?php 
			}
		}
		if($_SESSION['Nivo'] < 6 )
		{           
			$upit = "SELECT * FROM rezervacija WHERE StatusRezervacije='Cekanje' OR StatusRezervacije='Aktivna'";
			$rez = $mysqli->query($upit);
			?>	
			<h3>Rezervacije</h3>
			<br>
			<div class="slike">
				<div class="slikaRezervacije">
					<img src="images/gomilaSatora.jpg" alt="Slika 5" width="500px" height="700px">
				</div>
			</div><br><br>
			<a class="btn btn-primary btn-sm active" href="procRez.php?tip=biraj">Kreiraj rezervaciju</a><br><br>
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
						<td>
							<a class="btn btn-success btn-sm active" href="specifikacije.php?sifrez=<?php echo $red['SifraRezervacije']?>">Specifikacija</a> |
							<a class="btn btn-warning btn-sm active" href="izmenaRezervacije.php?sifrez=<?php echo $red['SifraRezervacije']?>">Izmeni</a>
						</td>
					</tr>
				<?php } ?>          
			</tbody>
		</tr>
		</table>
		<br>  <?php
		if($_SESSION['Nivo'] < 4 ){   ?>
		<a class="btn btn-primary btn-sm active" href="rezervacijaIndex.php?cmd=real">Pregled realizovanih rezervacija</a>  
		<?php 
			}
		} 
	
}
else{
   ?>
   <h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br><br>
   <strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a></strong><br><br>

   <?php } ?>