<?php


function calcDeposit($depositAmount, $month, $percent)
{
    return $depositAmount + (($depositAmount * $percent * ($month * 30)) / (365 * 100));
}


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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $depositAmount = trim($_POST['depositAmount']);
    $month = trim($_POST['month']);
    $percent = trim($_POST['percent']);
    $fields = [$depositAmount, $month, $percent];

    if (check($fields) === false) {
        $message = 'Э эээээ ..... что то ты пропустил :-((((';
    } else {
        $message = calcDeposit($depositAmount, $month, $percent);
    }

}
?>

<? if (isset($message)): ?>
<div><?=$message?></div>
<? endif ?>

<form method="post">
    Сумма вклада
    <br>
    <input type="text" name="depositAmount" value="<?=isset($depositAmount) ? $depositAmount: '';?>">
    <br><br>
    Срок в месяцах
    <br>
    <input type="text" name="month" value="<?=isset($month) ? $month: '';?>">
    <br><br>
    Процент по вкладу
    <br>
    <input type="text" name="percent" value="<?=isset($percent) ? $percent: '';?>">
    <br><br><br>
    <input type="submit" value="ПОСЧИТАТЬ">
</form>
