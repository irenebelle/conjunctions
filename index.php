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
         $last_vowel = '';
         for ($i =  $count-1; $i < $count && $i>-1; $i--) {

                if(array_search($string_array[$i], $vowels))
                {
                    $last_vowel = $string_array[$i];
                }
         }
         return $last_vowel;

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

function past_affix_d($last_letter): string
{

    $past_affix = '';

    if($last_letter == 'e' || $last_letter ==  'i') {
        $past_affix = 'di';
    }
    elseif ($last_letter == 'a' || $last_letter == 'ı'){
        $past_affix = 'dı';
    }
    elseif ($last_letter == 'o' || $last_letter == 'u'){
        $past_affix = 'du';
    }
    elseif ($last_letter == 'ü' || $last_letter == 'ö'){
        $past_affix = 'dü';
    }
    return $past_affix;
}
function past_affix_t($last_letter): string
{

    $past_affix = '';

    if($last_letter == 'e' || $last_letter ==  'i') {
        $past_affix = 'ti';
    }
    elseif ($last_letter == 'a' || $last_letter == 'ı'){
        $past_affix = 'tı';
    }
    elseif ($last_letter == 'o' || $last_letter == 'u'){
        $past_affix = 'tu';
    }
    elseif ($last_letter == 'ü' || $last_letter == 'ö'){
        $past_affix = 'tü';
    }
    return $past_affix;
}
    function past_private_ending_niz($last_letter): string
    {   //определяет личное окончание в прошедшем кат времен
        $ending = '';
        if($last_letter == 'di' || $last_letter ==  'ti') {
            $ending = 'niz';
        }
        elseif ($last_letter == 'dı' || $last_letter == 'tı'){
            $ending = 'nız';
        }
        elseif ($last_letter == 'du' || $last_letter == 'tu'){
            $ending = 'nuz';
        }
        elseif ($last_letter == 'dü' || $last_letter == 'tü'){
            $ending = 'nüz';
        }
        return $ending;


     }
function past_private_ending_lar($last_letter): string
{   //определяет личное окончание в прошедшем кат времен
    $ending = '';
    if($last_letter == 'di' || $last_letter ==  'ti') {
        $ending = 'ler';
    }
    elseif ($last_letter == 'dı' || $last_letter == 'tı'){
        $ending = 'lar';
    }
    elseif ($last_letter == 'du' || $last_letter == 'tu'){
        $ending = 'lar';
    }
    elseif ($last_letter == 'dü' || $last_letter == 'tü'){
        $ending = 'ler';
    }
    return $ending;


}

