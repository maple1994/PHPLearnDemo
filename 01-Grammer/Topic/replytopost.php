<?php
include 'include.php';
doDB();

if(!$_POST) {
    if (!isset($_GET['post_id'])) {
        header("Location: topiclist.php");
        exit;
    }
    $post_id = $_GET['post_id'];
    $sql = "select ft.topic_id, ft.topic_title from forum_posts as fp left join
forum_topics as ft on fp.topic_id=ft.topic_id where fp.post_id=". $post_id;
    $res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

    if(mysqli_num_rows($res) < 1) {
        header("Location: topiclist.php");
        exit;
    }else {
        while($topic_info = mysqli_fetch_array($res)) {
            $topic_id = $topic_info['topic_id'];
            $topic_title = $topic_info['topic_title'];
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post your reply</title>
</head>
<body>
<h1>Post Your Reply in <?php echo $topic_title?></h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p>
        <label for="post_owner_id">Your Email Address:</label> <br>
        <input type="address" size="40" name="post_owner" id="post_owner_id"
        maxlength="150" required="required">
    </p>
    <label for="post_text_id">Post Text</label>
    <br>
    <textarea name="post_text" id="post_text_id" cols="40" rows="8" id="post_text_id"></textarea>
    <br>
    <input type="hidden" name="topic_id" value="<?echo $topic_id?>">
    <button type="submit" value="Add Post">Add Post</button>
</form>
</body>
<?php
    }
}else if ($_POST) {
    if(!$_POST['topic_id'] || !$_POST['post_text'] || !$_POST['post_owner']) {
        header("Location: topiclist.php");
        exit;
    }
    $topic_id = $_POST['topic_id'];
    $post_text = $_POST['post_text'];
    $post_owner = $_POST['post_owner'];
    $sql = "insert into forum_posts(topic_id, post_text, post_owner)
values(". $topic_id ." ,'". $post_text ."', '". $post_owner ."')";
    $res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    mysqli_close($mysqli);
    header("Location:showtopic.php?topic_id=". $_POST['topic_id']);
}
?>