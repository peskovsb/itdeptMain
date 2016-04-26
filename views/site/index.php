<?php
$dbConfig = @require '../config/db.php';
@require '../config/classPDO.php';
$db = new Database($dbConfig['dsn'],$dbConfig['username'],$dbConfig['password']);
        /*
         * Getting All @Locations;
         */
        $sql = 'SELECT *,CONCAT(staff_lastname," ",staff_name) as profile,CONCAT(company_prefix, type_prefix, comp_name) as webname FROM computers LEFT JOIN staff ON computers.comp_profile = staff.staff_id LEFT JOIN company ON computers.comp_company = company.company_id LEFT JOIN computers_type ON computers_type.type_id = computers.comp_type ORDER by id DESC';
        $tb = $db->connection->prepare($sql);
        $tb->execute();
        $arrComputers = $tb->fetchAll(PDO::FETCH_ASSOC);

        //echo '<pre>'; print_r($arrComputers); echo '</pre>';

/* @var $this yii\web\View */

$this->title = 'Компьютерная техника';
?>
<div class="bgshadow"></div>
<div class="centerElement">
    <div class="innerCenterElement">
        <svg aria-hidden="true" class="octicon-main" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path d="M7.48 8l3.75 3.75-1.48 1.48-3.75-3.75-3.75 3.75-1.48-1.48 3.75-3.75L0.77 4.25l1.48-1.48 3.75 3.75 3.75-3.75 1.48 1.48-3.75 3.75z"></path></svg>
        <h2 class="flowWindow">
            
        </h2>
        <div id="spinnerAjax" style="text-align: center;padding:35px 0;color:#4078c0"><i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i></div>
        <div id="completeAjax" style="text-align: center;padding: 35px 0px;color: #090;display:none">
            <i style="font-size: 5em;" class="fa fa-check-circle-o" aria-hidden="true"></i>
        </div>
        <div style="opacity: 0;position: absolute;" id="contentAjax"></div>
    </div>
</div>


   <?php

    /*
    * * * JSON ON PHP WORKING **
    */

    $futureJSON = [
        [
            'id' => 1111,
            'fio'           => 'Пупкин Иван Иванович',
            'IPadr'        => '192.168.0.1',
            'status'        => '1',
            'webname'      => 'BLWS002',
            'typedevice'    => 'WS',
            'location'      => '1'
        ],
        [
            'id' => rand(1,2002),
            'fio'           => 'Скворцов Иван Иванович',
            'IPadr'        => '192.168.0.1',
            'status'        => '1',
            'webname'      => 'BLWS001',
            'typedevice'    => 'WS',
            'location'      => '2'
        ],
        [
            'id' => rand(1,2002),
            'fio'           => 'Дмириев Иван Иванович',
            'IPadr'        => '192.168.0.1',
            'status'        => '2',
            'webname'      => 'BLWS003',
            'typedevice'    => 'NB',
            'location'      => '1'
        ],
        [
            'id' => rand(1,2002),
            'fio'           => 'Козлов Иван Иванович',
            'IPadr'        => '192.168.0.2',
            'status'        => '3',
            'webname'      => 'BLWS003',
            'typedevice'    => 'NB',
            'location'      => '1'
        ],
        [
            'id' => rand(1,2002),
            'fio'           => 'Перцев Анатолий Петрович',
            'IPadr'        => '192.168.0.2',
            'status'        => '1',
            'webname'      => 'BLWS003',
            'typedevice'    => 'NB',
            'location'      => '1'
        ],
        [
            'id' => rand(1,2002),
            'fio'           => 'Фркнцев Анатолий Петрович',
            'IPadr'        => '192.168.0.1',
            'status'        => '2',
            'webname'      => 'BLWS003',
            'typedevice'    => 'NB',
            'location'      => '1'
        ],
    ];


    $futureJSON = $arrComputers;
    // echo '<pre>'; print_r($futureJSON); echo '</pre>';

/*    for($i=0;$i<50;$i++){

        $futureJSON[] = [
            'id'            => rand(0,1000),
            'fio'           => rand(0,1000),
            'IPadr'        => '192.168.0.1',
            'status'        => '1',
            'webname'      => 'BLWS003',
            'typedevice'    => 'NB',
            'location'      => '1'
        ];
    }*/
    ?>


<?php 

