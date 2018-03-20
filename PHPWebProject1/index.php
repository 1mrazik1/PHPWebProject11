<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {
            color: #FF0000;
        }

        p.sansserif {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" >
        <link rel="stylesheet" href="my.css" >
       
    <meta charset="utf-8" />
</head>
<body>
    <p class="sansserif">
        <?php
        //phpinfo();
        //echo "ahoj dusan";
        // include 'tabulka.php';
        //$sql = "INSERT INTO myguests (firstname, lastname, email)
        //VALUES ('dusan', 'mraz', '1mrazik1@gmail.com')";

        $menoErr = $emailErr = $pohlavieErr = $strankaErr = "";
        $meno = $email = $pohlavie = $koment = $stranka = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["meno"])) {
                $menoErr = "Meno je potrebné";
            } else {
                $meno = test_input($_POST["meno"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$meno)) {
                    $menoErr = "Povolené sú len písmená a medzery";
                }
            }
            if (empty($_POST["email"])) {
                $emailErr = "Email je potrebný";
            } else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Zlý vložený formát emailu";
                }
            }
            if (empty($_POST["stranka"])) {
                $stranka = "";
            } else {
                $stranka = test_input($_POST["stranka"]);
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$stranka)) {
                    $strankaErr = "Zlé URL";
                }
            }
            if (empty($_POST["koment"])) {
                $koment = "";
            } else {
                $koment = test_input($_POST["koment"]);
            }

            if (empty($_POST["pohlavie"])) {
                $pohlavieErr = "Pohlavie je potrebné";
            } else {
                $pohlavie = test_input($_POST["pohlavie"]);
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //$conn->close();
        ?>
        <h2>Príklad validácie formulára</h2>
        <p>
            <span class="error">* tieto informácie sú nutné.</span>
        </p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Meno:
            <input type="text" name="meno" value="<?php echo $meno;?>" />
            <span class="error">
                * <?php echo $menoErr;?>
            </span>
            <br />
            <br />
            E-mail:
            <input type="text" name="email" value="<?php echo $email;?>" />
            <span class="error">
                * <?php echo $emailErr;?>
            </span>
            <br />
            <br />
            Stránka:
            <input type="text" name="stranka" value="<?php echo $stranka;?>" />
            <span class="error">
                * <?php echo $strankaErr;?>
            </span>
            <br />
            <br />
            Komentár:
            <textarea name="koment" rows="5" cols="40">
                <?php echo $koment;?>
            </textarea>
            <br />
            <br />
            Pohlavie:
            <input type="radio" name="pohlavie" <?php if (isset($pohlavie) && $pohlavie=="žena") echo "checked";?> value="žena" />žena
            <input type="radio" name="pohlavie" <?php if (isset($pohlavie) && $pohlavie=="muž") echo "checked";?> value="muž" />muž
            <span class="error">
                * <?php echo $pohlavieErr;?>
            </span>
            <br />
            <br />
            <input type="submit" name="submit" value="Odoslať" />
            <br>
            
        </form>
        <?php
        echo "<h2>Tvoje vložené informácie:</h2>";
        if (!preg_match("/^[a-zA-Z ]*$/",$meno)) {
            $menoErr = "Povolené sú len písmená a medzery";
        } else {echo $meno;}
        echo "<br>";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Zlý vložený formát emailu";
        } else {echo $email;}
        echo "<br>";
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$stranka)) {
            $strankaErr = "Zlé URL";
        } else {echo $stranka;}
        echo "<br>";
        echo $koment;
        echo "<br>";
        echo $pohlavie;
        ?>
    </p>
    <a href="tabulka.php"><input type="submit" name="submit" value="TABULKA" /></a>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>