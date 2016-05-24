<? header('Content-Type: text/html; charset=utf-8'); ?>
<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <style>
        @font-face {
            font-family: "Tengwar";
            src: url(http://may-cat.ru/tengwar/tngan.ttf) format("truetype");
        }
        .tengwar { font-family: "Tengwar"; font-size:30px; }
    </style>
</head>
<body>
<p>Вашему вниманию представлен инструмент для транслитерации русского текста на тенгвар.</p>
<p>Подобно тому, kak vy pishete traslitom po-russki, можно писать эльфийскими буквами. Правила соответствия букв тенгвам - предмет споров, в этом нет согласия ни в русском, ни в английском языке. Данный скрипт опирается на <a href="http://hex.pp.ua/tengwar.php">статью автора амдф</a>, где всё очень подробно описано.</p>
<p>Использованный шрифт - <a href="tngan.ttf">Tengwar Annatar</a> свободно скачивается в интернете. Разработчикам может быть интересен разработанный мной <a href="data.json">json-файл с regExp-шаблонами</a>, делающими всю магию.</p>
<br/>
<p>Приятного использования!</p>
<form method="GET">
    <textarea name="q" id="q" cols="30" rows="10"><?=htmlspecialchars($_REQUEST['q'])?></textarea><br>
</form>
<div class="tengwar" id="target"></div>

<script type="text/javascript">
    var arrayOfTeng = [];
    var curTengwa = {};
    $(document).ready(function(){
        $('#q').keyup(function() {
            var txt = $(this).val();
            $('#target').html('');
            var arTxt = txt.split(' ');
            for (i in arTxt) {
                for (curTengwa in arrayOfTeng) {
                    var re = new RegExp(arrayOfTeng[curTengwa].regexp, "ig");
                    if (arTxt[i].match(re))
                        arTxt[i] = arTxt[i].replace(re, arrayOfTeng[curTengwa].replace);
                }
                $('#target').append(arTxt[i]+' ');
            }
        });
        $.ajax({
            dataType: "json",
            url: "data.json",
            success: function(x){
                arrayOfTeng = x;
                $('#q').keyup();
            },
            async: false
        });

    });


</script>
</body>
</html>