$arrayData2 = [
    'value1'=>'webname',
    'value2'=>'comp_ip',
    'value3'=>'profile',
    'value4'=>'comp_status',
    'value5'=>'id'
];

function buldTemplate ($type,$arrayData){
    if($type == "JS"){
        foreach($arrayData as $Items){
            $values[] = '"+'.$Items.'+"';
        }
        
    }else if($type == "PHP"){
        foreach($arrayData as $Items){
            $values[] = $Items;
        }
    }
}

echo '<table>';
$tplMy = <<<HTML
<tr>
            <td><a data-id="{value5}" onclick="$(this).flowWindow({'ajaxLink' : 'ajax/komputers/test.php', 'header' : 'Редактировать:<br>Компьютерная техника' }); return false;" class="linkTbl" href="javascript:void(0);">{value1}</a></td>
            <td>{value2}</td>
            <td>{value3}</td>
            <td>{value4}</td>
           <td>
                <a data-id="{value5}" onclick="$(this).flowWindow({'ajaxLink' : 'ajax/komputers/test.php', 'header' : 'Редактировать:<br>Компьютерная техника' });return false;"  href="#" class="pencilTbl toolTcontainer correctDataWS">
                    <svg aria-hidden="true" class="octicon octicon-pencil" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path d="M0 12v3h3l8-8-3-3L0 12z m3 2H1V12h1v1h1v1z m10.3-9.3l-1.3 1.3-3-3 1.3-1.3c0.39-0.39 1.02-0.39 1.41 0l1.59 1.59c0.39 0.39 0.39 1.02 0 1.41z"></path></svg>
                <span class=ToolT>
                    <span class="ToolTinner">Редактировать</span>
                </span>
                </a>
                <a  data-id="{value5}" onclick="$(this).flowWindow({'ajaxLink' : 'ajax/komputers/testDel.php', 'header' : 'Удалить элемент' });return false;" href="#" class="delTbl toolTcontainer">
                    <svg aria-hidden="true" class="octicon octicon-trashcan" height="16" version="1.1" viewBox="0 0 12 16" width="12" color="#c11"><path d="M10 2H8c0-0.55-0.45-1-1-1H4c-0.55 0-1 0.45-1 1H1c-0.55 0-1 0.45-1 1v1c0 0.55 0.45 1 1 1v9c0 0.55 0.45 1 1 1h7c0.55 0 1-0.45 1-1V5c0.55 0 1-0.45 1-1v-1c0-0.55-0.45-1-1-1z m-1 12H2V5h1v8h1V5h1v8h1V5h1v8h1V5h1v9z m1-10H1v-1h9v1z"></path></svg>
                <span class=ToolT>
                    <span class="ToolTinner">Удалить</span>
                </span>
                </a>
                <a href="#" class="historyTbl toolTcontainer">
                    <svg aria-hidden="true" class="octicon octicon-clippy" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path d="M2 12h4v1H2v-1z m5-6H2v1h5v-1z m2 3V7L6 10l3 3V11h5V9H9z m-4.5-1H2v1h2.5v-1zM2 11h2.5v-1H2v1z m9 1h1v2c-0.02 0.28-0.11 0.52-0.3 0.7s-0.42 0.28-0.7 0.3H1c-0.55 0-1-0.45-1-1V3c0-0.55 0.45-1 1-1h3C4 0.89 4.89 0 6 0s2 0.89 2 2h3c0.55 0 1 0.45 1 1v5h-1V5H1v9h10V12zM2 4h8c0-0.55-0.45-1-1-1h-1c-0.55 0-1-0.45-1-1s-0.45-1-1-1-1 0.45-1 1-0.45 1-1 1h-1c-0.55 0-1 0.45-1 1z"></path></svg>
                <span class=ToolT>
                    <span class="ToolTinner">История</span>
                </span>
                </a>
            </td>
        </tr>
HTML;



/*
 *   PHP MODIFICATOR
 *   @param1 : array from DB
 *   @param2 : поля для подстановки
 *   Шаблон в ХТМЛ (с полями для подстановки в формате: {valueN})
 *   
*/
function phpModificator($arrayData,$arrayFields,$tpl){
  foreach($arrayFields as $key=>$items){
        $value = $arrayData[$items];
        if($items=='comp_status'){
            switch($value){
                case 1: $tpl = str_replace("{".$key."}", "<span class='statusWork'>Работает</span>", $tpl);
                break;
                case 2: $tpl = str_replace("{".$key."}", "<span class='statusFree'>Свободен</span>", $tpl);
                break;
                case 3: $tpl = str_replace("{".$key."}", "<span class='statusRepair'>Ремонт</span>", $tpl);
                break;
            }
        }else{
            $tpl = str_replace("{".$key."}", $value, $tpl);
        }
    }
    return $tpl;
}


