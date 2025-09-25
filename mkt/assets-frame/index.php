<?php
include "/var/www/www.trade.com/wp-content/plugins/tch-instruments/model/cfd_assets.php";
include "/var/www/www.trade.com/wp-content/plugins/tch-instruments/model/cfd_assets_list.php";
include "/var/www/www.trade.com/wp-content/plugins/tch-instruments/code/cfd_instruments_repository.php";
//
//include_once "tch-instruments/model/cfd_assets.php";
//include_once "tch-instruments/model/cfd_assets_list.php";
//include_once "tch-instruments/code/cfd_instruments_repository.php";
function tch_instruments_table($category, $loadPHPFiles, $isPopular) {
    if($loadPHPFiles) {
        include getcwd()."/wp-content/plugins/tch-instruments/model/cfd_assets.php";
        include getcwd()."/wp-content/plugins/tch-instruments/model/cfd_assets_list.php";
        include getcwd()."/wp-content/plugins/tch-instruments/code/cfd_instruments_repository.php";
    }
    $cfdInstrumentsRepository = new CFDInstrumentsRepository();

    if($isPopular) {
        $model = $cfdInstrumentsRepository->GetInstrumentsByCategory($category);
    } else {
        $model = $cfdInstrumentsRepository->GetAssetList($category);
    }
    $content = "<div class='overflow-x-mobile'>";
    $content .= "<table class='instruments-container'>
            <thead>
                <tr>
                    <th>Instrument</th>
                    <th>Change</th>
                    <th>Buy</th>
                    <th>Sell</th>
                    <th class='chart-img-cell'>6h Trend</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($model->List as $item) {
        $content .= "<tr class='instrument-".$item->TickerName."' attr-ticker-name='".$item->TickerName."'>";
        $content .= "<td>";
//        $content .=  '<a href="/'.$model->Language.'/'.$model->Regulator.'/instruments/?ticker_name='.$item->TickerName.'">'.$item->DisplayName.'</a>';
        $content .=  '<a target="_top" href="/'.$model->Language.'/instruments/'.$item->TickerName.'">'.$item->DisplayName.'</a>';
        $content .=  "</td>";
        $content .=  "<td class='change'>-</td>
                <td class='buy'>-</td>
                <td class='sell'>-</td>
                ";
        $content .= '<td><img class="chart-img" src="https://charts-mini.extsrv.com/'.$item->TickerName.'.png?'.$model->Timestamp.'"></td>';

    }
    $content .= '</tbody></table></div>';
    $content .= '';
    $content .= '';


    return $content;
}


//function tch_search_instrument($category, $loadPHPFiles, $isPopular) {
//    if($loadPHPFiles) {
//        include getcwd()."/wp-content/plugins/tch-instruments/model/cfd_assets.php";
//        include getcwd()."/wp-content/plugins/tch-instruments/model/cfd_assets_list.php";
//        include getcwd()."/wp-content/plugins/tch-instruments/code/cfd_instruments_repository.php";
//    }
//
//    $cfdInstrumentsRepository = new CFDInstrumentsRepository();
//
//    if($isPopular) {
//        $model = $cfdInstrumentsRepository->GetInstrumentsByCategory($category);
//    }
//    else {
//        $model = $cfdInstrumentsRepository->GetAssetList($category);
//    }
//    $content = "<div class='search-area'>";
//    $content .= "<form id='search-form'>";
//    $content .= "<input type='text' id='search-input' oninput='search()' placeholder='".__('Search our Instruments','fuctions_string')."'>";
//    $content .= "</form>";
//    $content .= "<div id='search-results-area' style='display: none;'><ul id='search-results'></ul></div>";
//    $content .= "<ul id='data-list' style='display: none;'>";
//    foreach ($model->List as $item) {
//        $content .= "<li>";
//        $content .= "<span class='instrument-name'>";
//        $content .=  '<a href="/'.$model->Language.'/'.$model->Regulator.'/instruments/?ticker_name='.$item->TickerName.'">'.$item->DisplayName.'</a>';
//        $content .=  "</span>";
//        $content .= '</li>';
//    }
//
//    $content .= "<li style='display: none;'><span id='end-of-results' class='instrument-name'>".__('- End of results -','fuctions_string')."</span></li>
//			<li style='display: none;'><span id='no-matching-results' class='instrument-name'>".__('- No matching results found -','fuctions_string')."</span></li>";
//    $content .= "</ul>";
//    $content .= "</div>";
//    $content .= '<script type="text/javascript" src="/wp-content/plugins/tch-instruments/js/instruments-search.js?v2.03"></script>';
//    return $content;
//}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assets Table</title>

    <link rel="stylesheet" href="style.css?<?= rand() ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://www.trade.com/wp-content/plugins/tch-instruments/js/asset-instruments.js?21ss"></script>
</head>
<body>

<!--<p>Results</p>-->
<p></p>
<!--<p>END Results</p>-->
<div class="tabs">
    <div class="tab" onclick="openTab('tab_forex')" data-tab="tab_forex">
        <span class="nav-link-text wd-tabs-title">FOREX</span>
    </div>
    <div class="tab" onclick="openTab('tab_bonds')" data-tab="tab_bonds">
        <span class="nav-link-text wd-tabs-title">BONDS</span>
    </div>
    <div class="tab" onclick="openTab('tab_indices')" data-tab="tab_indices">
        <span class="nav-link-text wd-tabs-title">INDICES</span>
    </div>
    <div class="tab" onclick="openTab('tab_crypto')" data-tab="tab_crypto">
        <span class="nav-link-text wd-tabs-title">Crypto</span>
    </div>
    <div class="tab" onclick="openTab('tab_commodities')" data-tab="tab_commodities">
        <span class="nav-link-text wd-tabs-title">Commodities</span>
    </div>
    <div class="tab" onclick="openTab('tab_shares')" data-tab="tab_shares">
        <span class="nav-link-text wd-tabs-title">Shares</span>
    </div>
    <div class="tab" onclick="openTab('tab_etfs')" data-tab="tab_etfs">
        <span class="nav-link-text wd-tabs-title">ETFs</span>
    </div>
</div>


<div id="tab_forex" class="tabcontent" style="display: block;">
    <?=tch_instruments_table("forex", false, true);?>
</div>

<div id="tab_bonds" class="tabcontent">
    <?=tch_instruments_table("bonds", false, true);?>
</div>

<div id="tab_indices" class="tabcontent">
    <?=tch_instruments_table("indices", false, true);?>
</div>

<div id="tab_crypto" class="tabcontent">
    <?=tch_instruments_table("crypto", false, true);?>
</div>

<div id="tab_commodities" class="tabcontent">
    <?=tch_instruments_table("commodities", false, true);?>
</div>
<div id="tab_shares" class="tabcontent">
    <?=tch_instruments_table("stocks", false, true);?>
</div>

<div id="tab_etfs" class="tabcontent">
    <?=tch_instruments_table("etfs", false, true);?>
</div>

<script>
    function openTab(tabName) {
        var i, tabcontent, tabs;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tabs = document.getElementsByClassName("tab");
        for (i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove("active");
        }

        document.getElementById(tabName).style.display = "block";
        document.querySelector('.tab[data-tab="' + tabName + '"]').classList.add("active");
    }
</script>


</body>
</html>

<!--return tch_stocks_table("USA");-->