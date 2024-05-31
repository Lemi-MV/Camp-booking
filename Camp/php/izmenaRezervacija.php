<?php
if (isset($_SESSION['Nivo'])) {
    require_once("php/konekcija.php");
    if (isset($_GET["sifrez"])) {
        $SifraRezervacije = $_GET["sifrez"];
        $upit = "SELECT * FROM rezervacija WHERE SifraRezervacije='" . $SifraRezervacije . "'";
        $rez = $mysqli->query($upit);
        $red = $rez->fetch_assoc();

        $upit2 = "SELECT * FROM gost";
        $rez2 = $mysqli->query($upit2);  ?>

        <h2>Izmena rezervacije</h2><br><br>

<?php   if($_SESSION['Nivo'] < 6){  ?>

        <h4><strong> VAZNA NAPOMENA! </strong> Izmenu rezervacije koristite ukoliko zelite da promenite <i>Status rezervacije, Gosta (SifraGosta), Broj kampera</i> ili <i>Napomenu</i>. Ukoliko zelite da promenite <i>Redni broj mesta, Datum pocetka</i> ili <i>Datum zavrsetka</i> potrebno je da <i>Status rezervacije</i> promenite u Otkazana i zatim kreirate NOVU rezervaciju! 
        Brisanje rezervacije je promena <i>Statusa rezervacije</i> u Otkazana. Hvala na razumevanju!</h4>

<?php   }   ?>
        
        <br><br><br>
        <form action="izmenaRezervacije.php" method="post">
            <div class="form-group">
                <label class="control-label col-md-2" for="SifraRezervacije">Šifra rezervacije</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" readonly  name="SifraRezervacije" id="SifraRezervacije" type="number" value="<?php echo $red['SifraRezervacije'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="RedniBrojMesta">Redni broj mesta</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" readonly id="RedniBrojMesta" name="RedniBrojMesta" type="number" value="<?php echo $red['RedniBrojMesta'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="SatorPrikolica">Sator / Prikolica</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" id="SatorPrikolica" readonly name="SatorPrikolica" type="number" value="<?php echo $red['SatorPrikolica'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="DatumPocetka">Datum početka</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" readonly id="DatumPocetka" name="DatumPocetka" onchange="OnChangeEvent();" type="date" value="<?php echo $red['DatumPocetka'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="DatumZavrsetka">Datum zavrsetka</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" readonly id="DatumZavrsetka" min="" name="DatumZavrsetka" type="date" value="<?php echo $red['DatumZavrsetka'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="BrojKampera">Broj kampera </label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" required id="BrojKampera" name="BrojKampera" min=1 type="number" value="<?php echo $red['BrojKampera'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="StatusRezervacije">Status rezervacije</label>
                <div class="col-md-10">
                    <select class="form-control select" data-val="true" required id="StatusRezervacije" name="StatusRezervacije">
                <?php   if ($red['StatusRezervacije'] == 'cekanje') 
                        { ?>
                            <option value="cekanje" selected>cekanje</option>
                            <option value="aktivna">aktivna</option>
                            <option value="realizovana">realizovana</option>
                            <option value="otkazana">otkazana</option>
                        <?php 
                        }
                        elseif ($red['StatusRezervacije'] == 'aktivna') 
                        { ?>
                            <option value="cekanje">cekanje</option>
                            <option value="aktivna" selected>aktivna</option>
                            <option value="realizovana">realizovana</option>
                            <option value="otkazana">otkazana</option>
                        <?php  
                        } 
                        elseif ($red['StatusRezervacije'] == 'realizovana') 
                        { ?>
                        <option value="cekanje">cekanje</option>
                        <option value="aktivna">aktivna</option>
                        <option value="realizovana" selected>realizovana</option>
                        <option value="otkazana">otkazana</option>
                        <?php 
                        } 
                        elseif ($red['StatusRezervacije'] == 'otkazana') 
                        { ?>
                        <option value="cekanje">cekanje</option>
                        <option value="aktivna">aktivna</option>
                        <option value="realizovana">realizovana</option>
                        <option value="otkazana" selected>otkazana</option>
                        <?php 
                        } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="Gost">Gost</label>
                <div class="col-md-10">
                    <select class="form-control select" required data-val="true" id="Gost" name="Gost">
                        <?php
                        $odabrano = "";
                        while ($red2 = $rez2->fetch_assoc()) {
                            if ($red2['SifraGosta'] == $red['SifraGosta']) {
                                $odabrano = "selected";
                            } 
                            else 
                            {
                                $odabrano = "";
                            } ?>
                            <option value="<?php echo $red2['SifraGosta'] ?>" <?php echo $odabrano ?>> <?php echo $red2['SifraGosta'] . '&nbsp' . $red2['Ime'] . '&nbsp' . $red2['Prezime'] . '&nbsp' . $red2['BrojLicneKarte'] ?></option><br>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="Napomena">Napomena</label>
                <div class="col-md-10">
                    <input class="form-control text-box single-line" id="Napomena" name="Napomena" type="text" value="<?php echo $red['Napomena'] ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Izmeni" name="Izmeni" class="btn btn-default">
                </div><br>
            </div>
            <div>
                <a class="btn btn-info btn-sm active" href="rezervacijaIndex.php?cmd=cek">Odustani - nazad na listu</a>
            </div>
            </div>
        </form><br>
        <?php
    }
    elseif ($_POST['Izmeni'] == "Izmeni") 
    {
        if (isset($_POST['StatusRezervacije']) && isset($_POST['Gost'])) 
        {
            $upit3 = "UPDATE rezervacija SET StatusRezervacije='" . $_POST['StatusRezervacije'] . "', SifraGosta=" . $_POST['Gost'] . ", BrojKampera=" . $_POST['BrojKampera'] . ", Napomena='" . $_POST['Napomena'] . "' WHERE SifraRezervacije=" . $_POST['SifraRezervacije'];
            $rez3 = $mysqli->query($upit3);
            $statRez = $_POST['StatusRezervacije'];
            $sifGos = $_POST['Gost'];

            if (!$rez3) 
            {
                die("Greska: " . $mysqli->error);
            } 
            else 
            { ?>
                <h3>Uspesno ste izmenili rezervaciju!</h3>
                <div>
                    <a class="btn btn-info btn-sm active" href="rezervacijaIndex.php?cmd=cek">Nazad na listu</a>
                </div>
    <?php
                if ($statRez == "aktivna") 
                {
                    $upit4 = "UPDATE gost SET StatusGosta='Prijavljen' where SifraGosta=" . $sifGos;
                    $rez4 = $mysqli->query($upit4);
                }
            }
        } 
        else 
        {
            echo '<script type="text/javascript">alert("Svi podaci moraju biti uneti kako bi ste sacuvali izmene rezervacije!");</script>';
        }
    }
} else { ?>
    <h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br>
    <strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br>
    </strong>
<?php
} ?>

<script>
    function OnChangeEvent() {

        var pocetniDatum = document.getElementById('DatumPocetka').value;
        var datumZavrsetka = document.getElementById('DatumZavrsetka').value;

        document.getElementById("DatumZavrsetka").setAttribute('min', pocetniDatum);
        document.getElementById("DatumZavrsetka").removeAttribute("readonly");

        document.getElementById("DatumZavrsetka").value = pocetniDatum;
    }
</script>