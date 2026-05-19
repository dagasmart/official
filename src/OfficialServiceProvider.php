<?php
declare(strict_types=1);
namespace DagaSmart\Official;

use Exception;
use DagaSmart\BizAdmin\Renderers\Form;
use DagaSmart\BizAdmin\Renderers\TextControl;
use DagaSmart\BizAdmin\Extend\ServiceProvider;


class OfficialServiceProvider extends ServiceProvider
{
    protected $menu = [
        [
            'parent' => NULL,
            'title' => '智慧官网',
            'url' => '/official',
            'url_type' => 1,
            'icon' => 'arcticons:emoji-web',
        ],
        [
            'parent' => '智慧官网',
            'title' => '站点管理',
            'url' => '/official/site',
            'url_type' => 1,
            'icon' => 'arcticons:ip-webcam',
        ],
        [
            'parent' => '站点管理',
            'title' => '网站设置',
            'url' => '/official/site/settings',
            'url_type' => 1,
            'icon' => 'basil:settings-adjust-outline',
        ],
        [
            'parent' => '站点管理',
            'title' => '导航菜单',
            'url' => '/official/site/menu',
            'url_type' => 1,
            'icon' => 'bi:menu-button',
        ],
        [
            'parent' => '站点管理',
            'title' => '主题模版',
            'url' => '/official/site/theme',
            'url_type' => 1,
            'icon' => 'icon-park-outline:theme',
        ],
        [
            'parent' => '站点管理',
            'title' => '主题商城',
            'url' => '/official/site/shop',
            'url_type' => 1,
            'icon' => 'arcticons:themes',
        ],
        [
            'parent' => '智慧官网',
            'title' => '内容管理',
            'url' => '/official/context',
            'url_type' => 1,
            'icon' => 'fluent:data-usage-settings-20-regular',
        ],
        [
            'parent' => '内容管理',
            'title' => '菜单管理',
            'url' => '/official/context/menu',
            'url_type' => 1,
            'icon' => 'vaadin:tabs',
        ],
        [
            'parent' => '内容管理',
            'title' => '轮播管理',
            'url' => '/official/context/slider',
            'url_type' => 1,
            'icon' => 'solar:slider-minimalistic-horizontal-line-duotone',
        ],
        [
            'parent' => '内容管理',
            'title' => '广告管理',
            'url' => '/official/context/advert',
            'url_type' => 1,
            'icon' => 'simple-icons:adventofcode',
        ],
    ];

    /**
     * @return void
     * @throws Exception
     */
    public function register(): void
    {
        parent::register();

        /**加载路由**/
        parent::registerRoutes(__DIR__.'/Http/routes.php');
        /**加载语言包**/
        if ($lang = parent::getLangPath()) {
            $this->loadTranslationsFrom($lang, $this->getCode());
        }

    }

	public function settingForm(): ?Form
	{
	    return $this->baseSettingForm()->body([
            TextControl::make()->name('value')->label('Value')->required(),
	    ]);
	}
}
