<?php
session_start();

if (!isset($_SESSION['drinks'])) {
    $_SESSION['drinks'] = ["Milk" => 0, "Soft Drink" => 0];
}

if (!isset($_SESSION['worker'])) {
    $_SESSION['worker'] = "";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (!empty($_POST['worker'])) {
    $_SESSION['worker'] = htmlspecialchars($_POST['worker']);
    }

    $product  = $_POST['position'];   
    $quantity = intval($_POST['value']);

    if (isset($_POST['add'])) {
        if ($product == "Milk") {
            $_SESSION['drinks']['Milk'] = $_SESSION['drinks']['Milk'] + $quantity;
        }
        if ($product == "Soft Drink") {
            $_SESSION['drinks']['Soft Drink'] = $_SESSION['drinks']['Soft Drink'] + $quantity;
        }
    } elseif (isset($_POST['remove'])) {
        if ($product == "Milk") {
            if ($quantity > $_SESSION['drinks']['Milk']) {
                $error = "No quedan mas unidades que quitar";
            } else {
                $_SESSION['drinks']['Milk'] = $_SESSION['drinks']['Milk'] - $quantity;
            }
        }
        if ($product == "Soft Drink") {
            if ($quantity > $_SESSION['drinks']['Soft Drink']) {
                $error = "Error: no hay suficientes unidades";
            } else {
                $_SESSION['drinks']['Soft Drink'] = $_SESSION['drinks']['Soft Drink'] - $quantity;
            }
        }
    } elseif (isset($_POST['reset'])) {
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 2</title>
</head>
<body>

<h1>Supermarket manegement</h1>

<form method="post">

    <label>Worker name</label>
    <input type="text" name="worker" value="<?php echo $_SESSION['worker']; ?>">
    <br><br><br>

<h2>Choose product:</h2>
    <select name="position">
        <?php
        foreach ($_SESSION['drinks'] as $index => $value) {
                echo "<option value='$index'>$index</option>";
        }
        ?>
    </select>
    <br><br>

<h2>Product quantity:</h2>

    <input type="text" name="value">
    <br><br>

    <button type="submit" name="add">add</button>
    <button type="submit" name="remove">remove</button>
    <button type="submit" name="reset">reset</button>

</form>
    
<h2>Inventory:</h2>

<p>worker: <?php echo $_SESSION['worker']; ?></p>
<p>units milk: <?php echo $_SESSION['drinks']['Milk']; ?></p>
<p>units soft drink: <?php echo $_SESSION['drinks']['Soft Drink']; ?></p>


</body>
</html>