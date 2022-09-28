<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "GROUPS" => array(
        "BASE" => array(
            "NAME" => GetMessage("SETTINGS")
        ),
    ),
    "PARAMETERS" => array(
        "ADD_PERCENT_AUTH" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("ADD_PERCENT_MESS_AUTH"),
            "TYPE" => "NUMBER",
            "DEFAULT" => "",
        ),
        "ADD_PERCENT_NO_AUTH" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("ADD_PERCENT_MESS_NO_AUTH"),
            "TYPE" => "NUMBER",
            "DEFAULT" => "",
        ),
    ),
);