<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

// 1. Rename the Legend Label
$GLOBALS['TL_LANG']['tl_settings']['easy_vision_legend'] = 'easyVision by SiteCockpit';

// 2. Add the field to the selector list for AJAX toggling
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'easyVisionEnable';

// 3. Define the fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['easyVisionEnable'] = [
    'label'     => ['Enabled', 'Check this checkbox to enable easyVision'],
    'inputType' => 'checkbox',
    'eval'      => ['submitOnChange' => true, 'tl_class' => 'clr'],
    'sql'       => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['easyVisionKey'] = [
    'label'     => ['Integration Key', 'Enter your integration key from the SiteCockpit backend here'],
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
