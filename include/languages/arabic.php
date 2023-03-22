<?php
function lang($phrase)
{
    static $lang = [
        'admin' => 'حسن',
        'message' => 'اهلا'

    ];
    return $lang[$phrase];
}
