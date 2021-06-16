<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webcoder_Controller extends CI_Controller {

	public $directory;
	public $controller;
	public $model;
	public $method;


	public function __construct()
	{
		parent::__construct();

		$this->directory 			= $this->router->directory;
		$this->controller 	        = $this->router->class;
		$this->method 				= $this->router->method;
		$this->model 	  			= ucfirst($this->controller)."_model";
        $this->theme = get_setting('site_theme');

		$languages = $this->Language_model->filter(['status' => 1])->order_by('sort', 'ASC')->all();
     
		if($languages)
		{
		  foreach($languages as $language)
		  {

			$this->data['languages'][$language->slug] = [
				'id'		=> $language->id,
				'name'		=> $language->name,
				'code'		=> $language->code,
				'slug'		=> $language->slug,
				'admin'		=> $language->admin,
				'directory'	=> $language->directory
			];

			if($language->default == 1)
			{
				$default_language 		= $language->slug;
			}
		  }
		}

 		$lang_slug = ($this->uri->segment(1)) ? $this->uri->segment(1) : $default_language;

		if(isset($lang_slug) && array_key_exists($lang_slug, $this->data['languages']))
		{
			$current_lang = $lang_slug;
		}
		else
		{
			if($this->session->has_userdata('current_lang'))
			{
				$current_lang = $this->session->userdata('current_lang');
			}
			else
			{
				$current_lang = $default_language;
			}
		}

		$this->session->set_userdata('current_lang', $current_lang);
		$this->config->set_item('language',  $this->data['languages'][$current_lang]['directory']);

		$this->data['current_lang'] 	= $current_lang;
		$this->data['current_lang_id']	= $this->data['languages'][$current_lang]['id'];

		$this->data['controller'] 	= $this->controller;


		//Load Common Language File Per Controller
		$this->lang->load($this->directory.'main');
		//Load Own Language File Per Controller

		if($this->directory != 'admin' && $this->controller != 'module')
		{
			$this->lang->load($this->directory.$this->controller);
		}

        if ( !$this->is_bot($_SERVER['HTTP_USER_AGENT']) ) {
            $this->data['country_code'] = $this->ip_info("Visitor", "countrycode");  
        }
       if(is_null($this->data['country_code']))
            $this->data['country_code']='AZ';
        $ipcountry= $this->db->select('id')->where('code',$this->data['country_code'])->get('wc_country')->result();
        $this->data['ip_country'] = $ipcountry[0];

        $this->load->model('Page_model');
         $this->data['terms'] = $this->Page_model->fields(['title','description'])->filter(['id'=>3])->with_translation()->one();
        $this->data['terms']->description = htmlentities($this->data['terms']->description);


         $this->load->model('Banner_model');
       // $this->data['banner_popup'] = $this->Banner_model->order_by('sort', 'DESC')->filter(['banner_type_id'=>2])->with_translation()->one();


       
	}

	public function render($template = false, $layout = false)
	{
            if($template)
            {
                    $this->smarty->view($template.'.tpl', $this->data);
            }
	}

        public function debug($var = null, $op = true)
        {
            if($var !== null)
            {
                if($op == false)
                {
                    echo '<pre>';
                    var_dump($var);
                    echo '</pre>';
                    die();
                }
                else
                {
                    echo '<pre>';
                    print_r($var);
                    echo '</pre>';
                    die();
                }
            }
            else
            {
                echo '<pre>';
                print_r("Please enter debug verabile !");
                echo '</pre>';
                die();
            }
        }

        function is_bot($user_agent) {
 
        $botRegexPattern = "(googlebot\/|Googlebot\-Mobile|Googlebot\-Image|Google favicon|Mediapartners\-Google|bingbot|slurp|java|wget|curl|Commons\-HttpClient|Python\-urllib|libwww|httpunit|nutch|phpcrawl|msnbot|jyxobot|FAST\-WebCrawler|FAST Enterprise Crawler|biglotron|teoma|convera|seekbot|gigablast|exabot|ngbot|ia_archiver|GingerCrawler|webmon |httrack|webcrawler|grub\.org|UsineNouvelleCrawler|antibot|netresearchserver|speedy|fluffy|bibnum\.bnf|findlink|msrbot|panscient|yacybot|AISearchBot|IOI|ips\-agent|tagoobot|MJ12bot|dotbot|woriobot|yanga|buzzbot|mlbot|yandexbot|purebot|Linguee Bot|Voyager|CyberPatrol|voilabot|baiduspider|citeseerxbot|spbot|twengabot|postrank|turnitinbot|scribdbot|page2rss|sitebot|linkdex|Adidxbot|blekkobot|ezooms|dotbot|Mail\.RU_Bot|discobot|heritrix|findthatfile|europarchive\.org|NerdByNature\.Bot|sistrix crawler|ahrefsbot|Aboundex|domaincrawler|wbsearchbot|summify|ccbot|edisterbot|seznambot|ec2linkfinder|gslfbot|aihitbot|intelium_bot|facebookexternalhit|yeti|RetrevoPageAnalyzer|lb\-spider|sogou|lssbot|careerbot|wotbox|wocbot|ichiro|DuckDuckBot|lssrocketcrawler|drupact|webcompanycrawler|acoonbot|openindexspider|gnam gnam spider|web\-archive\-net\.com\.bot|backlinkcrawler|coccoc|integromedb|content crawler spider|toplistbot|seokicks\-robot|it2media\-domain\-crawler|ip\-web\-crawler\.com|siteexplorer\.info|elisabot|proximic|changedetection|blexbot|arabot|WeSEE:Search|niki\-bot|CrystalSemanticsBot|rogerbot|360Spider|psbot|InterfaxScanBot|Lipperhey SEO Service|CC Metadata Scaper|g00g1e\.net|GrapeshotCrawler|urlappendbot|brainobot|fr\-crawler|binlar|SimpleCrawler|Livelapbot|Twitterbot|cXensebot|smtbot|bnf\.fr_bot|A6\-Indexer|ADmantX|Facebot|Twitterbot|OrangeBot|memorybot|AdvBot|MegaIndex|SemanticScholarBot|ltx71|nerdybot|xovibot|BUbiNG|Qwantify|archive\.org_bot|Applebot|TweetmemeBot|crawler4j|findxbot|SemrushBot|yoozBot|lipperhey|y!j\-asr|Domain Re\-Animator Bot|AddThis|YisouSpider|BLEXBot|YandexBot|SurdotlyBot|AwarioRssBot|FeedlyBot|Barkrowler|Gluten Free Crawler|Cliqzbot)";
     
     
        return preg_match("/{$botRegexPattern}/", $user_agent);
     
    }

        function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
         if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {

                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

}

require_once('Admin_Controller.php');
require_once('Site_Controller.php');