/*
 * JS MODIFICATOR
 *   @param1 : array from DB
 *   @param2 : поля для подстановки
 *   Шаблон в ХТМЛ (с полями для подстановки в формате: {valueN})
*/
function jsModificator($arrayData,$arrayFields,$tpl){
  foreach($arrayFields as $key=>$items){
        $value = $arrayData[$items];
        $tpl = str_replace("{".$key."}", '"+val.'.$items.'+"', $tpl);
    }
    return $tpl;
}

/*
 * STRING TRANSFORMATION
 * @param : Шаблон в ХТМЛ
*/
$tplMyRender = str_replace(array("\r\n", "\n", "\r"), '', $tplMy);





echo '</table>';

/*
 * STRING HACK TO JS (экрнируем ковычки)
 * @param : Шаблон @STRING TRANSFORMATION
*/
$tplMyRenderJS = str_replace(array("\""), '\"', $tplMyRender);

$tplMyRenderJS = jsModificator($futureJSON[1],$arrayData2,$tplMyRenderJS);

echo "<table id='test'></table>"

?>
<script>

</script>

    <div class="tabsWidget">
        <ul>
            <li><a href="./" class="activeTabWidget">Все</a></li>
            <li><a href="about">работает</a></li>
            <li><a href="#">свободен</a></li>
            <li><a href="#">ремонт</a></li>
        </ul>
    </div>
    
    <ul class="optionsLocations">
        <li><span id="locationOption" class="locationOptionBtn">
            Локация
            <span class="LocationInnerWrapper">
                <ul class="LocationInnerDown">
                    <li><a href="#">Санкт-Петербург</a></li>
                    <li><a href="#">Москва</a></li>
                    <li><a href="#">Екатеринбург</a></li>
                    <li><a href="#">Самара</a></li>
                    <li><a href="#">Сочи</a></li>
                </ul>
            </span>
        </span><div class="LocationsDescriptions">Санкт-Петербург</div></li>
        <li><span id="locationOptionType" class="locationOptionBtn">
            Тип устройства            
            <span class="LocationInnerWrapper">
                <ul class="LocationInnerDown">
                    <li><a href="#">Все</a></li>
                    <li><a href="#">NB</a></li>
                    <li><a href="#">WS</a></li>
                </ul>
            </span>
        </span><div class="LocationsDescriptions">NB</div></li>
    </ul>

    <a onclick="$('#createWS').flowWindow({ 'ajaxLink' : 'ajax/komputers/test.php', 'header' : 'Создать: Компьютерная техника' }); return false;" id="createWS" href="#" class="btncreate">Создать</a>

    <h1 class="mainHeader"><?= $this->title ?></h1>

<div class="successPopUp">
    <svg  aria-hidden="true" class="octicon-x" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path d="M7.48 8l3.75 3.75-1.48 1.48-3.75-3.75-3.75 3.75-1.48-1.48 3.75-3.75L0.77 4.25l1.48-1.48 3.75 3.75 3.75-3.75 1.48 1.48-3.75 3.75z"></path></svg>
    Добавлен новый элемент: <span class="nameDevice"></span>
</div>

    <table class="mainTableTpl">
        <tr>
            <th>Сетевое имя</th>
            <th>IP адрес</th>
            <th>ФИО</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
            <?php

/*
 * PAGINATION BUILDER
 * @param1 : Количество показываемых записей
 * @param2 : array from DB
*/
function paginationBuilder($curentPage,$limit,$arrayData){
    $maxElements = count($arrayData);
    $endPage = ceil($maxElements/$limit);
    echo "<ul class='mainPagination'>";
        $curentPage++;
        for($i=1;$i<=$endPage;$i++){
            if($curentPage == $i){
                $active = 'activePagi';
            }else if ($curentPage==0 && $i==1){
                $active = 'activePagi';
            }else{
                $active = '';
            }
            echo "<li><a class='{$active}' href='#''>{$i}</a></li>";
        }
    echo "</ul>";
}

