<?php
// 订阅表单
include 'include.php';
if (!$_POST) {
    $display_block = <<<END_OF_BLOCK
    <form method="POST", action="$_SERVER[PHP_SELF]">
    <p>
    <label for="email">Your email address</label><br/>
    <input type="text" id="email" name="email" size="40" maxlength="150"/>
    </p>
    <fieldset>
    <legend>Action:</legend><br/>
    <input type="radio" id="action_sub" name="action" value="sub" checked/>
    <label for="action_sub">subscribe</label><br/>
    <input type="radio" id="action_unsub" name="action" value="unsub"/>
    <label for="action_unsub">unsubscribe</label><br/>
    </fieldset>
    <button type="submit" name="submit" value="submit">Submit</button>
    </form>
END_OF_BLOCK;
}else if($_POST && ($_POST['action'] == 'sub')) {
    // 订阅
    if($_POST['email'] == '') {
        header("location: manage.php");
        exit;
    }else {
        // 连接数据库
        doDB();
        // 检查email是否在列表中
        emailChecker($_POST['email']);
        if(mysqli_num_rows($check_res) < 1) {
            mysqli_free_result($check_res);
            $add_sql = "insert into subscribers (email)
                    values('" . $safe_mail . "');";
            echo $add_sql;
            $add_res = mysqli_query($mysqli, $add_sql) or die(mysqli_error($mysqli));
            echo $add_res;
            mysqli_close($mysqli);
            $display_block = "<p>Thanks for signning up!</p>";
        }else {
            // 已经订阅
            $display_block = "<p>You're already subscribed</p>";
        }
    }


}else if($_POST && ($_POST['action'] == 'unsub')) {
    // 取消订阅
    if($_POST['email'] == '') {
        header("location: manage.php");
        exit;
    }else {
        // 连接数据库
        doDB();
        // 检查email是否在列表中
        emailChecker($_POST['email']);
        if(mysqli_num_rows($check_res) < 1) {
            mysqli_free_result($check_res);
            $display_block = "<p>Couldn't find your address!</p>";
        }else {
            while($row = mysqli_fetch_array($check_res)) {
                $id = $row['id'];
            }
            $del_sql = "delete from subscribers
                       where id=" . $id;
            mysqli_query($mysqli, $del_sql) or die(mysqli_error($mysqli));
            $display_block = "<p>You're unsubscribed!</p>";
        }

    }
}

?>
<!DOCTYPE>
<html>
<head>
    <title>subscribe/unsubscribe to a mail list</title>
</head>
<!--<h1>subscribe/unsubscribe to a mail list</h1>-->
<?php //echo "$display_block";
//?>
<?php echo phpinfo()?>
</html>
