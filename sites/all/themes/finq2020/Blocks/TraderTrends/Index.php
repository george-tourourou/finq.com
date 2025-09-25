<?php
$popularIUnstrumentsRepository = new PopularInstruments();
$PopularInstrumentsGroup = $popularIUnstrumentsRepository->GetPopularInstrumentsGroupByCategory();

function GetPopularInstrumentsAlias($PopularInstrumentsGroup)
{
    $instruments = [];

    foreach ($PopularInstrumentsGroup as $group) {
        foreach ($group->elements as $element) {
            array_push($instruments, $element->Alias);
        }
    }

    return $instruments;
}

$cssClassName = "tab-pane fade in active";
foreach ($PopularInstrumentsGroup as $group) {
    ?>
    <div id="<?php echo $group->category; ?>" class="<?php echo $cssClassName; ?> col-12">
        <div id="<?php echo $group->category; ?>-carousel" class="col-12" data-ride="carousel">
            <?php foreach ($group->elements as $element) { ?>
                <div>
                    <div id="<?php echo $element->Alias; ?>-instrument" class="instrument">
                        <div class="col-12 wrapper">
                            <div class="col-12 name">
                                <b><?php echo $element->Alias; ?></b>
                                <span><?php echo $element->Name; ?></span>
                            </div>
                            <div class="info">
                                <span>CHANGED(1D)</span>
                                <div class="col-12">
                                    <div class="col-6 sell">
                                        <span>SELL</span>
                                        <b>1.2988</b>
                                    </div>
                                    <div class="col-6 buy">
                                        <span>BUY</span>
                                        <b>0.6498</b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="percentage">
                            <div class="green">
                                <div class="red" style="width: 50%;">
                                </div>
                            </div>
                        </div>
                        <div class="percentage-descr">
                            <div class="col-6 sell">
                                <span>[translate_kw_traders_buying_now]</span>
                                <b>50%</b>
                            </div>
                            <div class="col-6 buy">
                                <span>[translate_kw_traders_selling_now]</span>
                                <b>50%</b>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
    $cssClassName = "tab-pane fade";
}
?>

<script>
    FrontPage(<?php echo json_encode(GetPopularInstrumentsAlias($PopularInstrumentsGroup))?>);
</script>