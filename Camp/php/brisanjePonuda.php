<?php 
if(isset($_SESSION['Nivo']) && $_SESSION['Nivo'] < 4)
{
    require_once("php/konekcija.php");
    if(!isset($_POST["Izbrisi"]))
    {
        $upit = "SELECT * FROM ponuda where SifraPonude = '" . $_GET['idPonuda'] . "'";
        $rez=$mysqli->query($upit);

 ?>
	<h2>Brisanje ponude</h2><br><br>
	<form action="brisanjePonude.php" method="post">
	    <table class="table table-hover">
            <thead>
                <tr>
                    <th>Sifra ponude</th>
                    <th>NazivPonude</th>
                    <th>Opis</th>
                    <th>Popust</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($red=$rez->fetch_assoc()) 
                {
                    ?>
                    <tr>
                        <td width="60"><?php echo $red['SifraPonude']; ?></td>
                        <td width="150"><?php echo $red['NazivPonude']; ?></td>
                        <td width="150"><?php echo $red['Opis']; ?></td>
                        <td width="120"><?php echo $red['Popust']; ?></td>
                        <td>
                        <input type="hidden" name="idP" value="<?php echo $red['SifraPonude']; ?>"></td>
                    </tr>
                    <?php 
                }

            if($rez->num_rows < 1)
            {  ?>
              <h3>Nije moguce prikazati detalje zeljene ponude! </h3><br>
            <strong><a style="color:black; font-size: 20px;" href="ponudaIndex.php">Povratak na listu ponuda⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;"></a><br>
            </strong> 
                
    <?php   }
            
            ?>
                
            </tbody>
        </table><br>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" value="Izbrisi" name="Izbrisi" class="btn btn-default">
        </div><br>
        <div>
            <a class="btn btn-info btn-sm active" href="ponudaIndex.php">Odustani - nazad na listu</a>
        </div>
    </div>
</form>
<?php 
    }
    else if($_POST['Izbrisi'] = "Izbrisi")
    {
        $upit = "UPDATE ponuda set Obrisan = 1 where SifraPonude = '" . $_POST['idP'] . "'";
        $rez = $mysqli->query($upit); 
        
        if(!$rez)
        { 
            echo "<strong><p style='color: black; font-size: 20px;'>Greska prilikom brisanja!!!</p></strong>";
        }
        else
        {  ?>
            <h3>Uspesno ste izbrisali ponudu!</h3>
            <div>
                <a class="btn btn-info btn-sm active" href="ponudaIndex.php">Nazad na listu</a>
            </div>     
<?php 
        } 
    }
}else
{
    ?>
        <h3>Niste ulogovani, nemate mogucnost ove radnje!</h3><br><br>
        <strong><a style="color:black; font-size: 20px;" href="http://localhost/Kamp/pocetna.php">Povratak na pocetnu stranu⮌</a> &emsp; &emsp; &emsp;<a style="color:black; font-size: 20px;" href="http://localhost/Kamp/logovanje.php">Ulogujte se ⮎</a><br><br> 
        </strong>
<?php }  ?>