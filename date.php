<?php


function check($params = [])
{
    if (
        is_array($params) === false ||
        count($params) == 0
    ) {
        return false;
    }

    foreach ($params as $param) {
        if (
            empty($param) ||
            is_numeric($param) === false
        ) {
            return false;
        }
    }

    return true;
}


function generationDateInRus($day, $month)
{
    if ($day < 1 || $day > 31) {
        return 'Дней в одном месяце должно быть от 1 до 31!';
    }

    if ($month < 1 || $month > 12) {
        return 'В году 12 месяцев!';
    }

    $monthList = include 'monthList.php';
    $result = $day . ' ' . $monthList[$month-1];

    if($day > 28 && $month == 2) {
        return $result . ' нет, в григорианском календаре!';
    }

    if ($day > 30) {
        switch ($month) {
            case 4:
            case 6:
            case 9:
            case 11:
                return $result . ' нет, в григорианском календаре!';
        }
    }

    return $result;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $day = trim($_POST['day']);
    $month = trim($_POST['month']);
    $fields = [$day, $month];

    if (check($fields) === false) {
        $message = 'Э эээээ ..... что то ты пропустил :-((((';
    } else {
        $message = generationDateInRus($day, $month);
    }

}
?>

<? if (isset($message)): ?>
<div><?=$message?></div>
<? endif ?>

<form method="post">
    Введите число
    <br>
    <input type="text" name="day" value="<?=isset($day) ? $day: '';?>">
    <br>
    Введите номер месяца
    <br>
    <input type="text" name="month" value="<?=isset($month) ? $month: '';?>">
    <br><br>
    <input type="submit" name = "Вывести">
</form>
