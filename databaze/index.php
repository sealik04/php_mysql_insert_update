<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Databáze</title>
</head>
<body>
<form action="index.php" method="post">
    <h2>vložení záznamu do databáze</h2>

    <input type="text" name="first_name"
           placeholder="jméno žáka"><br>

    <input type="text" name="last_name"
           placeholder="příjmení žáka"><br>

    <input type="submit" name="insert_submit" value="odeslat">

    <h2>úprava záznamu v databázi</h2>

    <input type="text" name="selected_first"
    placeholder="jméno žáka k editaci"><br>

    <input type="text" name="selected_last"
           placeholder="příjmení žáka k editaci"><br>

    <input type="text" name="edit_first"
           placeholder="nové jméno"><br>

    <input type="text" name="edit_last"
    placeholder="nové příjmení"><br>

    <input type="submit" name="edit_submit" value="odeslat">
    <br>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "lidi");
    if(isset($_POST["insert_submit"])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];

        if ($first_name && $last_name) {
            $sql_query = "INSERT INTO seznam (JMENO, PRIJMENI) VALUES ('$first_name', '$last_name')";

            $result = mysqli_query($connection, $sql_query);
            if(!$result){
                die("je to v piči");
            }
        }
    }

    if(isset($_POST["edit_submit"])) {
        $selected_first = $_POST["selected_first"];
        $selected_last = $_POST["selected_last"];

        $name_to_change_to_first = $_POST["edit_first"];
        $name_to_change_to_last = $_POST["edit_last"];
        if ($selected_first && $name_to_change_to_last && $name_to_change_to_first && $name_to_change_to_last) {
            $update_query = "UPDATE seznam SET jmeno = '$name_to_change_to_first', prijmeni = '$name_to_change_to_last' WHERE jmeno = '$selected_first' AND prijmeni = '$selected_last'";

            echo "jméno a příjmení, které se má upravit: " . $selected_first . " ". $selected_last;
            echo "<br>";
            echo "změněné jméno a příjmení: " . $name_to_change_to_first . " " . $name_to_change_to_last;

            $update_result = mysqli_query($connection, $update_query);
            if (!$update_result) {
                die('Error in update query: ' . mysqli_error($connection));
            }

        } else {
            "error";
        }
    }
    ?>
</form>
</body>
</html>