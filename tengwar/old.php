<? header('Content-Type: text/html; charset=utf-8'); ?>
<html>
<style>
    @font-face {
        font-family: "Tengwar";
        src: url(http://may-cat.ru/tengwar/tngan.ttf) format("truetype");
    }
    p.tengwar { font-family: "Tengwar"; font-size:30px; }
</style>
<body>
<p>Вашему вниманию представлен инструмент для транслитерации русского текста на тенгвар.</p>
<p>Подобно тому, kak vy pishete traslitom po-russki, можно писать эльфийскими буквами. Правила соответствия букв тенгвам - предмет споров, в этом нет согласия ни в русском, ни в английском языке. Данный скрипт опирается на <a href="http://hex.pp.ua/tengwar.php">статью автора амдф</a>, где всё очень подробно описано.</p>
<p>Использованный шрифт - <a href="tngan.ttf">Tengwar Annatar</a> свободно скачивается в интернете. Разработчикам может быть интересен разработанный мной <a href="data.json">json-файл с regExp-шаблонами</a>, делающими всю магию.</p>
<br/>
<p>Приятного использования!</p>
<form method="GET">
    <textarea name="q" id="q" cols="30" rows="10"><?=htmlspecialchars($_REQUEST['q'])?></textarea><br>
    <input type="submit" value="транслитерировать"/>
</form>

<?
$q = $_REQUEST['q'];
if ($q) {
    $q = mb_strtolower($q, 'UTF-8');
    echo "<p class=\"tengwar\">";
    $q = explode(' ',$q);
    $data = json_decode(file_get_contents("data.json"));
    foreach ($q as $word) {
        foreach ($data as $el) {
            $pattern = "/" . $el->regexp . "/";
            if (preg_match($pattern, $word)) {
                $word = preg_replace($pattern, $el->replace, $word);
            }
        }
        echo $word,' ';
    }
    echo "</p>";
}
?>
</body>
</html>