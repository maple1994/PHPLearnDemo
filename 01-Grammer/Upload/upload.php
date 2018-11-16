<?php
$path = "/Users/maple/Desktop";
foreach ($_FILES as $file_name => $file_array) {
    echo "path:" . $file_array['tmp_name'] . "<br>";
    echo "name:" . $file_array['name'] . "<br>";
    echo "type:" . $file_array['type'] . "<br>";
    echo "size:" . $file_array['size'] . "<br>";

    if (is_uploaded_file($file_array['tmp_name'])) {
        move_uploaded_file($file_array['tmp_name'], "$path/". $file_array['name'])
        or die("Couldn't move file");
        echo "File was moved";
    }else {
        echo "No file found.";
    }

}

?>