/*
 * PAGE GENERATOR
 * @param1 : Стартовая страница
 * @param2 : Количество показываемых записей
 * @param3 : array from DB
 * @param4 : поля для подстановки
 * @param5 : Шаблон в XML
*/
function pageGenerator ($startPage,$limit,$arrayData,$arrayFields,$tpl) {
    $maxElements = count($arrayData);
    $startOfShown = ($startPage*$limit);
    $endOfShown = ($startPage*$limit) + $limit;
        foreach($arrayData as $key => $Items){
            if($key>=$startOfShown && $key<$endOfShown){
                echo phpModificator($Items,$arrayFields,$tpl);
            }
        }
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 0;
}
if($page==0 || $page==1){
    $page = 0;
}else{
    $page = $page-1;
}
$limit = 15;

pageGenerator($page,$limit,$futureJSON,$arrayData2,$tplMyRender);
            ?>
    </table>

    <!-- <ul class="mainPagination">
        <li><a href="#" class="activePagi">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
    </ul> -->
    <?php paginationBuilder($page,$limit,$futureJSON);?>

 
    <script>
        var jsonMAIN,objParseJ;
        jsonMAIN = <?=json_encode($futureJSON)?>;



/*$(document).on('click','#soso',function(){
    $someItems = '[{"id": "77","fio":"Edward","IPadr":"192.168.0.77","status":"1","webname":"BLWS7777","typedevice":"WS","location":"1"}]';

    objParseJ = jQuery.parseJSON($someItems);
    jQuery.each(jsonMAIN,function(key,val){
            objParseJ.push(val);
    });
    jsonMAIN = objParseJ; 

});*/


$(document).on('submit','#komputersDelete',function(){
    var FormData, mistake = 0, tpl ='', someObj = [];

    FormData = $(this).serialize();
    $.ajax({
        dataType: "json",
        data: FormData,
        type: "POST",
        url : "ajax/komputers/deleting.php",
        success : function (data) {
            // console.log(data);
            // console.log(data[0].recordID);
            // console.log(objParseJ[0].recordID);
            if(data[0].recordID.length>0) {
                jQuery.each(jsonMAIN,function(key,val){
                        if(data[0].recordID != val.id){
                             someObj.push(val);
                        }
                }); 
                jsonMAIN = someObj;
            }

        index = $('.mainPagination li a.activePagi').text();

            limit = <?=$limit?>;
            if(index==1){
                pageStart = 0;
            }else{
                pageStart = (index-1)*limit;
            }
            pageEnd = pageStart + limit;
            jQuery.each(jsonMAIN,function(key,val){
                // console.log('number: ',key);
                if(key >=  pageStart && key < pageEnd && typeof(val.id)!='undefined'){
                    if(val.profile==null){
                        val.profile = '';
                    }
                    if(val.comp_status){
                        switch(val.comp_status){
                            case '1': val.comp_status = "<span class=\"statusWork\">Работает</span>";
                            break;
                            case '2': val.comp_status = "<span class=\"statusFree\">Свободен</span>";
                            break;
                            case '3': val.comp_status = "<span class=\"statusRepair\">Ремонт</span>";
                            break;
                        }
                        
                    }
                     tpl += "<?=$tplMyRenderJS?>";
                }
            });
            // console.log(tpl);
            $('.mainTableTpl tr').each(function(){
                $thisIndex = $(this).index();
                if($thisIndex > 0 ){
                   $(this).remove();
                }
            });
            //console.log(tpl);
            $('.mainTableTpl tr').eq(0).after(tpl);     
            removeFlowWindow();       
        }
    });
    return false;
});


$(document).ready(function(){

    $('.mainPagination li').click(function(event){
        var index,foo,$thisIndex,tpl = '',page,limit;

        $('.mainPagination li a').removeClass('activePagi');
        $(this).children('a').addClass('activePagi');

        index = $(this).index()+1;
        window.history.pushState(null,null, '?page='+index);

        limit = <?=$limit?>;
        if(index==1){
            pageStart = 0;
        }else{
            pageStart = (index-1)*limit;
        }
        pageEnd = pageStart + limit;


        // console.log(jsonMAIN[index].fio);
        jQuery.each(jsonMAIN,function(key,val){
            // console.log('number: ',key);
            if(key >=  pageStart && key < pageEnd && typeof(val.id)!='undefined'){
                if(val.profile==null){
                    val.profile = '';
                }
                if(val.comp_status){
                    switch(val.comp_status){
                        case '1': val.comp_status = "<span class=\"statusWork\">Работает</span>";
                        break;
                        case '2': val.comp_status = "<span class=\"statusFree\">Свободен</span>";
                        break;
                        case '3': val.comp_status = "<span class=\"statusRepair\">Ремонт</span>";
                        break;
                    }
                    
                }
                 tpl += "<?=$tplMyRenderJS?>";
            }
        });
        // console.log(tpl);
        $('.mainTableTpl tr').each(function(){
            $thisIndex = $(this).index();
            if($thisIndex > 0 ){
               $(this).remove();
            }
        });
        //console.log(tpl);
        $('.mainTableTpl tr').eq(0).after(tpl);
        event.preventDefault();
    });

});


