<?php 
if(isset($_SESSION['Nivo']) && $_SESSION['Nivo'] < 4)
{
    require_once("php/konekcija.php");
    if(!isset($_POST["Izmeni"]))
    {
        $upit="SELECT * FROM ponuda WHERE SifraPonude='". $_GET['idPonuda']."'";
        $rez=$mysqli->query($upit);
        $red=$rez->fetch_assoc();

        if($rez->num_rows < 1)
        {  ?>
            <h3>Nije moguce prikazati detalje zeljenog gosta! </h3><br>
            <strong><a style="color:black; font-size: 20px;" href="ponudaIndex.php">Povratak na listu ⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
            </strong>         
    <?php   }

        $SifraPonude = $red['SifraPonude'];
        $NazivPonude = $red['NazivPonude'];
        $Opis = $red['Opis'];
        $Popust = $red['Popust'];
    
 ?>
	<h2>Izmena ponude</h2><br><br>
	<form action="izmenaPonude.php" method="post">
	   <div class="form-group">
            <label class="control-label col-md-2" for="SifraPonude">Šifra ponude</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="SifraPonude" name="SifraPonude" type="number" value="<?php echo $SifraPonude ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="NazivPonude">Naziv ponude</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti naziv ponude." id="NazivPonude" name="NazivPonude" type="text" value="<?php echo $NazivPonude ?>">                
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Opis">Opis</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti opis ponude." id="Opis" name="Opis" type="text" value="<?php echo $Opis ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Popust">Popust</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" data-val="true" required data-val-number="The field Popust must be a number." data-val-range="Dozvoljene su samo pozitivne vrednosti od 0 do 100" max="100" min="0" data-val-required="Morate uneti popust." id="Popust" name="Popust" type="number" value="<?php echo $Popust ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="Sacuvaj izmene" name="Izmeni" class="btn btn-default">
            </div>
            <div>
                <a class="btn btn-info btn-sm active" href="ponudaIndex.php">Odustani - nazad na listu</a>
            </div>
        </div>
</form><br>
<?php 
    }
    else if($_POST['Izmeni'] = "Izmeni")
    {
        $upit = "UPDATE ponuda set NazivPonude='".$_POST['NazivPonude']."',Opis='".$_POST['Opis']."',Popust='".$_POST['Popust']."' where SifraPonude = '" .$_POST['SifraPonude']."'";
        $rez = $mysqli->query($upit);
    ?>
        <h3>Uspesno ste izmenili ponudu!</h3>
        <div>
            <a class="btn btn-info btn-sm active" href="ponudaIndex.php">Nazad na listu</a>
        </div>
<?php 
    } 
}else
{
?>
    <h3>Niste ulogovani, nemate mogucnost ove radnje!</h3><br><br>
    <strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br><br></strong>
<?php 
}
?>