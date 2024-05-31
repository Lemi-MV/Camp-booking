<?php 
if(isset($_SESSION['Nivo']))
{
	require_once("php/konekcija.php");
    $SifSpec=$_GET['sifspec'];
    $upit = "SELECT * FROM specifikacija WHERE SifraSpecifikacije = " .$SifSpec;
    $rez = $mysqli->query($upit);
    $red=$rez->fetch_assoc();

    $gost=$red['SifraGosta'];
    $SatPrik=$red['SatorPrikolica'];
        if($SatPrik == 0)
        {  $satp = "Sator";  }
        else if($SatPrik== 1)
        {   $satp = "Prikolica"; } 	
    $upit2 = "SELECT * FROM gost WHERE SifraGosta = " .$gost;
    $rez2 = $mysqli->query($upit2);
    $red2=$rez2->fetch_assoc();

    $ponuda=$red['SifraPonude'];
    $upit3 = "SELECT * FROM ponuda WHERE SifraPonude = " .$ponuda;
    $rez3 = $mysqli->query($upit3);
    $red3=$rez3->fetch_assoc();

    $korisnik=$red['KorisnikID'];
    $upit4 = "SELECT * FROM korisnici WHERE KorisnikID = " .$korisnik;
    $rez4 = $mysqli->query($upit4);
    $red4=$rez4->fetch_assoc();
    
 ?>
	<h3>Detalji specifikacije</h3>

    <div class="form-group">
            <label class="control-label col-md-2" for="SifraSpecifikacije">Šifra specifikacije</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="SifraSpecifikacije" name="SifraSpecifikacije" type="number" value="<?php echo $red['SifraSpecifikacije'] ?>">
            </div>
        </div>

    <div class="form-group">
            <label class="control-label col-md-2" for="DatumKreiranja">Datum kreiranja</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="DatumKreiranja" name="DatumKreiranja" type="date" value="<?php echo $red['DatumKreiranja']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="SifRez">Šifra rezervacije</label>
            <div class="col-md-10">
                <input  class="form-control text-box single-line" name="SifRez" readonly id="SifRez" type="number" value="<?php echo $red['SifraRezervacije']; ?>">
            </div>
        </div>

        <div class="form-group">
                <label class="control-label col-md-2" for="Gost">Gost</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" readonly id="Gost" name="Gost" type="text" value="<?php echo $red2['Ime'] . ' ' . $red2['Prezime'] . '  broj LK: '. $red2['BrojLicneKarte'] ?>">
                </div>
            </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="SifraPon">Ponuda</label>
            <div class="col-md-10">
            <input class="form-control text-box single-line" readonly id="SifraPon" name="SifraPon" type="text" value="<?php echo $red3['NazivPonude'] .' '. $red3['Popust'] . "%" ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="RedniBrojMesta">Redni broj mesta</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="RedniBrojMesta" name="RedniBrojMesta" type="number" value="<?php echo $red['RedniBrojMesta']; ?>">
            </div>
        </div>

        <div class="form-group">
                <label class="control-label col-md-2" for="SatPrik">Sator / Prikolica</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" readonly id="SatPrik" name="SatPrik" type="text" value="<?php echo $satp?>">
                </div>
            </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Koris">Kreirao</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" readonly id="Koris" name="Koris" type="text" value="<?php echo $red4['Username'] ?>">
                </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="BrojNocenja">Broj nocenja</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="BrojNocenja" name="BrojNocenja" type="number" value="<?php echo $red['BrojNocenja']; ?>">
            </div>
        </div>

        <a class="btn btn-info btn-sm active" href="specifikacije.php?sve">Nazad na specifikacije</a>
        </div>
			<?php  
            if($rez->num_rows < 1)
            {  ?>
              <h3>Nije moguce prikazati detalje zeljene specifikacije! </h3><br>
            <strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
            </strong> 
                
    <?php   }
            ?>			
		</tbody>
	</table><br><br>
<?php }
else{
 ?>
 	<h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br><br>
	<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a></strong><br><br>

<?php } ?>