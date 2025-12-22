<?php

namespace SiteCockpit\EasyVisionBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use SiteCockpit\EasyVisionBundle\SiteCockpitEasyVisionBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(SiteCockpitEasyVisionBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
