<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */

$this->setFrameMode(true);

?>
<form action='<?= $arResult['FORM_ACTION']; ?>'>
    <?php foreach ($arResult['HIDDEN'] as $hidden) { ?>
        <input
                type='hidden'
                name='<?= $hidden['CONTROL_NAME']; ?>'
                id='<?= $hidden['CONTROL_ID']; ?>'
                value='<?= $hidden['HTML_VALUE']; ?>'
        >
    <?php } ?>
    <?php foreach ($arResult['ITEMS'] as $item) { ?>
        <?php if (empty($item['VALUES']) || isset($item['PRICE'])) {
            continue;
        } ?>
        <div>
            <div><?= $item['NAME']; ?></div>
            <?php switch ($item['DISPLAY_TYPE']) {
                case 'A': // число от-до, с ползунком
                case 'B': // число от-до ?>
                    <div>
                        <label for='<?= $item['VALUES']['MIN']['CONTROL_ID']; ?>'>
                            <input
                                    type='text'
                                    name='<?= $item['VALUES']['MIN']['CONTROL_NAME']; ?>'
                                    id='<?= $item['VALUES']['MIN']['CONTROL_ID']; ?>'
                                <?php if (!empty($item['VALUES']['MIN']['HTML_VALUE'])) { ?>
                                    value='<?= $item['VALUES']['MIN']['HTML_VALUE']; ?>'
                                <?php } ?>
                            >
                        </label>
                        <label for='<?= $item['VALUES']['MAX']['CONTROL_ID']; ?>'>
                            <input
                                    type='text'
                                    name='<?= $item['VALUES']['MAX']['CONTROL_NAME']; ?>'
                                    id='<?= $item['VALUES']['MAX']['CONTROL_ID']; ?>'
                                <?php if (!empty($item['VALUES']['MAX']['HTML_VALUE'])) { ?>
                                    value='<?= $item['VALUES']['MAX']['HTML_VALUE']; ?>'
                                <?php } ?>
                            >
                        </label>
                    </div>
                    <?php break; ?>
                <?php case 'P': // выпадающий список ?>
                <?php case 'K': // радиокнопки ?>
                    <div>
                        <?php foreach ($item['VALUES'] as $value) { ?>
                            <label for='<?= $value['CONTROL_ID']; ?>'>
                                <input
                                        type='radio'
                                        value='<?= $value['HTML_VALUE_ALT']; ?>'
                                        name='<?= $value['CONTROL_NAME_ALT']; ?>'
                                        id='<?= $value['CONTROL_ID']; ?>'
                                    <?php if (isset($value['CHECKED']) && $value['CHECKED']) { ?>
                                        checked='checked'
                                    <?php } ?>
                                >
                                <span><?= $value['VALUE']; ?></span>
                            </label>
                        <?php } ?>
                    </div>
                    <?php break; ?>
                <?php case 'F': // флажки ?>
                    <div>
                        <?php foreach ($item['VALUES'] as $value) { ?>
                            <label for='<?= $value['CONTROL_ID']; ?>'>
                                <input
                                        type='checkbox'
                                        value='<?= $value['HTML_VALUE']; ?>'
                                        name='<?= $value['CONTROL_NAME']; ?>'
                                        id='<?= $value['CONTROL_ID']; ?>'
                                    <?php if (isset($value['CHECKED']) && $value['CHECKED']) { ?>
                                        checked='checked'
                                    <?php } ?>
                                />
                                <span><?= $value['VALUE']; ?></span>
                            </label>
                        <?php } ?>
                    </div>
                    <?php break; ?>
                <?php } ?>
        </div>
    <?php } ?>
    <input type='submit' name='set_filter' value='Показать'>
    <input type='submit' name='del_filter' value='Сбросить'>
</form>