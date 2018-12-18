<?php
function showtable($res) {
    if($res === false) {
        echo "执行失败: " . mysqli_error();
    }else {
        echo "执行成功" . "<br>";
        echo "<table border='1 solid #ddd'>";
        $filed_count = mysqli_num_fields($res);
        for($i = 0; $i < $filed_count; $i++) {
            $filed_info = mysqli_fetch_field_direct($res, $i);
            echo "<td>$filed_info->name</td>";
        }
        echo "<tr>";
        while($info = mysqli_fetch_array($res)) {
            echo "<tr>";
            for($i = 0; $i < $filed_count; $i++) {
                $value = $info[$i];
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>