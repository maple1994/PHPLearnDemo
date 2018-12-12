<?php
define("ADAY", (60 * 60 * 24));
if (!isset($_POST["month"]) || !isset($_POST["year"])) {
    $nowArr = getdate();
    $month = $nowArr['mon'];
    $year = $nowArr['year'];
}else {
    $month = $_POST["month"];
    $year = $_POST["year"];
}
$start = mktime(12, 0, 0, $month, 1, $year);
$firstDayArray = getdate($start);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calendar <?php echo $firstDayArray['mon'] . " " . $firstDayArray['year']?></title>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
            border: 1px solid black;
            padding: 6px;
            font-weight: bold;
            background: #ccc;
        }
        td {
            border: 1px solid black;
            padding: 6px;
            width: 130px;
        }
    </style>
    <script type="text/javascript">
        function eventWindow(url) {
            var event_popupWin = window.open(url, 'event',
            'resizable=yes, scrollbars=yes, toolbar=no, width=500, height=700');
            event_popupWin.opener = self;
        }
    </script>
</head>
<body>
<h1>
    Select a Month/Year Combination
</h1>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <select name="month">
        <?php
        $monthArr = Array("January", "February", "March", "April", "May",
            "June", "July", "August", "September", "October", "November", "December");
        for($i = 1; $i <= count($monthArr); $i++) {
            echo "<option value=$i";
            if ($i == $month) {
                echo " selected";
            }
            echo ">" . $monthArr[$i - 1] . "</option>";
        }
        ?>
    </select>
    <select name="year">
        <?php
        for($i = 1970; $i <= 2020; $i++) {
            echo "<option value=$i";
            if ($i == $year) {
                echo " selected";
            }
            echo ">" . $i . "</option>";
        }
        ?>
    </select>
    <button type="submit">go</button>
</form>
<br>
<?php
$days = Array("Sun", "Mon", "Tue", "Web", "Thu", "Fri", "Sat");
echo "<table><tr>";
foreach ($days as $day) {
    echo "<th>" . $day . "</th>";
}
for ($count = 0; $count < (6 * 7); $count++) {
    $dayArray = getdate($start);
    // 判断是否需要换行
    if (($count % 7) == 0) {
        if ($dayArray['mon'] != $month) {
            break;
        }else {
            echo "</tr><tr>";
        }
    }
    // 月头不一定是周日开始的,所以这里要跟weekday判断
    // 再判断月份
    if($count < $dayArray['wday'] || $dayArray['mon'] != $month) {
        echo "<td>&nbsp</td>";
    }else {
        $mysqli = mysqli_connect("127.0.0.1:3307", "root", "123456", "test");
        $checkEvent_sql = "select event_title from calendar_events where
        month(event_start)='" . $month ."' and
        dayofmonth(event_start)='" . $dayArray['mday'] . "' and
        year(event_start)='" . $year ."' order by event_start";
        $res = mysqli_query($mysqli, $checkEvent_sql) or die(mysqli_error($mysqli));
        if (mysqli_num_rows($res) > 0) {
            while($ev = mysqli_fetch_array($res)) {
                $event_title .= stripslashes($ev['event_title']) . "<br>";
            }
        }else {
            $event_title = "";
        }
        echo "<td><a href=\"javascript:eventWindow('event.php?m=".$month."&amp;d=".$dayArray['mday']."&amp;y=".$year."');\">". $dayArray['mday'] ."</a>
        <br>$event_title</td>";
        unset($event_title);
        $start += ADAY;
    }
}
echo "</tr>";
echo "</table>";
?>
</body>
</html>
