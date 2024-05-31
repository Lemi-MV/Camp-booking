<?php 
if(isset($_SESSION['Nivo']) && $_SESSION['Nivo'] < 4)
{
	require_once("php/konekcija.php");

    if(!isset($_POST['Izmeni']) && isset($_GET['rbs']))
    {
        $upit = "SELECT * FROM smestaj WHERE RedniBrojMesta = '".$_GET['rbs']."' and Obrisan = 0";
        $rez = $mysqli->query($upit);
        $red=$rez->fetch_assoc();

        if($rez->num_rows < 1)
	    {  ?>
	        <h3>Nije moguce prikazati detalje zeljenog mesta! </h3><br>
	        <strong><a style="color:black; font-size: 20px;" href="mesta.php?cmd=sve">Povratak na listu ⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
	        </strong> 		
<?php   }   

        $RedniBrojMesta = $red['RedniBrojMesta'];
        $Tip = $red['Tip'];
        $Opis = $red['Opis'];
        $Kapacitet = $red['Kapacitet'];
        $SatorPrikolica = $red['SatorPrikolica'];
        $Rentira = $red['Rentira'];
        $StrujaPrikljucak = $red['StrujaPrikljucak'];
        $VodaPrikljucak = $red['VodaPrikljucak'];
        $Cena = $red['Cena'];

?>      
        <h2>Izmena mesta</h2><br>
        <br>
        <h4>Napomena: U polju <i>rentira</i>, ukoliko je upisan broj 0 to znaci da je mesto prazno i gost moze postaviti svoj sator ili prikolicu/kamper, ukoliko je broj 1 to znaci da se nalazi nas sator ili prikolica, koji rentiramo zajedno sa mestom.</h4>
        <br>
        <?php if($Tip=="Za prikolicu"){ ?>   
        <h4>U poljima <i>struja prikljucak</i> i <i>voda prikljucak</i> ukoliko je upisana 0 to znaci da mesto nema taj prikljucak, a ukoliko je upisan 1, to znaci da ga poseduje.</h4>    
        <?php } ?>    
        <br>
		<form action="" method="post">
        <fieldset>
        <legend><h4><strong><?php echo $red['Tip'];?></strong></h4></legend>  
        <div class="form-group">
            <label class="control-label col-md-2" for="RedniBrojMesta">Redni broj mesta</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="RedniBrojMesta" name="RedniBrojMesta" type="number" value="<?php echo $red['RedniBrojMesta'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Tip">Tip </label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="Tip" name="Tip" type="text" value="<?php echo $red['Tip'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Opis">Opis</label>
            <div class="col-md-10">
                <textarea class="form-control textarea" required id="Opis" name="Opis"><?php echo $red['Opis'] ?></textarea>
            </div>
        </div>    

        <div class="form-group">
            <label class="control-label col-md-2" for="Kapacitet">Kapacitet</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" required id="Kapacitet" name="Kapacitet" type="number" value="<?php echo $red['Kapacitet'] ?>">
            </div>
        </div>  

        <div class="form-group">
            <label class="control-label col-md-2" for="SatorPrikolica">Sator / Prikolica</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="SatorPrikolica" name="SatorPrikolica" type="text" value="<?php echo $red['SatorPrikolica'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="Rentira">Rentira</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" required id="Rentira" name="Rentira" type="text" value="<?php echo $red['Rentira'] ?>">
            </div>
        </div>
        <?php if($Tip=="Za prikolicu"){
            ?>
        <div class="form-group">
            <label class="control-label col-md-2" for="StrujaPrikljucak">StrujaPrikljucak</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" required id="StrujaPrikljucak" name="StrujaPrikljucak" type="text" value="<?php echo $red['StrujaPrikljucak'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="VodaPrikljucak">VodaPrikljucak</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" required id="VodaPrikljucak" name="VodaPrikljucak" type="text" value="<?php echo $red['VodaPrikljucak'] ?>">
            </div>
        </div>
        <?php } 

            if($Tip=="Satorsko"){  ?>
            
            <input type="hidden" name="StrujaPrikljucak" value="0">
            <input type="hidden" name="VodaPrikljucak" value="0">
        <?php     
            }        
        ?>

        <div class="form-group">
            <label class="control-label col-md-2" for="Cena">Cena</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" required id="Cena" name="Cena" type="number" value="<?php echo $red['Cena'] ?>">
            </div>
        </div>  
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="Sacuvaj izmene" name="Izmeni" class="btn btn-default">
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
    else if($_POST['Izmeni'] = "Izmeni")
    {
            $upit2 = "UPDATE smestaj SET Tip='".$_POST['Tip']."',Opis='".$_POST['Opis']."',Kapacitet='".$_POST['Kapacitet']."',SatorPrikolica='".$_POST['SatorPrikolica']."',Rentira='".$_POST['Rentira']."',StrujaPrikljucak='".$_POST['StrujaPrikljucak']."', VodaPrikljucak='".$_POST['VodaPrikljucak']."', Cena='".$_POST['Cena']."' WHERE RedniBrojMesta = '" . $_POST['RedniBrojMesta'] . "'";
            $rez2 = $mysqli->query($upit2);

            if(!$rez2)
            {
                echo "<strong><p style='color: black; font-size: 20px;'> Greska prilikom izmena!!!</p></strong>"; 
            }
            else
            { ?>
                <h3>Uspesno ste izmenili informacije o mestu!</h3>
                <div>
                    <a class="btn btn-info btn-sm active" href="mesta.php?cmd=sve">Nazad na listu</a>
                </div>
<?php       }  
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
