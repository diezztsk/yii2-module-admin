<?php

namespace Diezz\ModuleAdmin\Components;

use Diezz\ModuleAdmin\Assets\AdminLteAsset;
use yii\web\View;

/**
 * Class AdminView
 * Default view for the Admin View
 *
 * @package app\modules\admin\components
 */
class AdminView extends View
{
    const SKIN_BLUE = 'skin-blue';
    const SKIN_BLUE_LIGHT = 'skin-blue-light';
    const SKIN_YELLOW = 'skin-yellow';
    const SKIN_YELLOW_LIGHT = 'skin-yellow-light';
    const SKIN_GREEN = 'skin-green';
    const SKIN_GREEN_LIGHT = 'skin-green-light';
    const SKIN_PURPLE = 'skin-purple';
    const SKIN_PURPLE_LIGHT = 'skin-purple-light';
    const SKIN_RED = 'skin-red';
    const SKIN_RED_LIGHT = 'skin-red-light';
    const SKIN_BLACK = 'skin-black';
    const SKIN_BLACK_LIGHT = 'skin-black-light';
    /**
     * Subtitle for view.
     *
     * @var
     */
    public $subTitle;
    /**
     * Sidebar menu config.
     *
     * @var array
     */
    public $sidebarMenuConfig = [];
    /**
     *  Admin layout theme. By default are used blue skin.
     *
     * @var string
     */
    public $skin = self::SKIN_BLUE;
    /**
     * AssetBundle config.
     *
     * @var null|array|string
     */
    public $assetBundleConfig = null;
    /**
     * Company name.
     *
     * @var string
     */
    public $companyName = 'Company';
    /**
     * Asset bundle class-name using by default for admin view.
     *
     * @var string
     */
    protected $defaultAssetBundleClass = AdminLteAsset::class;

    /**
     * Initializes the object.
     *
     * @return void
     */
    public function init()
    {
        $assetConfig = $this->getAssetConfig();
        $assetClassName = $assetConfig['class'];
        $this->assetManager->bundles[$assetClassName] = $this->getAssetConfig();
        if (method_exists($assetClassName, 'register')) {
            call_user_func([$assetClassName, 'register'], $this);
        }
    }

    /**
     * Return config array for create instance of AssetBundle.
     *
     * @return array
     */
    protected function getAssetConfig()
    {
        $config = $this->assetBundleConfig;
        if (null === $config) {
            $config = [];
        }
        if (is_string($config)) {
            $config['class'] = $config;
        }
        if (is_array($config) && !array_key_exists('class', $config)) {
            $config['class'] = $this->defaultAssetBundleClass;
            if (array_key_exists('skin', $config)) {
                $config['skin'] = $this->skin;
            }
        }

        return $config;
    }
}