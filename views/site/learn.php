<?php
/*$this->title = 'learning JavaScript';
$users = [
        [
            'login' => 'qwerty',
            'pass' => '123765678976',
            'ban' => true,
            'subscribe' => false
        ],
        [
            'login' => 'Addy',
            'pass' => '666',
            'ban' => false,
            'subscribe' => false
        ],
        [
            'login' => 'Vally',
            'pass' => '332',
            'ban' => false,
            'subscribe' => true
        ],
        [
            'login' => 'hello',
            'pass' => 'rtyu',
            'ban' => true,
            'subscribe' => true
        ]
];
$subscribeUsers = function($user)
{
    return $user['subscribe'];
};
$passCount = function($user)
{
    if(strlen($user['pass']) < 8)
    {
        return $user['pass'];
    }
};
function getFilter($items,$func)
{
    $tmp = [];
    foreach ($items as $item)
    {
        if($func($item) == true)
        {
            $tmp[] = $item;
        }
    }
    return $tmp;
}
$result = getFilter($users,$passCount);*/

?>
<!DOCTYPE HTML>
<html>
    <head>
    <meta charset="utf-8">
    </head>
    <body>
    <p>NU JE</p>
    <h1 id="hey">Ваше имя: </h1>
    </body>
</html>
<!--<script src="../../web/public/js/do.js"></script>-->
<script>
    for(var i=0; i<10; i++) {
        console.log(i);
    }
    alert(i);
</script>