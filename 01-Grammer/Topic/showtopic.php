<?php
include 'include.php';
doDB();

if(!isset($_GET['topic_id'])) {
    header("Location: topiclist.php");
    exit;
}

$topic_id = $_GET['topic_id'];

$get_posts_sql = "select topic_title from forum_topics where topic_id=". $topic_id;
$get_posts_res = mysqli_query($mysqli, $get_posts_sql)
or die(mysqli_error($mysqli));

if(mysqli_num_rows($get_posts_res) < 1) {
    $display_block = "You have selected an invalid topic. <br>
Please <a href='topiclist.php'>try again</a>";
}else {
    while($topic_info = mysqli_fetch_array($get_posts_res)) {
        $topic_title = $topic_info['topic_title'];
    }
    $get_posts_sql = "select post_id, post_text, post_owner,
    date_format(post_create_time, '%b %e %Y at %r') as fmt_post_create_time
    from forum_posts
    where topic_id=". $topic_id ." order by post_create_time DESC";
    $get_posts_res = mysqli_query($mysqli, $get_posts_sql)
    or die(mysqli_error($mysqli));

    $display_block = <<<END_OF_TEXT
    <p>Showing a posts for the <strong>$topic_title</strong> topic:</p>
<table>
    <tr>
        <th>AUTHOR</th>
        <th>POST</th>
    </tr>
END_OF_TEXT;

    while($post_info = mysqli_fetch_array($get_posts_res)) {
        $post_owner = $post_info['post_owner'];
        $post_text = $post_info['post_text'];
        $post_id = $post_info['post_id'];
        $post_create_time = $post_info['fmt_post_create_time'];
        $display_block .= <<<END_OF_TEXt
    <tr>
        <td>
            $post_owner<br><br>
            Created on:<br> $post_create_time
        </td>
        <td>
            $post_text<br><br>
            <a href="replytopost.php?post_id=$post_id">
                <strong>reply to post</strong>
            </a>
        </td>
    </tr>
END_OF_TEXt;
    }
    mysqli_close($mysqli);
    $display_block .= "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Posts in Topic</title>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
            border: 1px solid black;
            border-collapse: collapse;
            padding:6px;
        }
        td {
            border: 1px solid black;
            padding:6px;
        }
    </style>
</head>
<body>
<h1>Posts in Topic</h1>
<?php echo $display_block?>
</body>
</html>
