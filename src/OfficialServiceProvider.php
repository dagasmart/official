<?php
declare(strict_types=1);
namespace DagaSmart\Official;

use Exception;
use DagaSmart\BizAdmin\Renderers\Form;
use DagaSmart\BizAdmin\Renderers\TextControl;
use DagaSmart\BizAdmin\Extend\ServiceProvider;


class OfficialServiceProvider extends ServiceProvider
{

    // 路由菜单
    protected $menu = [
        [
            'parent' => NULL,
            'title' => '智慧官网',
            'url' => '/extension/official',
            'url_type' => 1,
            'icon' => 'arcticons:emoji-web',
        ],
        [
            'parent' => '智慧官网',
            'title' => '站点管理',
            'url' => '/extension/official/site',
            'url_type' => 1,
            'icon' => 'arcticons:ip-webcam',
        ],
        [
            'parent' => '站点管理',
            'title' => '网站设置',
            'url' => '/extension/official/site/settings',
            'url_type' => 1,
            'icon' => 'basil:settings-adjust-outline',
        ],
        [
            'parent' => '站点管理',
            'title' => '导航菜单',
            'url' => '/extension/official/site/menu',
            'url_type' => 1,
            'icon' => 'line-md:menu-unfold-left',
        ],
        [
            'parent' => '站点管理',
            'title' => '主题模版',
            'url' => '/extension/official/site/theme',
            'url_type' => 1,
            'icon' => 'icon-park-outline:theme',
        ],
        [
            'parent' => '站点管理',
            'title' => '主题商城',
            'url' => '/extension/official/site/shop',
            'url_type' => 1,
            'icon' => 'arcticons:themes',
        ],
        [
            'parent' => '智慧官网',
            'title' => '内容管理',
            'url' => '/extension/official/context',
            'url_type' => 1,
            'icon' => 'fluent:data-usage-settings-20-regular',
        ],
        [
            'parent' => '内容管理',
            'title' => '菜单管理',
            'url' => '/extension/official/context/menu',
            'url_type' => 1,
            'icon' => 'vaadin:tabs',
        ],
        [
            'parent' => '内容管理',
            'title' => '轮播管理',
            'url' => '/extension/official/context/slider',
            'url_type' => 1,
            'icon' => 'solar:slider-minimalistic-horizontal-line-duotone',
        ],
        [
            'parent' => '内容管理',
            'title' => '广告管理',
            'url' => '/extension/official/context/advert',
            'url_type' => 1,
            'icon' => 'simple-icons:adventofcode',
        ],
        [
            'parent' => '内容管理',
            'title' => '留言联系',
            'url' => '/extension/official/contact',
            'url_type' => 1,
            'icon' => 'fluent:contact-card-link-20-regular',
        ],
    ];


    // 操作授权
    protected $auth = [

        // 留言联系
        ['name' => '新增', 'namespace' => 'dagasmart.official',  'code' => 'extension.official.contact', 'abbr' => 'create', 'custom_order' => 1],
        ['name' => '删除', 'namespace' => 'dagasmart.official',  'code' => 'extension.official.contact', 'abbr' => 'delete', 'custom_order' => 2],
        ['name' => '编辑', 'namespace' => 'dagasmart.official',  'code' => 'extension.official.contact', 'abbr' => 'update', 'custom_order' => 3],
        ['name' => '查看', 'namespace' => 'dagasmart.official',  'code' => 'extension.official.contact', 'abbr' => 'showed', 'custom_order' => 4],
        ['name' => '筛选', 'namespace' => 'dagasmart.official',  'code' => 'extension.official.contact', 'abbr' => 'search', 'custom_order' => 5],
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

    public function boot(): void
    {
        parent::boot();

        // ✅ 自动注册 Commands 目录下所有命令类
        if ($this->app->runningInConsole()) {
            $this->commands($this->discoverCommands());
        }

        // ✅ 加载调度
        $this->registerConsoleRoutes();
    }

    /**
     * 自动扫描 Console/Commands 目录下的所有命令类
     *
     * @return array <class-string<Command>>
     */
    protected function discoverCommands(): array
    {
        $commands = [];
        $dir = __DIR__ . '/Console/Commands';

        // 目录不存在直接返回空
        if (!is_dir($dir)) {
            return $commands;
        }

        foreach (glob($dir . '/*.php') as $file) {
            $className = __NAMESPACE__ . '\\Console\\Commands\\' . pathinfo($file, PATHINFO_FILENAME);

            if (!class_exists($className)) {
                continue;
            }

            $reflection = new \ReflectionClass($className);
            if ($reflection->isAbstract()) {
                continue;
            }

            $commands[] = $className;
        }

        return $commands;
    }

    /**
     * 加载调度文件
     * @return void
     */
    protected function registerConsoleRoutes(): void
    {
        $consoleFile = __DIR__ . '/Console/console.php';

        if (file_exists($consoleFile)) {
            require $consoleFile;
        }
    }

	public function settingForm(): ?Form
	{
	    return $this->baseSettingForm()->body([
            TextControl::make()->name('value')->label('Value')->required(),
	    ]);
	}
}
