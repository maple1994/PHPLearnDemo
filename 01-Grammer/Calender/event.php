<!DOCTYPE html>
<html>
<head>
    <title>Show/Add Event</title>
</head>
<body>
<h1>Show/Add Event</h1>
<?php
$mysqli = mysqli_connect("127.0.0.1:3307", "root", "123456", "test");
if ($_POST) {
    $safe_m = mysqli_real_escape_string($mysqli, $_POST['m']);
    $safe_d = mysqli_real_escape_string($mysqli, $_POST['d']);
    $safe_y = mysqli_real_escape_string($mysqli, $_POST['y']);
    $safe_event_title = mysqli_real_escape_string($mysqli, $_POST['event_title']);
    $safe_event_des = mysqli_real_escape_string($mysqli, $_POST['event_des']);
    $safe_event_mm = mysqli_real_escape_string($mysqli, $_POST['event_time_mm']);
    $safe_event_hh = mysqli_real_escape_string($mysqli, $_POST['event_time_hh']);

    $event_date = $safe_y ."-". $safe_m ."-". $safe_d ." ". $safe_event_hh .":". $safe_event_mm .":00";
    $sql = "insert into calendar_events (event_title, event_des, event_start)
values('". $safe_event_title ."', '". $safe_event_des ."', '". $event_date ."')";
    $res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
}else {
    $safe_m = mysqli_real_escape_string($mysqli, $_GET['m']);
    $safe_d = mysqli_real_escape_string($mysqli, $_GET['d']);
    $safe_y = mysqli_real_escape_string($mysqli, $_GET['y']);
}
$get_event_sql = "select event_title, event_des, date_format(event_start, '%l:%i %p') as fmt_date
from calendar_events where month(event_start)='". $safe_m ."'
 and dayofmonth(event_start)='". $safe_d ."'
 and year(event_start)='". $safe_y ."' order by event_start";
$get_event_res = mysqli_query($mysqli, $get_event_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_event_res) > 0) {
    $event_txt = "<ul>";
    while($ev = mysqli_fetch_array($get_event_res)) {
        $fmt_date = $ev['fmt_date'];
        $ev_title = $ev['event_title'];
        $ev_des = $ev['event_des'];
        $event_txt .= "<li><strong>$fmt_date</strong>:$ev_title<br>$ev_des</li>";
    }
    $event_txt .= "</ul>";
}else {
    $event_txt = "";
}
if ($event_txt != '') {
    echo "<p><strong>Today's Events:</strong></p>";
    echo $event_txt . "<hr/>";
}
?>
<p><strong>Would you like to add an event?</strong><br>
    Complete the form below and press the submit button to
    and the vent and refresh this window.
</p>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <p>
        <label for="event_title">Event Title:</label><br>
        <input type="text" name="event_title" id="event_title" size="40">
    </p>
    <p>
        <label for="event_des">Event Description:</label><br>
        <input type="text" name="event_des" id="event_des" size="40">
    </p>
    <fieldset>
        <legend>Event Time (hh:mm):</legend>
        <select name="event_time_hh">
            <?php
            for ($x = 1; $x <= 24; $x++) {
                echo "<option value='$x'>$x</option>";
            }
            ?>
        </select>
        <select name="event_time_mm">
            <option value="00">00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select>
    </fieldset>
    <input type="hidden" name="m" value="<?php echo $safe_m?>">
    <input type="hidden" name="d" value="<?php echo $safe_d?>">
    <input type="hidden" name="y" value="<?php echo $safe_y?>">
    <button type="submit">Add Event</button>
</form>
</body>
</html>