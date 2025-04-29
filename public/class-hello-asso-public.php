<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://helloasso.com
 * @since      1.0.3
 *
 * @package    Hello_Asso
 * @subpackage Hello_Asso/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Hello_Asso
 * @subpackage Hello_Asso/public
 * @author     HelloAsso
 */
class Hello_Asso_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hello_Asso_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hello_Asso_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, esc_html(plugin_dir_url(__FILE__)) . 'css/hello-asso-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hello_Asso_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hello_Asso_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/hello-asso-public.js', array('jquery'), $this->version, false);
	}

	public function loadShortcode()
	{
		add_shortcode('helloasso', 'ha_shortcode');

		function ha_shortcode($atts)
		{
			$url = $atts['campaign'];
			$type = $atts['type'];
			$allowed_styles = array(
				'style' => array(
					'width' => array(),
					'height' => array()
				)
			);

			$pattern = '/^\d+px$/';

			$height = "750px";
			$width = "100%";
			if ($type == "widget-bouton") {
				$height = preg_match($pattern, $atts['height'] ?? 0) ? $atts['height'] : "70px";
				$width = '200px';
			} else if ($type == "widget") {
				$height = preg_match($pattern, $atts['height'] ?? 0) ? $atts['height'] : "750px";
				$width = '100%';
			} else if ($type == "widget-vignette") {
				$height = preg_match($pattern, $atts['height'] ?? 0) ? $atts['height'] : "450px";
				$width = '350px';
			} else {
				$type = "";
			}

			if (!str_starts_with($url, "https://www.helloasso.com/") && !str_starts_with($url, "https://www.helloasso-sandbox.com/")) {
				$url = "";
			}

			ob_start();
?>
			<iframe
				id="idIframe"
				src="<?= esc_url($url); ?><?= esc_html($type); ?>"
				<?= wp_kses('height=' . $height . '"', $allowed_styles); ?>
				<?= wp_kses('width=' . $width . '"', $allowed_styles); ?>
				frameborder="0"
				loading="lazy"
				allowtransparency="true"
				onload="resizeIframeMessage()"></iframe>
<?php
			return ob_get_clean();
		}
	}
}
