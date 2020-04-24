<?php

declare(strict_types=1);
//------------------------------------------------------------- flattenArray
function flattenArray(array $nested_arrays): void
{
    foreach ($nested_arrays as $key => $value) {
        if (gettype($value) !== 'array') {
            echo ('<pre>' . var_export($key, true) . ' => '
                . var_export($value, true) . '</pre>');
        } else {
            flattenArray($value);
        }
    }
}

//--------------------------------------------------------- prettyPrintArray
function prettyPrintArray(array $nested_arrays): void
{
    foreach ($nested_arrays as $key => $value) {
        if (gettype($value) !== 'array') {
            echo ('<li class="dump">' . $key . ' : '
                . $value . '</li>');
        } else {
            echo ('<ul class="dump">' . $key);
            prettyPrintArray($value);
            echo ('</ul>');
        }
    }
}
//---------------------------------------------------------------- dumpArray
function dumpArray(array $nested_arrays): void
{
    foreach ($nested_arrays as $key => $value) {
        if (gettype($value) !== 'array') {
            echo ('<li style="margin-left: 2rem;color: teal; background-color: white">'
                . '<span style="color : steelblue;font-weight : bold;">'
                . $key . '</span> : '
                . $value . '</li>');
        } else {
            /* ignore same level recursion */
            if ($nested_arrays !== $value) {
                echo ('<details><summary style="color : tomato; font-weight : bold;">'
                    . $key . '<span style="color : steelblue;font-weight : 100;"> ('
                    . count($value) . ')</span>'
                    . '</summary><ul style="font-size: 0.75rem; background-color: ghostwhite">');
                dumpArray($value);
                echo ('</ul></details>');
            }
        }
    }
}