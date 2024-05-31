<?php

if(isset($_SESSION['Nivo']))
{
    require_once("php/konekcija.php");

    if($_SESSION['Nivo'] < 6 )
    {
        if(!isset($_POST['dugme']))
        {
            ?>
            <h2>Kreiranje novog gosta</h2>
            <form action="kreiranjeGosta.php" method="post" id="gostForma">
                <div class="form-group">
                    <label class="control-label col-md-2" for="Ime">Ime</label>
                    <div class="col-md-10">
                        <input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti ime gosta." id="Ime" name="Ime" type="text" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2" for="Prezime">Prezime</label>
                    <div class="col-md-10">
                        <input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti prezime gosta." id="Prezime" name="Prezime" type="text" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2" for="BrojLicneKarte">Broj lične karte</label>
                    <div class="col-md-10">
                        <input class="form-control text-box single-line" data-val="true" required data-val-range="Dozvoljene su samo pozitivni brojevi duzine 9 cifara" max="999999999" min="100000000" data-val-required="Morate uneti broj lične karte gosta." id="BrojLicneKarte" name="BrojLicneKarte" type="text" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2" for="Adresa">Adresa</label>
                    <div class="col-md-10">
                        <input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti adresa gosta." id="Adresa" name="Adresa" type="text" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2" for="BrojTelefona">Broj telefona</label>
                    <div class="col-md-10">
                    <input class="form-control text-box single-line" data-val="true" placeholder="06x/xxx-xxx(x)" required data-val-required="Morate uneti broj telefona gosta." id="BrojTelefona" name="BrojTelefona" type="text" value="">
                </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2" for="StatusGosta">Status gosta</label>
                    <div class="col-md-10">
                        <select class="form-control select" data-val="true" required data-val-required="Morate odabrati status gosta." id="StatusGosta" name="StatusGosta">
                            <option value="Odjavljen">Odjavljen</option>
                            <option value="Prijavljen">Prijavljen</option>  
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Kreiraj" name="dugme" class="btn btn-default">
                    </div>
                </div>
            </form>
            <br>
            <div>
                <a class="btn btn-info btn-sm active" href="gostIndex.php?gos=svi">Odustani - povratak na listu</a>
            </div>

            <?php 
        }
        elseif(isset($_POST['dugme']))
        {
            if(!empty($_POST['Ime']) && !empty($_POST['Prezime']) && !empty($_POST['BrojLicneKarte']) && !empty($_POST['Adresa']) && !empty($_POST['BrojTelefona']) && !empty($_POST['StatusGosta']))
            {
                $upit = "Insert into gost (KorisnikID,Ime,Prezime,BrojLicneKarte,Adresa,BrojTelefona,StatusGosta)
                values ('".$_SESSION['ID']."','".$_POST['Ime']."','".$_POST['Prezime']."','".$_POST['BrojLicneKarte']."','".$_POST['Adresa']."','".$_POST['BrojTelefona']."','".$_POST['StatusGosta']."')";
                if(!$rez=$mysqli->query($upit))
                {
                    die("Greska: ".$mysqli->error);
                }
                else
                    {  ?>
                        <h3>Uspesno ste uneli gosta!</h3>
                        <div>
                            <a class="btn btn-info btn-sm active" href="gostIndex.php?gos=svi">Nazad na listu</a>
                        </div>
                    <?php   }
            }
            else
            {
                echo '<script type="text/javascript">alert("Morate uneti sve podatke kako bi ste uneli gosta!");</script>';
            }
        }  
    }
    elseif($_SESSION['Nivo'] > 6 )
    {
        if(!isset($_POST['dugme']))
        {
                ?>
                <h2>Unos licnih podataka</h2>
                <form action="kreiranjeGosta.php" method="post" id="gostForma">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="Ime">Ime</label>
                        <div class="col-md-10">
                            <input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti ime gosta." id="Ime" name="Ime" type="text" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="Prezime">Prezime</label>
                        <div class="col-md-10">
                            <input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti prezime gosta." id="Prezime" name="Prezime" type="text" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="BrojLicneKarte">Broj lične karte</label>
                        <div class="col-md-10">
                            <input class="form-control text-box single-line" data-val="true" required data-val-range="Dozvoljene su samo pozitivni brojevi duzine 9 cifara" max="999999999" min="100000000" data-val-required="Morate uneti broj lične karte gosta." id="BrojLicneKarte" name="BrojLicneKarte" type="text" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="Adresa">Adresa</label>
                        <div class="col-md-10">
                            <input class="form-control text-box single-line" data-val="true" required data-val-required="Morate uneti adresu gosta." id="Adresa" name="Adresa" type="text" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="BrojTelefona">Broj telefona</label>
                        <div class="col-md-10">
                            <input class="form-control text-box single-line" data-val="true" placeholder="06x/xxx-xxx(x)" required data-val-required="Morate uneti broj telefona gosta." id="BrojTelefona" name="BrojTelefona" type="text" value="">
                        </div>
                    </div>
                    <br><br><br>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <input type="submit" value="Kreiraj" name="dugme" class="btn btn-default">
                        </div>
                    </div>
                </form>
                <br>
                <div>
                    <a class="btn btn-info btn-sm active" href="gostIndex.php?gos=svi">Odustani - povratak na prethodnu stranu</a>
                </div>

                <?php 
        }
        elseif(isset($_POST['dugme']))
        {
                if(!empty($_POST['Ime']) && !empty($_POST['Prezime']) && !empty($_POST['BrojLicneKarte']) && !empty($_POST['Adresa']) && !empty($_POST['BrojTelefona']))
                {
                    $upit = "INSERT INTO gost (KorisnikID, Ime, Prezime, BrojLicneKarte, Adresa, BrojTelefona) VALUES (".$_SESSION['ID'].", '".$_POST['Ime']."', '".$_POST['Prezime']."', '".$_POST['BrojLicneKarte']."', '".$_POST['Adresa']."', '".$_POST['BrojTelefona']."')";

                        if(!$rez=$mysqli->query($upit))
                        {
                            die("Greska: ".$mysqli->error);
                        }
                        else
                            {  ?>
                                <h3>Uspesno ste uneli svoje licne podatke!</h3>
                                <div>
                                    <a class="btn btn-info btn-sm active" href="gostIndex.php?gos=svi">Nazad na listu</a>
                                </div>
                            <?php   }
                        }
                        else
                        {
                            echo '<script type="text/javascript">alert("Morate uneti sve podatke kako bi ste uneli gosta!");</script>';
                        }
        }  

    }
}else
{  ?>  
	<h3>Niste ulogovani, ili nemate pravo pristupa ovom sektoru!</h3><br>
	<strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br>
	</strong>
<?php 
} ?>
<script>
    var brojTelefonaInput = document.getElementById("BrojTelefona");
    var phoneRegex = /^(06\d\/\d{3}\-\d{3,4})$/

    // /^(06\d\/\d{3}\-\d{3,4})$/         moj regex
    // /^06\d\/\d{3}-\d{3}(-\d{1,3})?$/  izvorni regex

    function validatePhoneNumber() {
        var brojTelefona = brojTelefonaInput.value;

        if (phoneRegex.test(brojTelefona)) {
            return true;
        } else {
            alert("Morate uneti broj telefona u ispravnom formatu: 06x/xxx-xxx(x)");
            return false;
        }
    }

    brojTelefonaInput.addEventListener("blur", validatePhoneNumber);

</script>
