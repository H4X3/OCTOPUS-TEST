<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("COMP_NAME"),
    "DESCRIPTION" => GetMessage("COMP_DESCR"),
    "PATH" => array(
        "ID" => "Осьминожка",
        "CHILD" => array(
            "ID" => "octopus",
            "NAME" => "Курс валют"
        )
    ),
);
