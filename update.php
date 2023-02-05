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

    $sql = "SELECT * FROM pizza WHERE id=:id";
    $stmnt = $pdo->prepare($sql);
    $stmnt->bindValue(":id", $_GET["id"], PDO::PARAM_STR);
    $stmnt->execute();

    $data = $stmnt->fetch(PDO::FETCH_OBJ);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "UPDATE pizza SET bodem=:bdm, saus=:ss, topping=:tpn, kruiden=:krd WHERE id=:id";
        $stmnt = $pdo->prepare($sql);

        $stmnt->bindValue(":id", $_POST["id"]);
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
        header("Location: index.php");
    }
    ?>
    <h1>Update je pizza</h1>
    <form action="" method="post">
        <h3>Bodemformaat</h3>
        <select name="bodem">
            <option value="keuze">Maak je keuze</option>
            <?php
            $bodemOptions = array(20, 25, 30, 35, 40);
            foreach ($bodemOptions as $value) {
                $current = $value == $data->bodem ? "selected" : "";
                echo "<option value='$value' $current>$value Centimeter</option>";
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
                $current = $value == $data->saus ? "selected" : "";
                echo "<option value='$value' $current>$value</option>";
            }
            ?>
        </select>
        <h3>Toppings</h3>
        <?php
        $toppingOptions = array("Vegan", "Vegetarisch", "Vlees");
        foreach ($toppingOptions as $value) {
            $current = $value == $data->topping ? "checked" : "";
            echo "<div><input type='radio' name='topping' value='$value' id='$value' $current><label for='$value'>$value</label></div>";
        }
        ?>
        <h3>Kruiden</h3>
        <?php
        $kruidenOptions = array("Peterselie", "Oregano", "Chili flakes", "Zwarte peper");
        $kruiden = explode(",", $data->kruiden);
        foreach ($kruidenOptions as $value) {
            $current = in_array($value, $kruiden) ? "checked" : "";
            echo "<div><input type='checkbox' name='kruiden[]' value='$value' id='$value' $current><label for='$value'>$value</label></div>";
        }
        ?>
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <button type="submit">Update order</button>
    </form>
</body>

</html>