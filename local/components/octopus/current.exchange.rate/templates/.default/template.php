<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
?>

<? if ($arResult['COURSES']): ?>
    <p><?= GetMessage("USD_TEXT"); ?> <b><?= $arResult['COURSES']['USD']; ?> ₽</b></p>
    <p><?= GetMessage("EUR_TEXT"); ?> <b><?= $arResult['COURSES']['EUR']; ?> ₽</b></p>
<? else: ?>
    <?= GetMessage("ERROR"); ?>
<? endif; ?>
