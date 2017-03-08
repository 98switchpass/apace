<?php
/**
 * Apace
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	  Apace
 * @author	  Apace Dev Team | apacedev@gmail.com
 * @copyright Copyright (c) 2014 - 2017, Apace
 * @license	  http://opensource.org/licenses/MIT	MIT License
 * @link	  https://github.com/apacedev/apace
 * @since	  Version 1.0.0
 * @filesource
 */

/**
 * Plugin class
 *
 * @param	array	$pluginJs	The router class
 * @param	array	$pluginCss	Global accessible database connection object
 * @param	string	$view		View to look for plugins inside
 */
class Plugin {
	
	protected static $pluginJs;

	protected static $pluginCss;

	protected $view;

	/**
	 * Load plugins
	 *
	 * Look for plugins inside view and render them to the view that is passed to the function
	 *
	 * @param	string	$view	View to look for plugins inside
	 */
	public function loadPluginsInView($view) {

		$this->view = $view;

		$pregmatchall = preg_match_all('/{{(.*)}}/U', $view, $matches);
		if ($pregmatchall) {

			foreach ($matches[0] as $match) {

				// Get plugin name
				$getPluginName =  preg_match('/{{(.*)}}/U', $match, $pluginCname);
				$pluginCname = preg_replace('/\s+/', '', strtolower($pluginCname[1]));
				$pluginName = $pluginCname; $pluginCname .= '_plugin_';
				
				// Load the plugins View
				$pluginLayout = PLUGINS_PATH.DS.$pluginName.DS.'view\index.php';
				if (file_exists($pluginLayout)) {

					// ------ Handle plugin view
					// Instantiate plugin controller
					$pluginControllerClass = ucfirst($pluginCname). 'Controller';
					$pluginControllerObject = new $pluginControllerClass();

					// Default plugin function
					$pluginControllerObject->init();

					// Render plugin view
					$plugin_view_object = new View($pluginControllerObject->getData(), $pluginLayout);
					$pluginViewRendered = $plugin_view_object->renderView();

					// Append the rendered plugin view to the view that is passed to the function
					$view = str_replace($match, $pluginViewRendered, $view);

					// ------ Register plugin assets
					if (file_exists(ROOT.DS.'data'.DS.'plugandplay'.DS.$pluginName.DS.'js'.DS.$pluginName.'.js')) {
						$this->js[] = self::getPlugandPlayAsset($pluginName, 'js');
						self::registerPluginJs($this->js);
					}
					if (file_exists(ROOT.DS.'data'.DS.'plugandplay'.DS.$pluginName.DS.'css'.DS.$pluginName.'.css')) {
						$this->css[] = self::getPlugandPlayAsset($pluginName, 'css');
						self::registerPluginCss($this->css);
					}

					$this->view = $view;

				} else {
					// If malformed plugin structure
					$this->view = $view;
				}

			}

			return $this->view;

		} else {
			return $view;
		}
	}

	/**
	 * Get plug and play assets
	 *
	 * Get assets which belongs to loaded plugin
	 *
	 * @param	string	$pluginFolder	Root folder of plugin
	 * @param	string	$assetFolder	Which kind of asset, e.g. js, css
	 * @return	string	Contains http url pointing to the asset
	 */
	public static function getPlugandPlayAsset($pluginFolder, $assetFolder) {
		return Apace::$ac['application']['baseurl'].'plugandplay/'.$pluginFolder.'/'.$assetFolder.'/'.$pluginFolder.'.'.$assetFolder;
	}

	/**
	 * Register plugin javascript assets
	 *
	 * @param	array	$data	Contains javascript assets
	 */
	public static function registerPluginJs($data = array()) {
		self::$pluginJs = $data;
	}

	/**
	 * Get plugin javascript assets
	 *
	 * Returns an echo containing a javascript source from the $pluginJs array
	 */
	public static function getPluginJs() {
		if(count(self::$pluginJs) > 0) {
			foreach (self::$pluginJs as $js) {
				echo '<script type="text/javascript" src="'.$js.'"></script>';
			}
		}
	}

	/**
	 * Register plugin css assets
	 *
	 * @param	array	$data	Contains css assets
	 */
	public static function registerPluginCss($data = array()) {
		self::$pluginCss = $data;
	}

	/**
	 * Get plugin css assets
	 *
	 * Returns an echo containing a css source from the $pluginCss array
	 */
	public static function getPluginCss() {
		if(count(self::$pluginCss) > 0) {
			foreach (self::$pluginCss as $css) {
				echo '<link href="'.$css.'" rel="stylesheet"/>';
			}
		}
	}

}