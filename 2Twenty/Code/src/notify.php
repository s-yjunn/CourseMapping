<?php
function notifyGood($text)
{
    echo ('
        <div class="notification is-success floating" id="good-login">
            <button class="delete"></button>
            ' . $text . '
        </div>
    ');
}

function notifyBad($text)
{
    echo ('
    <div class="notification is-danger floating" id="bad-login">
        <button class="delete"></button>
        ' . $text . '
    </div>
    ');
}

?>