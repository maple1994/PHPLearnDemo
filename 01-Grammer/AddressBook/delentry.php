<?php
include 'include.php';
doDB();

if(!$_POST) {
    $display_block = "<h1>Delete an Entry</h1>";

    $get_list_sql = "select id, concat_ws(', ', l_name, f_name) as display_name
    from master_name order by l_name, f_name";
    $get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));
    if (mysqli_num_rows($get_list_res) < 1) {
        $display_block .= "<p>Sorry, no records</p>";
    } else {
        $display_block .= "
        <form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">
            <p>
                <label for=\"sel_id\">Select a Record</label>
                <br>
                <select name=\"sel_id\" id=\"sel_id\" required=\"required\">
                    <option value=\"\">-- Select One --</option>";

        while ($recs = mysqli_fetch_array($get_list_res)) {
            $id = $recs['id'];
            $dispaly_name = stripslashes($recs['display_name']);
            $display_block .= "<option value=\"" . $id . "\">" . $dispaly_name . "</option>";
        }

        $display_block .= "</select>
            </p>
            <button type=\"submit\" name=\"submit\" value=\"view\">Delete Selected Entry</button>
        </form>";
    }
}else if ($_POST){
    if($_POST['sel_id'] == '') {
        header("Location: delentry.php");
        exit;
    }
    $safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);
    $del_master_sql = "delete from master_name where id=". $safe_id;
    $del_master_res = mysqli_query($mysqli, $del_master_sql) or
    die(mysqli_error($mysqli));

    $del_address_sql = "delete from address where master_id=". $safe_id;
    $del_address_res = mysqli_query($mysqli, $del_address_sql) or
    die(mysqli_error($mysqli));

    $del_tel_sql = "delete from telephone where master_id=". $safe_id;
    $del_tel_res = mysqli_query($mysqli, $del_tel_sql) or
    die(mysqli_error($mysqli));

    $del_fax_sql = "delete from fax where master_id=". $safe_id;
    $del_fax_res = mysqli_query($mysqli, $del_fax_sql) or
    die(mysqli_error($mysqli));

    $del_email_sql = "delete from email where master_id=". $safe_id;
    $del_email_res = mysqli_query($mysqli, $del_email_sql) or
    die(mysqli_error($mysqli));

    $del_note_sql = "delete from personal_notes where master_id=". $safe_id;
    $del_note_res = mysqli_query($mysqli, $del_note_sql) or
    die(mysqli_error($mysqli));
    mysqli_close($mysqli);
    $display_block = "<h1>Record Deleted</h1>
    <p>Would you like to <a href=\"". $_SERVER[PHP_SELF] ."\">delete another</a>?</p>
";
}
?>

<DOCTYPE html!>
<html>
<head>
<title>Delete Records</title>
</head>
<body>
<?php echo $display_block;?>
</body>
</html>