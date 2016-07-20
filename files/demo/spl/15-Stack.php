<pre>
<?php
//header("Content-Type: text/html; charset=UTF-8");
$word = "А роза упала на лапу Азора";

// Разбить строку на символы (это для того, чтобы можно было работать с utf-8)
$arr = preg_split('//u',$word,-1,PREG_SPLIT_NO_EMPTY);
print_r($arr);
$rarr = array_merge(array_fill(0, count($arr), ''), array_reverse($arr));

$cm = 0;
$match = '';
// Рассмотреть движение cтроки и её перевернутой копии навстречу друг другу с перекрытием
while(array_shift($rarr) !== null) {
     // Для каждого варианта перекрытия посчитать диапазоны совпадающих символов, оставляя самый длинный.
     $matches = array_intersect_assoc($arr, $rarr);
     if(!empty($matches)) {
          $c = count($matches);
          if($c > $cm) {
               $cm = $c;
               $match = implode('', $matches);
          }
     }
}

echo $match; // вывести найденное.