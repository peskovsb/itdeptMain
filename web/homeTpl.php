<?php 
$tpl = <<<HTML
        <tr>
            <td><a class=\"linkTbl\" href=\"#\">BLWS 002</a></td>
            <td>"+val.IPadr+"</td>
            <td>"+val.fio+"</td>
            <td><span class=\"statusRepair\">Ремонт</span></td>
            <td>
                <a href=\"#\" class=\"pencilTbl toolTcontainer\">
                    <svg aria-hidden=\"true\" class=\"octicon octicon-pencil\" height=\"16\" version=\"1.1\" viewBox=\"0 0 14 16\" width=\"14\"><path d=\"M0 12v3h3l8-8-3-3L0 12z m3 2H1V12h1v1h1v1z m10.3-9.3l-1.3 1.3-3-3 1.3-1.3c0.39-0.39 1.02-0.39 1.41 0l1.59 1.59c0.39 0.39 0.39 1.02 0 1.41z\"></path></svg>
                <span class=ToolT>
                    <span class=\"ToolTinner\">Редактировать</span>
                </span>
                </a>
                <a href=\"#\" class=\"delTbl toolTcontainer\">
                    <svg aria-hidden=\"true\" class=\"octicon octicon-trashcan\" height=\"16\" version=\"1.1\" viewBox=\"0 0 12 16\" width=\"12\" color=\"#c11\"><path d=\"M10 2H8c0-0.55-0.45-1-1-1H4c-0.55 0-1 0.45-1 1H1c-0.55 0-1 0.45-1 1v1c0 0.55 0.45 1 1 1v9c0 0.55 0.45 1 1 1h7c0.55 0 1-0.45 1-1V5c0.55 0 1-0.45 1-1v-1c0-0.55-0.45-1-1-1z m-1 12H2V5h1v8h1V5h1v8h1V5h1v8h1V5h1v9z m1-10H1v-1h9v1z\"></path></svg>
                <span class=ToolT>
                    <span class=\"ToolTinner\">Удалить</span>
                </span>
                </a>
                <a href=\"#\" class=\"historyTbl toolTcontainer\">
                    <svg aria-hidden=\"true\" class=\"octicon octicon-clippy\" height=\"16\" version=\"1.1\" viewBox=\"0 0 14 16\" width=\"14\"><path d=\"M2 12h4v1H2v-1z m5-6H2v1h5v-1z m2 3V7L6 10l3 3V11h5V9H9z m-4.5-1H2v1h2.5v-1zM2 11h2.5v-1H2v1z m9 1h1v2c-0.02 0.28-0.11 0.52-0.3 0.7s-0.42 0.28-0.7 0.3H1c-0.55 0-1-0.45-1-1V3c0-0.55 0.45-1 1-1h3C4 0.89 4.89 0 6 0s2 0.89 2 2h3c0.55 0 1 0.45 1 1v5h-1V5H1v9h10V12zM2 4h8c0-0.55-0.45-1-1-1h-1c-0.55 0-1-0.45-1-1s-0.45-1-1-1-1 0.45-1 1-0.45 1-1 1h-1c-0.55 0-1 0.45-1 1z\"></path></svg>
                <span class=ToolT>
                    <span class=\"ToolTinner\">История</span>
                </span>
                </a>
            </td>
        </tr>
HTML;

echo str_replace(array("\r\n", "\n", "\r"), '', $tpl);