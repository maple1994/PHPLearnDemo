<?php
include 'include.php';
doDB();

$get_topics_sql = "select topic_id, topic_title,
date_format(topic_create_time, '%b %e %Y at %r') as fmt_topic_create_time, topic_owner from
forum_topics order by topic_create_time DESC";
$get_topic_res = mysqli_query($mysqli, $get_topics_sql)
or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_topic_res) < 1) {
    $display_block = "Sorry No topics exists";
}else {
    $display_block = <<<END_OF_TEXT
<table>
    <tr>
        <th>Topic Title</th>
        <th># of POSTS</th>
    </tr>
END_OF_TEXT;
    while($topic_info = mysqli_fetch_array($get_topic_res)) {
        $topic_id = $topic_info['topic_id'];
        $topic_title = $topic_info['topic_title'];
        $topic_create_time = $topic_info['fmt_topic_create_time'];
        $topic_owner = $topic_info['topic_owner'];

        // 获取post的数量
        $get_posts_num_sql = "select count(post_id) as post_count
from forum_posts where topic_id=". $topic_id;
        $get_posts_num_res = mysqli_query($mysqli, $get_posts_num_sql)
        or die(mysqli_error($mysqli));

        while($post_info = mysqli_fetch_array($get_posts_num_res)) {
            $num_posts = $post_info['post_count'];
        }
        $display_block .= <<<END_OF_TEXT
    <tr>
        <td>
            <a href="showtopic.php?topic_id=$topic_id">
                <strong>$topic_title</strong><br>
            </a>
            Created on $topic_create_time By $topic_owner
        </td>
        <td class="num_post_col">$num_posts</td>
    </tr>
END_OF_TEXT;
    }
    $display_block .= "</table>";
mysqli_close($mysqli);
}
?>
<DOCTYPE html>
<html>
<head>
    <title>Topic List</title>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
            border: 1px solid black;
            padding: 6px;
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            padding: 6px;
        }
        .num_post_col {
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Topics in My Forum</h1>
<?php echo $display_block;?>
<p>Would you like to <a href="addtopic.html">add a topic</p>
</body>
</html>
