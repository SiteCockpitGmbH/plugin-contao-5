<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'easyVisionEnable';

$GLOBALS['TL_DCA']['tl_settings']['fields']['easyVisionEnable'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['easyVisionEnable'],
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['easyVisionKey'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['easyVisionKey'],
    'inputType' => 'text',
    'eval' => ['tl_class' => 'w50', 'decodeEntities' => true, 'mandatory' => true],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['easyVisionInfo'] = [
    'input_field_callback' => static function () {
        $formatLine = static function ($labelKey, $urlKey) {
            $label = $GLOBALS['TL_LANG']['tl_settings'][$labelKey] ?? $labelKey;
            $url = $GLOBALS['TL_LANG']['tl_settings'][$urlKey] ?? '#';

            return sprintf(
                '<strong>%s:</strong> <a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
                $label,
                $url,
                $url,
            );
        };

        $content = $formatLine('easyVisionManufacturerLabel', 'easyVisionManufacturerUrl').'<br>';
        $content .= $formatLine('easyVisionDocsLabel', 'easyVisionDocsUrl').'<br>';
        $content .= $formatLine('easyVisionSupportLabel', 'easyVisionSupportUrl');

        return '<div class="widget clr w50" style="margin-top: 15px;">
            <p class="tl_info">'.$content.'</p>
        </div>';
    },
];

$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['easyVisionEnable'] = 'easyVisionKey,easyVisionInfo';

$GLOBALS['TL_DCA']['tl_settings']['config']['onload_callback'][] = static function (): void {
    PaletteManipulator::create()
        ->addLegend('easy_vision_legend', 'general_legend', PaletteManipulator::POSITION_AFTER)
        ->addField('easyVisionEnable', 'easy_vision_legend')
        ->applyToPalette('default', 'tl_settings')
    ;
};
