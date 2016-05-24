<? header('Content-Type: text/html; charset=utf-8'); ?>
<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="main.js"></script>
    <style type="text/css">
        table.hint-table {}
        table.hint-table tr {}
        table.hint-table tr td { font-size: 30px; text-align:center; width:130px;}
        table.hint-table tr td span.ru-teng {}
        table.hint-table tr td span.ru {color:#ccc; font-size:22px;}
    </style>
    <script type="text/javascript">
        var allowed = [];
        var curTengwa = [];
        var prevTengwa = [];


        function inArray(needle, haystack) {
            var length = haystack.length;
            for(var i = 0; i < length; i++) {
                if(haystack[i] == needle) return true;
            }
            return false;
        }

        function updateAllowed()
        {
            allowed=[];
            $('table.hint-table tr td span.ru').each(function(){
                if ($(this).parent().find('input').is(':checked'))
                    allowed.push($(this).text());
            });
        }

        function nextTengwaForTraining()
        {
            prevTengwa = curTengwa;
            updateAllowed();
            curTengwa = arrayOfTengwas[Math.floor(Math.random()*arrayOfTengwas.length)];
            if (curTengwa.type!='punctuation' && curTengwa.standalone && inArray(curTengwa.ru,allowed) && prevTengwa!=curTengwa) {
                $('#tengwa').text(" "+curTengwa.tengwa)
            } else {
                curTengwa = prevTengwa;
                nextTengwaForTraining();
            }
        }

        function check(){
            var val = $('#txt').val();
            if (val=='')
                return false;

            var re = new RegExp(curTengwa.regexp, "i");
            if (re.test(val))
                alert('хорошо, как в примере "'+curTengwa.example + "\" с буквой "+curTengwa.ru);
            else
                alert('плохо, подошло бы, например "'+curTengwa.example + "\" с буквой "+curTengwa.ru);
            $('#txt').val('');
            nextTengwaForTraining();
        }


        $(document).ready(function(){
            // Генерация тенгвы для тренировки
            $('#next').click(function(){
                nextTengwaForTraining();
            });

            // Проверка введённого слова
            $('#check').click(function(){
                check();
            });
            $('#txt').keypress(function(e){
                if(e.which == 13) {
                    check();
                }
            });

            $('#next').hide(); // Прячем кнопку, ибо сейчас всё автоматизировано
            nextTengwaForTraining();

            // Подсказки и настройки тренировки
            $('#hintdiv').hide();
            $('#hint').click(function(){
                $('#hintdiv').toggle();
            });

        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){
                $('p.transl').tengwarize();
                $('.ru-teng').tengwarize();
            },2000);
        })
    </script>
</head>
<body>
<p>Вашему вниманию представлена обучалка чтению русскому на тенгваре.</p>
<p>Вам показывается тенгва, а вы должны ввести слово (русскими буквами), которое содержит её.</p>


<input type="submit" value="Next" id="next"/>
<div>
    <p class="tengwar" id="tengwa"></p>
    <p>Введите слово на русском, содержащее эту тенгву:</p>
    <input type="text" id="txt"/>
    <input type="submit" id="check"/>
    <br/><br/>
    Нажми, чтобы показать <a href="#" id="hint">подсказку и настройки</a>
    <div id="hintdiv">
        <p>В тренировку попадают те тегвы, что отмечены ниже галочкой.</p>

        <h2>Согласные</h2>
        <table class="hint-table">
            <tr>
                <td><span class="ru-teng">ч</span> <span class="ru">ч</span> <input type="checkbox" checked="checked"></td>
                <td><span class="ru-teng">к</span> <span class="ru">к</span> <input type="checkbox" checked="checked"></td>
                <td><span class="ru-teng">т</span> <span class="ru">т</span> <input type="checkbox" checked="checked"></td>
                <td><span class="ru-teng">п</span> <span class="ru">п</span> <input type="checkbox" checked="checked"></td>
            </tr>
            <tr>
                <td><span class="ru-teng">дж</span> <span class="ru">дж</span> <input type="checkbox"></td>
                <td><span class="ru-teng">г</span> <span class="ru">г</span> <input type="checkbox"></td>
                <td><span class="ru-teng">д</span> <span class="ru">д</span> <input type="checkbox"></td>
                <td><span class="ru-teng">б</span> <span class="ru">б</span> <input type="checkbox"></td>
            </tr>
            <tr>
                <td><span class="ru-teng">ш</span> <span class="ru">ш</span> <input type="checkbox"></td>
                <td><span class="ru-teng">х</span> <span class="ru">х</span> <input type="checkbox"></td>
                <td><span class="ru-teng">ф</span> <span class="ru">ф</span> <input type="checkbox"></td>
                <td></td>
            </tr>
            <tr>
                <td><span class="ru-teng">ж</span> <span class="ru">ж</span> <input type="checkbox"></td>
                <td></td>
                <td><span class="ru-teng">в</span> <span class="ru">в</span> <input type="checkbox"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><span class="ru-teng">н</span> <span class="ru">н</span> <input type="checkbox"></td>
                <td><span class="ru-teng">м</span> <span class="ru">м</span> <input type="checkbox"></td>
            </tr>
            <tr>
                <td><span class="ru-teng">й</span> <span class="ru">й</span> <input type="checkbox"></td>
                <td><span class="ru-teng">ъ</span> <span class="ru">ъ</span> <input type="checkbox"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><span class="ru-teng">л</span> <span class="ru">л</span> <input type="checkbox"></td>
                <td><span class="ru-teng">р</span> <span class="ru">р</span> <input type="checkbox"></td>
            </tr>
            <tr>
                <td></td>
                <td><span class="ru-teng">с</span> <span class="ru">с</span> <input type="checkbox"></td>
                <td><span class="ru-teng">з</span> <span class="ru">з</span> <input type="checkbox"></td>
                <td></td>
            </tr>
            <tr>
                <td><span class="ru-teng">щ</span> <span class="ru">щ</span> <input type="checkbox"></td>
                <td><span class="ru-teng">ц</span> <span class="ru">ц</span> <input type="checkbox"></td>
                <td><span class="ru-teng">ы</span> <span class="ru">ы</span> <input type="checkbox"></td>
                <td><span class="ru-teng">ь</span> <span class="ru">ь</span> <input type="checkbox"></td>
            </tr>

        </table>


        <h2>Гласные</h2>
        <table class="hint-table">
            <tr>
                <td><span class="ru-teng">а</span> <span class="ru">а</span> <input type="checkbox"></td>
                <td><span class="ru-teng">э</span> <span class="ru">э</span> <input type="checkbox"></td>
                <td><span class="ru-teng">и</span> <span class="ru">и</span> <input type="checkbox"></td>
                <td><span class="ru-teng">о</span> <span class="ru">о</span> <input type="checkbox"></td>
                <td><span class="ru-teng">у</span> <span class="ru">у</span> <input type="checkbox"></td>
            </tr>
            <tr>
                <td><span class="ru-teng">я</span> <span class="ru">я</span> <input type="checkbox"></td>
                <td><span class="ru-teng">е</span> <span class="ru">е</span> <input type="checkbox"></td>
                <td></td>
                <td><span class="ru-teng">ё</span> <span class="ru">ё</span> <input type="checkbox"></td>
                <td><span class="ru-teng">ю</span> <span class="ru">ю</span> <input type="checkbox"></td>
            </tr>
        </table>
    </div>


</div>


</body>
</html>