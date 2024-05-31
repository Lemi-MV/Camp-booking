<?php

if(isset($_SESSION['Nivo']) && $_SESSION['Nivo'] < 6)
{
	require_once("php/konekcija.php");
	if(!isset($_POST["Izmeni"]))
	{

	$upit = "SELECT * FROM gost where SifraGosta = '" . $_GET['idGost'] . "'";
	$rez=$mysqli->query($upit);
	$red=$rez->fetch_assoc();
 
	if($rez->num_rows < 1)
	{  ?>
	  <h3>Nije moguce prikazati detalje zeljenog gosta! </h3><br>
	<strong><a style="color:black; font-size: 20px;" href="gostIndex.php?gos=svi">Povratak na listu ⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
	</strong> 
		
<?php   }

	
	$SifraGosta=$red['SifraGosta']; 
	$Ime=$red['Ime'];
	$Prezime=$red['Prezime'];
	$BrojLicneKarte=$red['BrojLicneKarte'];		
	$Adresa=$red['Adresa'];				
	$BrojTelefona=$red['BrojTelefona'];				
	$StatusGosta=$red['StatusGosta'];				
	
 ?>
	<h2>Izmena gosta</h2>
	<form action="izmenaGosta.php" method="post">
		<div class="form-group">
			<label class="control-label col-md-2" for="SifGo">Sifra gosta</label>
			<div class="col-md-10">
				<input class="form-control text-box single-line" disabled id="SifGo" name="SifGo" type="text" value="<?php echo $SifraGosta ?>">
			</div>
		</div>
		<input type="hidden" name="SifraGosta" value="<?php echo $SifraGosta ?>">

		<div class="form-group">
			<label class="control-label col-md-2" for="Ime">Ime</label>
			<div class="col-md-10">
				<input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti ime gosta." id="Ime" name="Ime" type="text" value="<?php echo $Ime ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2" for="Prezime">Prezime</label>
			<div class="col-md-10">
				<input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti prezime gosta." id="Prezime" name="Prezime" type="text" value="<?php echo $Prezime ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2" for="BrojLicneKarte">Broj lične karte</label>
			<div class="col-md-10">
				<input class="form-control text-box single-line" data-val="true" required data-val-range="Dozvoljene su samo pozitivni brojevi duzine 9 cifara" max="999999999" min="100000000" data-val-required="Morate uneti broj lične karte gosta." id="BrojLicneKarte" name="BrojLicneKarte" type="text" value="<?php echo $BrojLicneKarte ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2" for="Adresa">Adresa</label>
			<div class="col-md-10">
				<input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti adresa gosta." id="Adresa" name="Adresa" type="text" value="<?php echo $Adresa ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2" for="BrojTelefona">Broj telefona</label>
			<div class="col-md-10">
				<input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti broj telefona gosta." id="BrojTelefona" name="BrojTelefona" type="text" value="<?php echo $BrojTelefona ?>">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-2" for="StatusGosta">Status gosta</label>
			<div class="col-md-10">
				<select class="form-control select" data-val="true" required data-val-required="Morate odabrati status gosta." id="StatusGosta" name="StatusGosta">
					<?php if($StatusGosta == "Odjavljen")
					{ ?>
					<option selected value="Odjavljen">Odjavljen</option>
					<option value="Prijavljen">Prijavljen</option>	
					<?php 
					}else if($StatusGosta == "Prijavljen"){ ?>
						<option value="Odjavljen">Odjavljen</option>
						<option selected value="Prijavljen">Prijavljen</option>	
					<?php
					} ?>	
				</select>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<input type="submit" value="Sacuvaj izmene" name="Izmeni" class="btn btn-default">
			</div>
			<div>
				<a class="btn btn-info btn-sm active" href="gostIndex.php?gos=svi">Odustani - nazad na listu</a>
			</div>
		</div>
	</form><br>
<?php 
	}
	else if($_POST['Izmeni'] = "Izmeni")
	{
 		$upit = "UPDATE gost set Ime='".$_POST['Ime']."',Prezime='".$_POST['Prezime']."',BrojLicneKarte='".$_POST['BrojLicneKarte']."',Adresa='".$_POST['Adresa']."',BrojTelefona='".$_POST['BrojTelefona']."',StatusGosta='" .$_POST['StatusGosta']."' where SifraGosta = '" .$_POST['SifraGosta']."'";
		$rez = $mysqli->query($upit);
		if($rez)
		{
 ?>
 			<h3>Uspesno ste izmenili podatke gosta!</h3>
			<div>
				<a class="btn btn-info btn-sm active" href="gostIndex.php?gos=svi">Nazad na listu</a>
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

<script>
    var brojTelefonaInput = document.getElementById("BrojTelefona");
    var phoneRegex = /^(06\d\/\d{3}\-\d{3,4})$/

    // /^(06\d\/\d{3}\-\d{3,4})$/         moj regex
    // /^06\d\/\d{3}-\d{3}(-\d{1,3})?$/  izvorni regex

    function validatePhoneNumber() {
        var brojTelefona = brojTelefonaInput.value;

        if (phoneRegex.test(brojTelefona)) {

        } else {
            alert("Morate uneti broj telefona u ispravnom formatu: 06x/xxx-xxx(x)");
        }
    }

    brojTelefonaInput.addEventListener("blur", validatePhoneNumber);
</script>

