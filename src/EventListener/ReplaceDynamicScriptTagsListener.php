<?php

declare(strict_types=1);

namespace SiteCockpit\EasyVisionBundle\EventListener;

use Contao\Config;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('replaceDynamicScriptTags')]
class ReplaceDynamicScriptTagsListener
{
    public function __invoke(string $buffer): string
    {
        if (!Config::get('easyVisionEnable') || !Config::get('easyVisionKey')) {
            return $buffer;
        }

        $key = trim(Config::get('easyVisionKey'));

        $GLOBALS['TL_BODY'][] = \sprintf(
            "<script type='module' src='https://cdn.sitecockpit.com/cdn/app.js' data-easy-vision-key='%s'></script>",
            $key,
        );

        return $buffer;
    }
}
