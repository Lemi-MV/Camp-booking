<?php 
if(isset($_SESSION['Nivo']))
{
    require_once("php/konekcija.php");
    
    if(!isset($_POST['Sacuvaj']))
    {   
        $sifrez = $_GET["sifrez"];
        $upit = "SELECT * FROM rezervacija WHERE SifraRezervacije = ".$sifrez;
        $rez = $mysqli->query($upit);
        $red=$rez->fetch_assoc();

        $DatumKreiranja = date("Y-m-d");
        $SifraRezervacije = $red['SifraRezervacije'];
        $SifraGosta = $red['SifraGosta'];
        $RedniBrojMesta = $red['RedniBrojMesta'];
        $SatorPrikolica = $red['SatorPrikolica'];
        $KorisnikID = $_SESSION['ID'];

        $DatumPocetka = $red['DatumPocetka'];
        $DatumZavrsetka = $red['DatumZavrsetka'];
        $timestamp1 = strtotime($DatumPocetka);
        $timestamp2 = strtotime($DatumZavrsetka);
        $difference = abs($timestamp2 - $timestamp1); // apsolutna vrednost razlike
        $BrojNocenja = floor($difference / (60 * 60 * 24)); // broj sekundi u danu

        $upit2 = "select * from ponuda where Obrisan = 0";
        $rez2 = $mysqli->query($upit2);

    ?> 
    <h2>Kreiranje specifikacije</h2><br>
    <form action="" method="post">
        <div class="form-group">
            <label class="control-label col-md-2" for="DatumKreiranja">Datum kreiranja</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="DatumKreiranja" name="DatumKreiranja" type="date" value="<?php echo $DatumKreiranja ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="SifRez">Šifra rezervacije</label>
            <div class="col-md-10">
                <input  class="form-control text-box single-line" name="SifRez" readonly id="SifRez" type="number" value="<?php echo $SifraRezervacije ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="SifraGosta">Šifra gosta</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="SifraGosta" name="SifraGosta" type="number" value="<?php echo $SifraGosta ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="SifraPonude">Ponuda</label>
            <div class="col-md-10">
                <select class="form-control select" data-val="true" required data-val-required="Morate odabrati ponudu." id="SifraPonude" name="SifraPonude">
                    <?php
                    while($red2=$rez2->fetch_assoc())
                    { ?>
                    <option value="<?php echo $red2['SifraPonude'] ?>"><?php echo $red2['NazivPonude'] .'&nbsp'. $red2['Popust'] . "%"?></option><br>
                <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="RedniBrojMesta">Redni broj mesta</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="RedniBrojMesta" name="RedniBrojMesta" type="number" value="<?php echo $RedniBrojMesta ?>">
            </div>
        </div>

        <div class="form-group">
                <label class="control-label col-md-2" for="SatorPrikolica">Sator / Prikolica</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" readonly id="SatorPrikolica" name="SatorPrikolica" type="number" value="<?php echo $SatorPrikolica ?>">
                </div>
            </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="KorisnikID">KorisnikID</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="KorisnikID" name="KorisnikID" type="number" value="<?php echo $KorisnikID ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2" for="BrojNocenja">Broj nocenja</label>
            <div class="col-md-10">
                <input class="form-control text-box single-line" readonly id="BrojNocenja" name="BrojNocenja" type="number" value="<?php echo $BrojNocenja ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" value="Sacuvaj" name="Sacuvaj" class="btn btn-default"> 
            </div><br>
        </div>
        <div>
        <a class="btn btn-info btn-sm active" href="rezervacijaIndex.php?cmd=cek">Odustani - nazad na rezervacije</a>
        </div>
</form><br>

    <?php
    }    
    else
    {
        if(isset($_POST['SifraPonude']))
        {
            $SifraPonude = $_POST['SifraPonude'];

            $upit3 = "Insert into specifikacija (DatumKreiranja, SifraRezervacije, SifraGosta, SifraPonude, RedniBrojMesta, SatorPrikolica , KorisnikID, BrojNocenja) values ('".$_POST['DatumKreiranja']."',".$_POST['SifRez'].",".$_POST['SifraGosta'].",".$_POST['SifraPonude'].",".$_POST['RedniBrojMesta'].",".$_POST['SatorPrikolica'].",".$_POST['KorisnikID'].",".$_POST['BrojNocenja'].")";
            $rez3 = $mysqli->query($upit3);

            if(!$rez3)
            {
                die("Greska: ".$mysqli->error);
            }
            else
            { ?>
                <h3>Uspesno ste kreirali specifikaciju!</h3>
                <div>
                    <a class="btn btn-info btn-sm active" href="rezervacijaIndex.php?cmd=cek">Nazad na listu rezervacija</a>
                </div><br>
                <div>
                    <a class="btn btn-info btn-sm active" href="specifikacije.php?sve">Pregled specifikacija</a>
                </div>
        <?php   
                $upit4 = "UPDATE rezervacija SET StatusRezervacije='realizovana' WHERE SifraRezervacije=".$_POST['SifRez'];
                $rez4 = $mysqli->query($upit4);

                $upit5 = "UPDATE gost SET StatusGosta='Odjavljen' WHERE SifraGosta=".$_POST['SifraGosta'];
                $rez5 = $mysqli->query($upit5);
            }
        }
        else
        {
            echo '<script type="text/javascript">alert("Morate odabrati ponudu kako bi ste kreirali specifikaciju!");</script>';
        }
    } 
}
else
{ ?>
    <h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br><br>
    <strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a></strong><br><br>

<?php
} 
?>