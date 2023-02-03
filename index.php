<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maak zelf je pizza</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: sans-serif;
        }
    </style>
</head>

<body>
    <h1>Maak zelf je pizza</h1>
    <form action="" method="post">
        <select name="bodem">
            <option value="keuze">Maak je keuze</option>
            <?php
            $bodemOptions = array(20, 25, 30, 35, 40);
            foreach ($bodemOptions as $value) {
                echo "<option value='$value'>$value Centimeter</option>";
            }
            ?>
        </select>
        <select name="saus">
            <option value="keuze">Maak je keuze</option>
            <?php
            $sausOptions = array(
                "Tomatensaus", "Extra tomatensaus", "Spicy tomatensaus", "BBQ saus", "Crème fraiche"
            );
            foreach ($sausOptions as $value) {
                echo "<option value='$value'>$value</option>";
            }
            ?>
        </select>
        <?php 
        $toppingOptions = array("Vegan", "Vegetarisch", "Vlees");
        foreach ($toppingOptions as $value) {
            echo "<input type='radio' name='topping' value='$value' id='$value'><label for='$value'>$value</label>";
        }
        ?>
    </form>
</body>

</html>