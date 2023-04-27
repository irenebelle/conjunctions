<html>
    <head>
        <title></title>
</head>
<body>
    <p>Введите слово в настоящем времени 3 лице единственном числе</p>
<form action="index.php" method="get">

    <p><input type="text" name = "word"/></p>
    <p><input type="submit" /></p>

</form>

 <?php echo htmlspecialchars($_GET['word']); ?>.

    <?php $word = trim(htmlspecialchars($_GET['word'])) ; ?>
<h2 class="wp-block-heading">Настоящее время</h2>
<h3 class="wp-block-heading">Утвердительная форма</h3>
<figure class="wp-block-table">
    <table>
        <tbody>
            <tr><td>Ben&nbsp;<code><?php echo $word."<b>um</b>"; ?></code></td><td>Biz&nbsp;<code><?php echo $word."<b>uz</b>"; ?></code></td></tr>
            <tr><td>Sen&nbsp;<code><?php echo $word."<b>sun</b>"; ?></code></td><td>Siz&nbsp; <code><?php echo $word."<b>sunuz</b>"; ?></code></td></tr>
            <tr><td>O <code><?php echo $word; ?></code></td><td>Onlar&nbsp;<code><?php echo $word."<b>lar</b>"; ?></code></td></tr>
        </tbody>
    </table>
</figure>
<?php



?>
</body>
</html>