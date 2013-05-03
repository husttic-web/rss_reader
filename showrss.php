<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include "function.php";
            $result = select_item("item",0,30);
            ?>
        <table border="2">
            <tr>
                <th>标题</th>
                <th>摘要</th>
                <th>时间</th>
            </tr>
            <?php
            foreach($result as $row){
                ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['pubdate']; ?></td>
            </tr>
            <?php
            }
        ?>
        </table>
    </body>
</html>
