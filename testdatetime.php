<form action="testdatetime.php" method="post">
    <input type="datetime-local" name="datetime">
    <button type="submit">Submit</button>
</form>


<?php
    // echo $_POST["datetime"];
    echo date("Y-m-d H:i:s", strtotime($_POST["datetime"]));
    // echo date("Y-m-d h:i:sa", $_POST["datetime"]);
?>