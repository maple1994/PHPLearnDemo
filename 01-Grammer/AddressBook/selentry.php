<?php
include 'include.php';
doDB();

if(!$_POST) {
    $display_block = "<h1>Select an Entry</h1>";

    $get_list_sql = "select id, concat_ws(', ', l_name, f_name) as display_name
    from master_name order by l_name, f_name";
    $get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_list_res) < 1) {
        $display_block .= "<p>Sorry, no records</p>";
    }else {
        $display_block .= "
        <form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
            <p>
                <label for=\"sel_id\">Select a Record</label>
                <br>
                <select name=\"sel_id\" id=\"sel_id\" required=\"required\">
                    <option value=\"\">-- Select One --</option>";

        while($recs = mysqli_fetch_array($get_list_res)) {
            $id = $recs['id'];
            $dispaly_name = stripslashes($recs['display_name']);
            $display_block .= "<option value=\"".$id."\">".$dispaly_name."</option>";
        }

        $display_block .= "</select>
            </p>
            <button type=\"submit\" name=\"submit\" value=\"view\">View Selected Entry</button>
        </form>";
    }
}else if ($_POST) {
    if($_POST['sel_id'] == '') {
        header("Location: selentry.php");
        exit;
    }
    $safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);
    $get_master_sql = "select concat_ws(', ', l_name, f_name) as display_name
    from master_name where id='". $safe_id ."'";
    $get_master_res = mysqli_query($mysqli, $get_master_sql) or die(mysqli_error($mysqli));

    while($name_info = mysqli_fetch_array($get_master_res)) {
        $display_name = stripslashes($name_info['display_name']);
    }
    $display_block = "<h1>Showing Record for ". $display_name ."</h1>";
    // free result
    mysqli_free_result($get_master_res);

    $get_address_sql = "select * from address where master_id=".$safe_id;
    $get_address_res = mysqli_query($mysqli, $get_address_sql)
    or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_address_res) > 0) {
        $display_block .= "<p>Address:</p><br><ul>";
        while($address_info = mysqli_fetch_array($get_address_res)) {
            $address = stripslashes($address_info['address']);
            $city = stripslashes($address_info['city']);
            $zipcode = stripslashes($address_info['zipcode']);
            $address_type = $address_info['type'];
            $display_block .= "<li>$address $city $zipcode ($address_type)</li>";
        }
        $display_block .= "</ul>";
    }

    $get_tel_sql = "select * from telephone where master_id=".$safe_id;
    $get_tel_res = mysqli_query($mysqli, $get_tel_sql)
    or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_tel_res) > 0) {
        $display_block .= "<p>Telephone:</p><br><ul>";
        while($tel_info = mysqli_fetch_array($get_tel_res)) {
            $tel_number = stripslashes($tel_info['tel_number']);
            $tel_type = $tel_info['type'];
            $display_block .= "<li>$tel_number ($tel_type)</li>";
        }
        $display_block .= "</ul>";
    }

    $get_fax_sql = "select * from fax where master_id=". $safe_id;
    $get_fax_res = mysqli_query($mysqli, $get_fax_sql)
    or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_fax_res) > 0) {
        $display_block .= "<p>Fax:</p><br><ul>";
        while($fax_info = mysqli_fetch_array($get_fax_res)) {
            $fax_number = stripslashes($fax_info['fax_number']);
            $fax_type = $fax_info['type'];
            $display_block .= "<li>$fax_number ($fax_type)</li>";
        }
        $display_block .= "</ul>";
    }

    $get_email_sql = "select * from email where master_id=". $safe_id;
    $get_email_res = mysqli_query($mysqli, $get_email_sql)
    or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_email_res) > 0) {
        $display_block .= "<p>Email:</p><br><ul>";
        while($email_info = mysqli_fetch_array($get_email_res)) {
            $email = stripslashes($email_info['email']);
            $email_type = $email_info['type'];
            $display_block .= "<li>$email ($email_type)</li>";
        }
        $display_block .= "</ul>";
    }

//    $get_note_sql = "select * from personal_notes where master_id=". $safe_id;
    $get_note_sql = "select * from personal_notes where master_id=12";
    $get_note_res = mysqli_query($mysqli, $get_note_sql)
    or die(mysqli_error($mysqli));
    if(mysqli_num_rows($get_note_res) == 1) {

        while($note_info = mysqli_fetch_array($get_note_res)) {
            $note = stripslashes($note_info['note']);
        }
        $display_block .= "<p>Note:</p>$note<br>";
    }

}
mysqli_close($mysqli);
?>
<DOCTYPE html!>
<html>
<head>
<title>My Records</title>
</head>
<body>
<?php echo $display_block;?>
</body>
</html>
