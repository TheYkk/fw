<?php
/*************************************************
 * TheYkk's fw
 * View Library
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
 *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
namespace System\Libs\View;

use Windwalker\Edge\Cache\EdgeFileCache;
use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader;

class View
{
    // Active Theme
    private $theme = null;

    /**
     * Render View File
     *
     * @param string $file
     * @param array $vars
     * @param boolean $cache
     * @return void
     * @throws \Windwalker\Edge\Exception\EdgeException
     */
    public function render($file, $vars = [], $cache = false)
    {
        $paths 	= [APP_DIR . 'Views'];

        $loader = new EdgeFileLoader($paths);
        $loader->addFileExtension('.blade.php');

        if ($cache === false)
            $edge = new Edge($loader);
        else
            $edge = new Edge($loader, null, new EdgeFileCache(APP_DIR . '/Storage/Cache'));

        $compiler = $edge->getCompiler();

        $compiler->directive('lang', function ($expression)
        {
            return "<?php echo __$expression; ?>";
        });

        $compiler->directive('burl', function ($expression)
        {
            return "<?php echo base_url$expression; ?>";
        });

        if (is_null($this->theme))
            echo $edge->render($file, $vars);
        else
            echo $edge->render($this->theme . '.' . $file, $vars);
    }

    /**
     * Set Activated Theme
     *
     * @param string $theme
     * @return $this
     * @throws \Exception
     */
    public function theme($theme)
    {
        if (file_exists(APP_DIR . 'Views/' . $theme)) {
            $this->theme = $theme;
        } else {
            throw new \System\Libs\Exception\ExceptionHandler("Hata", "Tema dizini bulunamadı. { $theme }");
        }

        return $this;
    }
}
