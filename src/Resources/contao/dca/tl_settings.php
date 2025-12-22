<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

// 1. Rename the Legend Label
// This is now handled automatically by the language file key 'easy_vision_legend'

// 2. Add the field to the selector list for AJAX toggling
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'easyVisionEnable';

// 3. Define the fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['easyVisionEnable'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['easyVisionEnable'], // Reference the language array
    'inputType' => 'checkbox',
    'eval'      => ['submitOnChange' => true, 'tl_class' => 'clr'],
    'sql'       => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['easyVisionKey'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['easyVisionKey'], // Reference the language array
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50', 'decodeEntities' => true, 'mandatory' => true],
    'sql'       => "varchar(255) NOT NULL default ''"
];

// 4. Define the subpalette
$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['easyVisionEnable'] = 'easyVisionKey';

// 5. Register the palette and legend
$GLOBALS['TL_DCA']['tl_settings']['config']['onload_callback'][] = function() {
    PaletteManipulator::create()
        ->addLegend('easy_vision_legend', 'general_legend', PaletteManipulator::POSITION_AFTER)
        ->addField('easyVisionEnable', 'easy_vision_legend')
        ->applyToPalette('default', 'tl_settings');
};
