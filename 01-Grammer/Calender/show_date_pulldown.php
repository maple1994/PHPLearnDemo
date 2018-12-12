<!DOCTYPE html>
<html>
<head>
    <title>Using the date_pulldown class</title>
    <?php
    include 'date_pulldown.php';
    $date1 = new date_pulldown('fromdate');
    $date2 = new date_pulldown('todate');
    $date3 = new date_pulldown('foundingdate');
    $date3->setYearStart("1972");
//    if($empty($foundingdate)) {
    $date3->setDate_array(array('mday'=>26, 'mon'=>4, 'year'=>1984));
//    }
    ?>
</head>
<body>
<form method="get">
    <p>
        From:
        <br>
        <?echo $date1->output();?>
    </p>

    <p>
        to:
        <br>
        <?echo $date2->output();?>
    </p>
    <p>
        Company Founded:
        <br>
        <?echo $date3->output();?>
    </p>

    <button type="submit">Submit</button>
</form>
</body>
</html>
