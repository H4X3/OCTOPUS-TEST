<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "octopus:current.exchange.rate",
            ".default",
            array(
                "ADD_PERCENT_AUTH" => "",
                "ADD_PERCENT_NO_AUTH" => "5",
                "COMPONENT_TEMPLATE" => ".default",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO"
            ),
            false
        ); ?>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>