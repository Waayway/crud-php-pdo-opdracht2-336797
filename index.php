<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maak zelf je pizza</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php 
        require "connect.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $sql = "INSERT INTO pizza VALUES (null, :bdm, :ss, :tpn, :krd)";
            $stmnt = $pdo->prepare($sql);

            $stmnt->bindValue(":bdm", $_POST["bodem"], PDO::PARAM_STR);
            $stmnt->bindValue(":ss", $_POST["saus"], PDO::PARAM_STR);
            $stmnt->bindValue(":tpn", $_POST["topping"], PDO::PARAM_STR);
            $kruiden = $_POST["kruiden"];
            $kruidOutput = "";
            foreach ($_POST["kruiden"] as $value) {
                $kruidOutput .= $value . ",";
            }
            $stmnt->bindValue(":krd", $kruidOutput, PDO::PARAM_STR);

            $stmnt->execute();
            header("Refresh: 0");
        }
    ?>
    <h1>Maak zelf je pizza</h1>
    <form action="" method="post">
        <h3>Bodemformaat</h3>
        <select name="bodem">
            <option value="keuze">Maak je keuze</option>
            <?php
            $bodemOptions = array(20, 25, 30, 35, 40);
            foreach ($bodemOptions as $value) {
                echo "<option value='$value'>$value Centimeter</option>";
            }
            ?>
        </select>
        <h3>Saus</h3>
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
        <h3>Toppings</h3>
        <?php
        $toppingOptions = array("Vegan", "Vegetarisch", "Vlees");
        foreach ($toppingOptions as $value) {
            echo "<div><input type='radio' name='topping' value='$value' id='$value'><label for='$value'>$value</label></div>";
        }
        ?>
        <h3>Kruiden</h3>
        <?php
        $kruidenOptions = array("Peterselie", "Oregano", "Chili flakes", "Zwarte peper");
        foreach ($kruidenOptions as $value) {
            echo "<div><input type='checkbox' name='kruiden[]' value='$value' id='$value'><label for='$value'>$value</label></div>";
        }
        ?>
        <button type="submit">Bestel</button>
    </form>
    <?php 
        $sql = "SELECT * FROM pizza";
        $stmnt = $pdo->prepare($sql);
        $stmnt->execute();
        $data = $stmnt->fetchAll(PDO::FETCH_OBJ);
    ?>
    <table>
        <thead>
            <tr>
                <th>Bodem formaat</th>
                <th>Saus</th>
                <th>Topping</th>
                <th>Kruiden</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($data as $value) {
                    echo "<tr>";
                    echo "<td>$value->bodem</td>";
                    echo "<td>$value->saus</td>";
                    echo "<td>$value->topping</td>";
                    echo "<td>$value->kruiden</td>";
                    echo "</tr>";
                }            
            ?>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>

</html>