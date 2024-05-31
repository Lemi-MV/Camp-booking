<?php 
if(isset($_SESSION['Nivo']) && $_SESSION['Nivo'] < 4)
{
	require_once("php/konekcija.php");

    if(!isset($_POST['Obrisi']) && isset($_GET['rbsb']))
    {
        $upit = "SELECT * FROM smestaj WHERE RedniBrojMesta = '".$_GET['rbsb']."'";
        $rez = $mysqli->query($upit);
        $red=$rez->fetch_assoc();

        if($rez->num_rows < 1)
            {  ?>
              <h3>Nije moguce prikazati detalje zeljenog mesta! </h3><br>
            <strong><a style="color:black; font-size: 20px;" href="mesta.php?cmd=sve">Povratak na listu ⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
            </strong>            
        <?php   }

        $RedniBrojSobe = $red['RedniBrojMesta'];
        $TipMesta = $red['Tip'];
        $Opis = $red['Opis'];
        $Kapacitet = $red['Kapacitet'];
        $SatorPrikolica = $red['SatorPrikolica'];
        $Rentira = $red['Rentira'];
        $StrujaPrikljucak = $red['StrujaPrikljucak'];
        $VodaPrikljucak = $red['VodaPrikljucak'];
        $Cena = $red['Cena']; 
       

?>   
        <h2>Brisanje mesta</h2>
        <br>
		<form action="" method="post">
        <fieldset>
        <legend><h4><strong><?php echo $red['Tip'];?></strong></h4></legend>  
        <div class="form-group">
            <label class="control-label col-md-2" for="RedniBrojMesta">Redni broj mesta</label>
            <div class="col-md-10">
                <input readonly class="form-control text-box single-line" id="RedniBrojMesta" name="RedniBrojMesta" type="number" value="<?php echo $red['RedniBrojMesta'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Tip">Tip mesta</label>
            <div class="col-md-10">
                <input readonly class="form-control text-box single-line" id="Tip" name="Tip" type="text" value="<?php echo $red['Tip'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Opis">Opis</label>
            <div class="col-md-10">
                <textarea readonly class="form-control textarea" id="Opis" name="Opis"><?php echo $red['Opis'] ?></textarea>
            </div>
        </div>   
        
        <div class="form-group">
            <label class="control-label col-md-2" for="Kapacitet">Kapacitet</label>
            <div class="col-md-10">
                <input readonly class="form-control text-box single-line" id="RedniBrKapacitetojMesta" name="Kapacitet" type="number" value="<?php echo $red['Kapacitet'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="SatorPrikolica">Sator / Prikolica</label>
            <div class="col-md-10">
                <input readonly class="form-control text-box single-line" id="SatorPrikolica" name="SatorPrikolica" type="text" value="<?php echo $red['SatorPrikolica'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Rentira">Rentira</label>
            <div class="col-md-10">
                <input readonly class="form-control text-box single-line" id="Rentira" name="Rentira" type="text" value="<?php echo $red['Rentira'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="StrujaPrikljucak">Struja Prikljucak</label>
            <div class="col-md-10">
                <input readonly class="form-control text-box single-line" id="StrujaPrikljucak" name="StrujaPrikljucak" type="text" value="<?php echo $red['StrujaPrikljucak'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="VodaPrikljucak">Voda Prikljucak</label>
            <div class="col-md-10">
                <input readonly class="form-control text-box single-line" id="VodaPrikljucak" name="VodaPrikljucak" type="text" value="<?php echo $red['VodaPrikljucak'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Cena">Cena </label>
            <div class="col-md-10">
                <input readonly class="form-control text-box single-line" id="Cena" name="Cena" type="number" value="<?php echo $red['Cena'] ?>">
            </div>
        </div>  
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="Obrisi" name="Obrisi" class="btn btn-default">
            </div>
            <div>
                <a class="btn btn-info btn-sm active" href="mesta.php?cmd=sve">Odustani - nazad na listu</a>
            </div>
        </div>
        </fieldset>   
    </div>
</form>
<?php   
    }
    else if($_POST['Obrisi'] = "Obrisi")
    {
        $upit = "UPDATE smestaj set Obrisan = 1 where RedniBrojMesta = '" . $_POST['RedniBrojMesta'] . "'";
        $rez = $mysqli->query($upit);
        if(!$rez)
        {
            echo "<strong><p style='color: black; font-size: 20px;'> Greska prilikom brisanja!!!</p></strong>";
        }
        else
        { ?>
            <h3>Uspesno ste obrisali mesto!</h3>
            <div>
                <a class="btn btn-info btn-sm active" href="mesta.php?cmd=sve">Nazad na listu</a>
            </div>
<?php
        } 
    }         
}
else
{
    ?>  
    <h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br>
    <strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br>
    </strong>
<?php 
}
?>
