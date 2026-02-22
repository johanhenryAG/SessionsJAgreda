<?php
session_start();

if (!isset($_SESSION['numbers'])) {
    $_SESSION['numbers'] = [10, 20, 30];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['modify'])) {
        $position = (int)$_POST['position'];
        $value = (int)$_POST['value'];
        $_SESSION['numbers'][$position] = $value;
    }

    if (isset($_POST['average'])) {
        $average = array_sum($_SESSION['numbers']) / count($_SESSION['numbers']);
    }

    if (isset($_POST['reset'])) {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['numbers'] = [10, 20, 30];

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 1</title>
</head>
<body>

<h2>Modify array saved in session</h2>

<form method="post">
    <label>
        Position to modify:
        <select name="position">
            <?php
            foreach ($_SESSION['numbers'] as $index => $value) {
                echo "<option value='$index'>$index</option>";
            }
            ?>
        </select>
    </label>
    <br><br>

    <label>New value:</label>
    <input type="text" name="value">
    <br><br>

    <button type="submit" name="modify">Modify</button>
    <button type="submit" name="average">Average</button>
    <button type="submit" name="reset">Reset</button>
</form>

<p>Current array: <?php echo implode(", ", $_SESSION['numbers']); ?></p>

<?php 
if (isset($average)) {
    echo "<p> Average: " . $average . "</p>";
} ?>

</body>
</html>