$(document).on('submit','#komputersCreate',function(){
    var FormData, mistake = 0, tpl ='',wbname='';

    FormData = $(this).serialize();

    $('.fieldHeader').css({
        'color'          : '#666',
        'font-weight'    : 'normal'
    });

    $.ajax({
        dataType: "json",
        data: FormData,
        type: "POST",
        // async: false,
        url : "ajax/komputers/validator.php",
        success : function (data) {
            $.each( data, function( key, val ) {
                validFunction(val.mistakeIU,key);
                if(val.mistakeIU == 'mistake'){
                    mistake = 1;
                }
            });
            if(mistake == 0){
                $('.mistakePopUp').hide();
                $.ajax({
                    data: FormData,
                    type: "POST",
                    url : "ajax/komputers/confirm.php",        
                    success : function (data) {
                        $('#komputersCreate').remove();
                        $('#completeAjax').fadeIn('400');
                        setTimeout(function(){
                            removeFlowWindow();
                            
//console.log(data);

//-----------------------------

    index = $('.mainPagination li a.activePagi').text();

        limit = <?=$limit?>;
        if(index==1){
            pageStart = 0;
        }else{
            pageStart = (index-1)*limit;
        }
        pageEnd = pageStart + limit;

        objParseJ = jQuery.parseJSON(data);
        if(objParseJ[0].recordID.length>0) {
            jQuery.each(jsonMAIN,function(key,val){
                if( typeof(val.id)!='undefined'){
                    if(objParseJ[0].recordID == val.id){
                        jsonMAIN[key].webname = objParseJ[0].webname;
                        jsonMAIN[key].comp_ip = objParseJ[0].comp_ip;
                        jsonMAIN[key].profile = objParseJ[0].profile;
                        if(val.profile==null){
                            val.profile = '';
                        }
                        switch(objParseJ[0].comp_status){
                            case '1': objParseJ[0].comp_status = "<span class=\"statusWork\">Работает</span>";
                            break;
                            case '2': objParseJ[0].comp_status = "<span class=\"statusFree\">Свободен</span>";
                            break;
                            case '3': objParseJ[0].comp_status = "<span class=\"statusRepair\">Ремонт</span>";
                            break;
                        }
                        jsonMAIN[key].comp_status = objParseJ[0].comp_status;                        
                    }
                }
            });
        }else{
            $('.successPopUp').show();
            $('.nameDevice').html(objParseJ[0].webname);
            jQuery.each(jsonMAIN,function(key,val){
                    objParseJ.push(val);
            });
            jsonMAIN = objParseJ;
        }
       
        // console.log(wbname);
         

        jQuery.each(jsonMAIN,function(key,val){
            // console.log('number: ',key);
            if(key >=  pageStart && key < pageEnd && typeof(val.id)!='undefined'){
                if(val.comp_status){
                
                    switch(val.comp_status){
                        case '1': val.comp_status = "<span class=\"statusWork\">Работает</span>";
                        break;
                        case '2': val.comp_status = "<span class=\"statusFree\">Свободен</span>";
                        break;
                        case '3': val.comp_status = "<span class=\"statusRepair\">Ремонт</span>";
                        break;
                    }
                    
                }
                 tpl += "<?=$tplMyRenderJS?>";
            }
        });

        $('.mainTableTpl tr').each(function(){
            $thisIndex = $(this).index();
            if($thisIndex > 0 ){
               $(this).remove();
            }
        });
        //console.log(tpl);
        $('.mainTableTpl tr').eq(0).after(tpl);

//------------------------------

                        },700);
                    }
                });
            }
        }
    });

    return false;
});



    </script>


