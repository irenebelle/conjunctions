<html>
    <head>
        <title>Спряжение турецких глаголов</title>
</head>
<body>
<form action="index.php" method="get">
    <p>Введите слово в настоящем времени 3 лице единственном числе</p>

    <p><input type="text" name = "word"/></p>
    <p>Введите слово в неопределенной форме</p>
    <p><input type="text" name = "word2"/></p>

    <p><input type="submit" /></p>

</form>

<?php
    $Tonsuz = ['0', 'f', 's', 't','k', 'ç', 'ş', 'h', 'p'];
    $Tonlu = ['0', 'b', 'c', 'd', 'g', 'ğ', 'j', 'l', 'm', 'n', 'r', 'v', 'y', 'z'];
    $consonants = ['0', 'b', 'c', 'd', 'g', 'ğ', 'j', 'l', 'm', 'n', 'r', 'v', 'y', 'z', 'f', 's', 't','k', 'ç', 'ş', 'h', 'p'];
    $vowels = ['0', 'a', 'e', 'ı', 'i', 'o', 'ö', 'u', 'ü'];


?>
<p><?php echo htmlspecialchars($_GET['word']); ?></p>
<p><?php echo htmlspecialchars($_GET['word2']); ?></p>
<?php
    $infinitive = trim(htmlspecialchars($_GET['word2']));
    $root = substr($infinitive, 0, -3);
    // echo 'Основа '.$root;

     function search_last_vowel($string_array): string
     {
         global $vowels;
         $count = count($string_array);
         $nnp = '';
         for ($i =  $count-1; $i < $count && $i>-1; $i--) {

                if(array_search($string_array[$i], $vowels))
                {

                    $nnp = negative_present_particle($string_array[$i]);

                }

         }
         return $nnp;

     }
function negative_present_particle($last_letter): string
{
    //echo $last_letter;
    $negative_present_particle = '';

    if($last_letter == 'e' || $last_letter ==  'i') {
        $negative_present_particle = 'mi';
    }
    elseif ($last_letter == 'a' || $last_letter == 'ı'){
        $negative_present_particle = 'mı';
    }
    elseif ($last_letter == 'o' || $last_letter == 'u'){
        $negative_present_particle = 'mu';
    }
    elseif ($last_letter == 'ü' || $last_letter == 'ö'){
        $negative_present_particle = 'mü';
    }
    return $negative_present_particle;
}

    function negative_present_particle2($root): string
    {
        global $consonants, $vowels;
      //  echo  iconv_strlen($root);
        $string_array = mb_str_split($root);
        $last_letter = $string_array[iconv_strlen($root)-1]; // последняя буква в основе
        if(array_search($last_letter, $vowels)) {

            return negative_present_particle($last_letter);

        } else {

           return search_last_vowel($string_array);
        }



    }
    $npp =   negative_present_particle2($root);
?>



    <?php $word = trim(htmlspecialchars($_GET['word'])) ; ?>
<h2 class="wp-block-heading">Настоящее время ŞİMDİKİ ZAMAN</h2>
<h3 class="wp-block-heading">Утвердительная форма</h3>
<figure class="wp-block-table">
    <table>
        <tbody>
        <tr>
            <td>Ben&nbsp;<code><?php echo $word; ?><strong>um</strong></code></td>
            <td>Biz&nbsp;<code><?php echo $word; ?><strong>uz</strong></code></td>
        </tr>
        <tr>
            <td>Sen&nbsp;<code><?php echo $word; ?><strong>sun</strong></code></td>
            <td>Siz&nbsp; <code><?php echo $word; ?><strong>sunuz</strong></code></td>
        </tr>
        <tr>
            <td>O <code><?php echo $word; ?></code></td>
            <td>Onlar&nbsp;<code><?php echo $word; ?><strong>lar</strong></code></td>
        </tr>
        </tbody>
    </table>
</figure>
    <h3 class="wp-block-heading"><strong>Вопросительная форма</strong></h3>
    <figure class="wp-block-table">
        <table>
            <tbody>
            <tr>
                <td>ben<code> <?php echo $word; ?> <strong>muyum?</strong></code></td>
                <td>biz <code><?php echo $word; ?> <strong>muyuz?</strong></code></td>
            </tr>
            <tr>
                <td>sen <code><?php echo $word; ?> <strong>musun?</strong></code></td>
                <td>siz <code><?php echo $word; ?> <strong>musunuz?</strong></code></td>
            </tr>
            <tr>
                <td>o <code><?php echo $word; ?> <strong>mu?</strong></code></td>
                <td>onlar <code><?php echo $word; ?>lar <strong>mı?</strong></code></td>
            </tr>
            </tbody>
        </table>
    </figure>
    <h3 class="wp-block-heading"><strong>Отрицательная форма</strong></h3>
    <figure class="wp-block-table">
        <table>
            <tbody>
            <tr>
                <td>ben <code><?php echo $root.$npp; ?>yorum</code></td>
                <td>biz <code><?php echo $root.$npp; ?>yoruz</code></td>
            </tr>
            <tr>
                <td>sen <code><?php echo $root.$npp; ?>yorsun</code></td>
                <td>siz <code><?php echo $root.$npp; ?>yorsunuz</code></td>
            </tr>
            <tr>
                <td>o <code><?php echo $root.$npp; ?>yor</code></td>
                <td>onlar <code><?php echo $root.$npp; ?>yorlar</code></td>
            </tr>
            </tbody>
        </table>
    </figure>
    <h3 class="wp-block-heading"><strong>Вопросительно-отрицательная форма</strong></h3>
<figure class="wp-block-table">
    <table>
        <tbody>
        <tr>
            <td>Ben <code><?php echo $root.$npp; ?>yor muyum?</code></td>
            <td>Biz <code><?php echo $root.$npp; ?>yor muyuz?</code></td>
        </tr>
        <tr>
            <td>Sen <code><?php echo $root.$npp; ?>yor musun?</code></td>
            <td>Siz <code><?php echo $root.$npp; ?>yor musunuz?</code></td>
        </tr>
        <tr>
            <td>O <code><?php echo $root.$npp; ?>yor mu?</code></td>
            <td>Onlar <code><?php echo $root.$npp; ?>yorlar mı?</code></td>
        </tr>
        </tbody>
    </table>
</figure>

<?php



?>
</body>
</html>