function negative_past_particle($affix): string
{
         $npp = '';
    if($affix == 'dı' || $affix ==  'tı') {
        $npp = 'mı';
    }
    elseif ($affix == 'di' || $affix == 'ti'){
        $npp = 'mi';
    }
    elseif ($affix == 'du' || $affix == 'tu'){
        $npp = 'mu';
    }
    elseif ($affix == 'dü' || $affix == 'tü'){
        $npp = 'mü';
    }
    return $npp;

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
            $last_vowel_letter = search_last_vowel($string_array);

            return negative_present_particle($last_vowel_letter);

        }

    }
    $npp =   negative_present_particle2($root);

    function select_past_affix($root): string
    {
        $affix = '';
        global $Tonsuz, $vowels;
        $string_array = mb_str_split($root);
        $last_letter = $string_array[iconv_strlen($root)-1]; // последняя буква в основе
        if(array_search($last_letter, $Tonsuz)) {
              $last_vowel =  search_last_vowel($string_array);
              $affix =  past_affix_t($last_vowel);
              echo $root.$affix;
        }
        else
        {
            if(array_search($last_letter, $vowels))
            {
               $affix =  past_affix_d($last_letter);

            }
            else {
                $last_vowel =  search_last_vowel($string_array);
                $affix =  past_affix_d($last_vowel);
            }

        }
        //echo $affix;

        return $affix;


    }
    $affix = select_past_affix($root);
    $npp = negative_past_particle($affix);
    $siz_end = past_private_ending_niz($affix);
    $lar_end = past_private_ending_lar($affix);
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
                <td>Ben<code> <?php echo $word; ?> <strong>muyum?</strong></code></td>
                <td>Biz <code><?php echo $word; ?> <strong>muyuz?</strong></code></td>
            </tr>
            <tr>
                <td>Sen <code><?php echo $word; ?> <strong>musun?</strong></code></td>
                <td>Siz <code><?php echo $word; ?> <strong>musunuz?</strong></code></td>
            </tr>
            <tr>
                <td>O <code><?php echo $word; ?> <strong>mu?</strong></code></td>
                <td>Onlar <code><?php echo $word; ?>lar <strong>mı?</strong></code></td>
            </tr>
            </tbody>
        </table>
    </figure>
    <h3 class="wp-block-heading"><strong>Отрицательная форма</strong></h3>
    <figure class="wp-block-table">
        <table>
            <tbody>
            <tr>
                <td>Ben <code><?php echo $root; ?><strong><?=$npp?></strong>yorum</code></td>
                <td>Biz <code><?php echo $root; ?><strong><?=$npp?></strong>yoruz</code></td>
            </tr>
            <tr>
                <td>Sen <code><?php echo $root; ?><strong><?=$npp?></strong>yorsun</code></td>
                <td>Siz <code><?php echo $root; ?><strong><?=$npp?></strong>yorsunuz</code></td>
            </tr>
            <tr>
                <td>O <code><?php echo $root; ?><strong><?=$npp?></strong>yor</code></td>
                <td>Onlar <code><?php echo $root; ?><strong><?=$npp?></strong>yorlar</code></td>
            </tr>
            </tbody>
        </table>
    </figure>
    <h3 class="wp-block-heading"><strong>Вопросительно-отрицательная форма</strong></h3>
<figure class="wp-block-table">
    <table>
        <tbody>
        <tr>
            <td>Ben <code><?php echo $root.$npp; ?>yor <strong>muyum</strong>?</code></td>
            <td>Biz <code><?php echo $root.$npp; ?>yor <strong>muyuz</strong>?</code></td>
        </tr>
        <tr>
            <td>Sen <code><?php echo $root.$npp; ?>yor <strong>musun</strong>?</code></td>
            <td>Siz <code><?php echo $root.$npp; ?>yor <strong>musunuz</strong>?</code></td>
        </tr>
        <tr>
            <td>O <code><?php echo $root.$npp; ?>yor <strong>mu</strong>?</code></td>
            <td>Onlar <code><?php echo $root.$npp; ?>yorlar <strong>mı</strong>?</code></td>
        </tr>
        </tbody>
    </table>
</figure>
<h2 class="wp-block-heading">Прошедшее категорическое время Belirli Geçmiş Zaman</h2>
<h3 class="wp-block-heading">Утвердительная форма</h3>
<figure class="wp-block-table">
    <table>
        <tbody>
        <tr>
            <td>Ben <code><?=$root?><strong><?=$affix?></strong>m</code></td>
            <td>Biz <code><?=$root?><strong><?=$affix?></strong>k</code></td>
        </tr>
        <tr>
            <td>Sen <code><?=$root?><strong><?=$affix?></strong>n</code></td>
            <td>Siz <code><?=$root?><strong><?=$affix?></strong><?=$siz_end?></code></td>
        </tr>
        <tr>
            <td>O <code><?=$root?><strong><?=$affix?></strong></code></td>
            <td>Onlar <code><?=$root?><strong><?=$affix?></strong><?=$lar_end?></code></td>
        </tr>
        </tbody>
    </table>
</figure>
<h3 class="wp-block-heading"><strong>Вопросительная форма</strong></h3>
<h3 class="wp-block-heading"><strong>Отрицательная форма</strong></h3>
<h3 class="wp-block-heading"><strong>Вопросительно-отрицательная форма</strong></h3>

<?php



?>
</body>
</html>
