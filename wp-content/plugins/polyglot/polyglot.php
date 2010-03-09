<?php
/*
Plugin Name: Polyglot
Plugin URI: http://fredfred.net/skriker/index.php/polyglot
Description: Plugin that helps you make your Wordpress powered web completely multilingual. With full support of multiple time and date formats, localization of your RSS feeds and, of course, publishing your posts and pages in any number of languages. Inspired by <a href="http://www.noprerequisite.com/language_picker/">Language Picker</a>. For more information, comments or questions visit the <a href="http://fredfred.net/skriker/index.php/polyglot">Polyglot's homepage</a>.
Version: 2.5
Author: Martin Chlupac
Author URI: http://fredfred.net/skriker/
Update: http://fredfred.net/skriker/plugin-update.php?p=198


 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.
*/

// Default language version - used when proper language version of the text is not present or the visitor's prefered language is unknown
$polyglot_settings['default_lang'] = 'en';

//You can define your own translations of language shortcuts 

$polyglot_settings['trans']['en'] = 'english';
$polyglot_settings['trans']['de'] = 'deutsch';
$polyglot_settings['trans']['nl'] = 'nederlands';
$polyglot_settings['trans']['fr'] = 'française';

$polyglot_settings['trans']['cs'] = 'česky';
$polyglot_settings['trans']['it'] = 'italiano';
$polyglot_settings['trans']['sv'] = 'svenska';


//Which language versions you offer for the whole web - use the proper ISO codes!
$polyglot_settings['knownlangs'] = array('en','cs','sv');

//set to 'true' if there should be shown flags instead of names of languages
$polyglot_settings['use_flags'] = true;

//list of ISO codes and their image represantations (flags).
//all flags can be found in 'polyglot_flags' directory

$polyglot_settings['flags']['en'] = 'gb.png';
$polyglot_settings['flags']['de'] = 'de.png';
$polyglot_settings['flags']['nl'] = 'nl.png';
$polyglot_settings['flags']['fr'] = 'fr.png';

$polyglot_settings['flags']['cs'] = 'cz.png';
$polyglot_settings['flags']['it'] = 'it.png';
$polyglot_settings['flags']['sv'] = 'se.png';

//time format for each language
//if not set - default WP time format is used
$polyglot_settings['time_format']['en'] = 'g.i a';
$polyglot_settings['time_format']['de'] = 'G:i';
$polyglot_settings['time_format']['nl'] = 'G:i';
$polyglot_settings['time_format']['fr'] = 'G:i';
$polyglot_settings['time_format']['cs'] = 'G.i';

$polyglot_settings['date_format']['en'] = 'Y-m-d';
$polyglot_settings['date_format']['de'] = 'j. F Y';
$polyglot_settings['date_format']['nl'] = 'j F Y';
$polyglot_settings['date_format']['fr'] = 'j F Y';
$polyglot_settings['date_format']['cs'] = 'j. n. Y';


/*path to the plugin directory
don't forget trailing slash if you are changing this value
*/
$polyglot_settings['path_to_flags'] = get_bloginfo('wpurl').'/wp-content/plugins/polyglot_flags/';

//if you use WP older than 1.5 you must use this:
//$polyglot_settings['path_to_flags'] = get_bloginfo('url').'/wp-content/plugins/';


//default text that is shown when the proper language version of the post is missing and even the default language version is not there
// use $polyglot_settings['text_is_missing_message'] = '';  if you want to turn it off.
$polyglot_settings['text_is_missing_message'] = '[lang_en]Sorry, but this post is not available in English[/lang_en][lang_cs]Tento příspěvek bohužel není dostupný v češtině.[/lang_cs]';

//----------------------advanced-----------------------------------------------------------------------

//Should be printed <meta http-equiv="Content-Language" content="xx" /> where xx stands for ISO code of current language?
$polyglot_settings['print_meta'] = false;

// Name of the cookie - default:'wordpress_lang_pref'.$cookiehash
$polyglot_settings['lang_pref_cookie'] = 'wordpress_lang_pref'.COOKIEHASH;

/*
Should Polyglot attempt to dynamically change the WP locale
setting based on user's prefered language? Note, for this to work
.mo files must be renamed to match the name specified in $polyglot_settings['wplang'] array
but you don't have to rename anything in most cases as there is already list of current WP versions present.
*/
$polyglot_settings['lang_change_locale'] = TRUE;

/* 
To use permalinks for other languages set this to "true".
You probably don't have to do anything else if you have "index.php" in your permalink structure.
In some cases it doesn't work smoothly with re-writing rules specified in .htaccess file - then you have to add some rules to that file manually.
For more info check: http://www.google.com/search?hl=en&q=mod_rewrite
*/
$polyglot_settings['lang_rewrite'] = true;

/**
This should stay turned off unless you had problems with rules in your .htaccess file and you have edited them manually.
*/
$polyglot_settings['i_have_manually_edited_my_htaccess_file'] = false; //change this only if you know what you are doing!

/**
There are some helpers added (/lang/, /lang-pref/) by default to the url to help Polyglot distinguish between language code and short post slug.
These can be turned off. But don't turn them off unless you have a good reason to do that.
*/
$polyglot_settings['use_helpers_in_uri'] = true;

/**
If you want to use these helpers but you want to change them - do that here:
*/
$polyglot_settings['uri_helpers']['lang_view'] = 'lang';
$polyglot_settings['uri_helpers']['lang_pref'] = 'lang-pref';


/*
The xx from [lang_xx] will be translated according to this table to the $locale/WPLANG variable in WP. It also suggests the name of the .mo file.
Add your language or change it as you need.
*/
$polyglot_settings['wplang']['ar'] = 'ar';
$polyglot_settings['wplang']['bg'] = 'bg_BG';
$polyglot_settings['wplang']['cs'] = 'cs_CZ';
$polyglot_settings['wplang']['cy'] = 'cy';
$polyglot_settings['wplang']['da'] = 'da_DK';
$polyglot_settings['wplang']['de'] = 'de_DE';
$polyglot_settings['wplang']['el'] = 'el';
$polyglot_settings['wplang']['eo'] = 'eo';
$polyglot_settings['wplang']['es'] = 'es_ES';
$polyglot_settings['wplang']['fa'] = 'fa';
$polyglot_settings['wplang']['fi'] = 'fi_FI';
$polyglot_settings['wplang']['fr'] = 'fr_FR';//fr_BE
$polyglot_settings['wplang']['hu'] = 'hu_HU';
$polyglot_settings['wplang']['it'] = 'it_IT';
$polyglot_settings['wplang']['ja'] = 'ja_JP';
$polyglot_settings['wplang']['ko'] = 'ko';
$polyglot_settings['wplang']['nb'] = 'nb_NO';//nn_NO
$polyglot_settings['wplang']['pl'] = 'pl_PL';
$polyglot_settings['wplang']['pt'] = 'pt_BR';
$polyglot_settings['wplang']['ru'] = 'ru_RU';
$polyglot_settings['wplang']['sk'] = 'sk';
$polyglot_settings['wplang']['sq'] = 'sq';
$polyglot_settings['wplang']['sr'] = 'sr_CS';
$polyglot_settings['wplang']['sv'] = 'sv_SE';
$polyglot_settings['wplang']['zh'] = 'zh_CN';

//============================================STOP EDITING HERE! (unless you know what you are doing)=====================================

$polyglot_settings['initialized'] = false;





//=====================================HOOKS=====================================
add_filter('the_time','polyglot_the_time',10,2);
add_filter('get_comment_time','polyglot_comment_time');
add_filter('the_date','polyglot_the_date',10,4);
add_filter('get_comment_date','polyglot_comment_date');
add_filter('the_category_rss','__',1); 
add_filter('the_content', 'polyglot_filter_with_message',1);
add_filter('the_title', 'polyglot_filter',1);
add_filter('wp_list_pages', 'polyglot_filter_htmlentities',1);
add_filter('single_post_title', 'polyglot_filter',1);
add_filter('single_cat_title', 'polyglot_filter',1);
add_filter('wp_title', 'polyglot_filter',1);
add_filter('the_content_rss', 'polyglot_filter',1);
add_filter('the_excerpt_rss', 'polyglot_filter',1);
add_filter('the_title_rss', 'polyglot_filter',1);
add_filter('comment_text_rss', 'polyglot_filter',1);
add_filter('bloginfo_rss', 'polyglot_filter',1);
add_filter('the_excerpt', 'polyglot_filter',1);
add_filter('comment_text', 'polyglot_filter',1);

//tags
add_filter('get_the_tags', 'polyglot_get_the_tags',1);
add_filter('get_tags', 'polyglot_get_the_tags',1);
add_filter('single_tag_title', 'polyglot_filter',1);

//bookmarks
add_filter('get_bookmarks', 'polyglot_get_bookmarks',1);
add_filter('link_category', 'polyglot_filter',1);

add_filter('list_cats','__',1);//we register standard gettext function
add_filter('the_category','polyglot_translate_the_category');

//locale
add_action('locale','polyglot_get_locale',1);

add_action('wp_head','polyglot_wp_head');

add_action('plugins_loaded','polyglot_init',1);//fired even before init
add_action('init','polyglot_init',1);

add_filter('bloginfo', 'polyglot_filter',1,1);
/*
You probably have to incerase the length of 'cat_name' column in MySql table 'categories' in your DB to be able to use this.
'cat_name' is by default just 55 characters long.
*/
add_filter('the_category', 'polyglot_filter_htmlentities',1);
add_filter('list_cats', 'polyglot_filter_htmlentities',2);

add_filter('sanitize_title', 'polyglot_sanitize_title', 1);

add_filter('polyglot_filter','polyglot_filter');



//here we try to guess which language user wants
//========================================

$polyglot_settings['lang_pref'] = polyglot_get_users_pref_lang();//we don't know anything about the user's preferred language yet but we can get it from his browser




//----------------------------------------------------------------------------


/*
This function processes the requested URI and filters it before the rest of the WP gets it
*/
function polyglot_init() {
	global $polyglot_settings,$locale;

  if($polyglot_settings['initialized'])
  {
    return;
  }

	$content = $_SERVER['REQUEST_URI'];

	$languages = implode('|',$polyglot_settings['knownlangs']);
	
	if(!$polyglot_settings['use_helpers_in_uri']){
		$find = array(
		"/^(.*)\/($languages)\/?(.*)$/i"
		);
	}
	else {
		$find = array(
		"/^(.*)\/{$polyglot_settings['uri_helpers']['lang_pref']}\/($languages)\/?(.*)$/i",
		"/^(.*)\/{$polyglot_settings['uri_helpers']['lang_view']}\/($languages)\/?(.*)$/i"
		
		);
	}

	$replace = array('','');

	if (preg_match($find[0], $content, $matches)) {
	$content = $matches[1] . "/" . $matches[3];
	$_GET['lang_pref'] = $matches[2];
	}
	
	if ($polyglot_settings['use_helpers_in_uri'] && preg_match($find[1], $content, $matches)) {
	$content = $matches[1] . "/" . $matches[3];
	$_GET['lang_view'] = $matches[2];
	}

	$_SERVER['REQUEST_URI']= $content;
	$_SERVER['PATH_INFO'] = preg_replace($find,$replace,$_SERVER['PATH_INFO']);
	$_SERVER['PHP_SELF'] = preg_replace($find,$replace,$_SERVER['PHP_SELF']);

	
	
	//let's check if user has chosen the preferred language
	if ( isset($_GET['lang_pref']) ) {
		$_GET['lang_pref'] = strtolower($_GET['lang_pref']);
		
		if(  in_array($_GET['lang_pref'],$polyglot_settings['knownlangs'])  ){
			setcookie($polyglot_settings['lang_pref_cookie'], $_GET['lang_pref'], time() + 30000000, COOKIEPATH,COOKIE_DOMAIN);
			$polyglot_settings['lang_pref']=$_GET["lang_pref"];
			}
	
	}
	//or he wants to see the post in the certain language
	elseif( isset($_GET['lang_view'])){
		$polyglot_settings['lang_pref'] = strtolower($_GET['lang_view']);
	}
	//or at least has the cookie with some value
	elseif( isset($_COOKIE[$polyglot_settings['lang_pref_cookie']])  ) {
		$polyglot_settings['lang_pref'] = strtolower(trim($_COOKIE[$polyglot_settings['lang_pref_cookie']]));
	}



/**
This part should be removed but for some reason it's needed on some installations:(
*/
/*if($polyglot_settings['lang_rewrite'] && !$polyglot_settings['i_have_manually_edited_my_htaccess_file']){
					if(preg_match('/\/lang\/(..)/i',$_SERVER['REQUEST_URI'],$matches)){
						$polyglot_settings['lang_pref']=$matches[1];
					}
					
					if(preg_match('/\/lang-pref\/(..)/i',$_SERVER['REQUEST_URI'],$matches)){
						$polyglot_settings['lang_pref']=$matches[1];
						setcookie($polyglot_settings['lang_pref_cookie'], $polyglot_settings['lang_pref'], time() + 30000000, COOKIEPATH);
					}
}*/
	
	
/*
If the Polyglot is supposed to change the global language settings then... let's do that!
*/
		if ($polyglot_settings['lang_change_locale']){
		
			$polyglot_foo = ( isset($polyglot_settings['wplang'][$polyglot_settings['lang_pref']]) ) ? $polyglot_settings['wplang'][$polyglot_settings['lang_pref']] : $polyglot_settings['lang_pref'];
		
			if (!defined('WPLANG')){//just try
				define('WPLANG', $polyglot_foo);
			}
		
			if($locale != $polyglot_foo){
				$locale = $polyglot_foo;
        
        //echo $polyglot_settings['lang_pref'];
					
				load_default_textdomain();
				}
		}
	
	$polyglot_settings['initialized'] = true;
	
	return;
}







/**
Useful function when you want to generate new links with lang-pref settings. You must get rid of the old stuff!
*/
function polyglot_uri_cleaner($txt){
	global $polyglot_settings;

	$search = array(
	"/{$polyglot_settings['uri_helpers']['lang_view']}\/..\/?/i",
	 "/{$polyglot_settings['uri_helpers']['lang_pref']}\/..\/?/i",
	 "/(\?|&)lang_view=../i",
	 "/(\?|&)lang_pref=../i",
	 "/^(.*index\.php)\/$/i"
	 );
	 
	$replace = array('','','','','$1');
	
	if(!$polyglot_settings['use_helpers_in_uri']){
		$search[] = "/\/(".implode("|",$polyglot_settings['knownlangs']).")\/?/i";
		$replace[] = '';
		}
	
	$txt = preg_replace ( $search, $replace, $txt);
	
	return $txt;
}


//----------------------------------------------------------------------------


function polyglot_knownlangs(){
global $polyglot_settings;
	return $polyglot_settings['knownlangs'];
}

function polyglot_translations(){
	global $polyglot_settings;
	return $polyglot_settings['trans'];
}



//---------------------------------------------------------------time functions ------------------------

function polyglot_date($d = '', $time = ''){
	global $polyglot_settings;
	
	if($d == '' && isset($polyglot_settings['date_format'][$polyglot_settings['lang_pref']])){
		$d = $polyglot_settings['date_format'][$polyglot_settings['lang_pref']];
	}
	
		if(strpos($time, '-')){//trick to find you if we've got "mysql time" or unix timestamp
			$time = mysql2date($d, $time);
			}
		else{
			$time = date($d,$time);
		}
	
	return $time;
}

function polyglot_time($d = '', $time = ''){
	global $polyglot_settings;
	
	if($d == '' && isset($polyglot_settings['time_format'][$polyglot_settings['lang_pref']])){
		$d = $polyglot_settings['time_format'][$polyglot_settings['lang_pref']];
	}
	
		if(strpos($time, '-')){//trick to find you if we've got "mysql time" or unix timestamp
			$time = mysql2date($d, $time);
			}
		else{
			$time = date($d,$time);
		}
	
	return $time;
}

function polyglot_comment_time($time) {
	global $comment,$polyglot_settings;
	
	if( isset($polyglot_settings['time_format'][$polyglot_settings['lang_pref']]) ){
		$d = $polyglot_settings['time_format'][$polyglot_settings['lang_pref']];
		$comment_date =  $comment->comment_date;
		$time = mysql2date($d, $comment_date);
		}
	return $time;
} 


function polyglot_the_time($time,$d = ''){
	global $post,$polyglot_settings;
	
	if( isset($polyglot_settings['time_format'][$polyglot_settings['lang_pref']]) && $d==''){
		$d = $polyglot_settings['time_format'][$polyglot_settings['lang_pref']];
		$time = $post->post_date;
		$time = mysql2date($d, $time);
	}
	return $time;
}


function polyglot_comment_date($time) {
	global $comment,$polyglot_settings;
	
	if( isset($polyglot_settings['date_format'][$polyglot_settings['lang_pref']]) ){
		$d = $polyglot_settings['date_format'][$polyglot_settings['lang_pref']];
		$comment_date =  $comment->comment_date;
		$time = mysql2date($d, $comment_date);
		}
	return $time;
} 


function polyglot_the_date($the_date, $d = '', $before = '', $after = ''){
	global $post,$polyglot_settings;

	if( isset($polyglot_settings['date_format'][$polyglot_settings['lang_pref']]) && $d=='' && $the_date!='' ){
		$d = $polyglot_settings['date_format'][$polyglot_settings['lang_pref']];
		$the_date = $post->post_date;
		$the_date = $before.mysql2date($d, $the_date).$after;
	}
	return $the_date;
}


//----------------------------------------------
function polyglot_get_lang(){
	global $polyglot_settings;
	
	return $polyglot_settings['lang_pref'];
}



function get_trans($lang){
	global $polyglot_settings;
	
	if(IsSet($polyglot_settings['trans'][$lang]))
		return $polyglot_settings['trans'][$lang];
	else
		return $lang;
}

function polyglot_wp_head(){
	global $polyglot_settings;
	if($polyglot_settings['print_meta']){
		echo "<meta http-equiv=\"Content-Language\" content=\"{$polyglot_settings['lang_pref']}\" />";
	}
}



function polyglot_filter_htmlentities($content, $category = null){

	$content = preg_replace("/&lt;(\/){0,1}lang_(..)&gt;/i", "<$1lang_$2>", $content);
		
		return polyglot_filter($content);
		
		
}


/**
Very simple test if the $lang version is present in the text.
*/
function polyglot_lang_exists($lang, $content){
    return (   !(strpos($content, "<lang_$lang>") === false) || !(strpos($content, "[lang_$lang]") === false)   );
}

function polyglot_list_langs($flags=false){
	global $polyglot_settings,$wp_query;
				$clean_uri = polyglot_uri_cleaner($_SERVER['REQUEST_URI']);
				
				if(!$polyglot_settings['use_helpers_in_uri']){
					$uri_helper = '';
				}
				else {
					$uri_helper = "{$polyglot_settings['uri_helpers']['lang_pref']}/";
				}
				
				
					foreach($polyglot_settings['knownlangs'] as  $value){
						
						if ( $value==$polyglot_settings['lang_pref'] ) {
							$highlight = "language_item current_language_item";
						} else {
							$highlight = "language_item";
						}
						echo "<li class=\"$highlight\"><a href=\"";
						
						if(  $polyglot_settings['lang_rewrite'] ){
							
							if(strpos(get_settings('permalink_structure'),'index.php') === FALSE){
									echo polyglot_trailingslashit($clean_uri)."{$uri_helper}{$value}/";
								}
							else {
								$qm_pos = strpos($clean_uri,'?');
								if(strpos($clean_uri,'index.php') === FALSE){
										if( ($qm_pos) === FALSE){
												echo polyglot_trailingslashit($clean_uri)."index.php/{$uri_helper}{$value}/";
											}
										else {
												echo polyglot_trailingslashit(substr($clean_uri,0,$qm_pos))."index.php/{$uri_helper}{$value}/".substr($clean_uri,$qm_pos);
											}
									}
								else {
								
										if($qm_pos === FALSE){
													echo polyglot_trailingslashit($clean_uri)."{$uri_helper}{$value}/";
												}
											else {
													echo polyglot_trailingslashit(substr($clean_uri,0,$qm_pos))."{$uri_helper}{$value}/".substr($clean_uri,strpos($clean_uri,'?'));
												}
									}
								
								
								
								}
						}
						else {
						
							//if('' != get_settings('permalink_structure')){
								echo $clean_uri.((strpos($clean_uri,'?') === FALSE) ? '?' : '&amp;' )."lang_pref={$value}";
							//}
						
						}
						echo "\">". (($flags) ? "<img src=\"".$polyglot_settings['path_to_flags'].$polyglot_settings['flags'][$value] ."\" alt=\"".get_trans($value)."\" title=\"".get_trans($value)."\" />" : get_trans($value)) ."</a></li>";
					}
}


/*
Original function in WP doesn't work properly:(
*/
function polyglot_trailingslashit($uri){
	if($uri{strlen($uri)-1} != '/')
		return $uri.'/';
	else
		return $uri;
}


/**
The core function of the plugin. Selects only one language version from the passed text.
*/
function polyglot_filter($text, $lang = '') {
	global $polyglot_settings;
	
	if($lang == ''){$lang = $polyglot_settings['lang_pref'];}
	
	$text = preg_replace("/\[(\/){0,1}lang_(..)\]/i", "<$1lang_$2>", $text);//fix for [lang_xx]	
	$text = preg_replace ('/<p>(<(\/){0,1}lang_..>)<\/p>/i',"$1",$text);//fix for <p><lang_xx></p>
	
	$text = preg_replace ('/(<lang_..>)/i',"</lang_all>\\1",$text);//adds lang_all to all other stuff that is not enclosed in lang_xx tags
	$text = preg_replace ('/(<\/lang_..>)/i',"\\1<lang_all>",$text);
	$text = '<lang_all>'.$text.'</lang_all>';
	
	
	
	
	if (preg_match_all ( '/<lang_(..)>/', $text , $match, PREG_PATTERN_ORDER)) {
        if (isset($polyglot_settings['lang_pref']) && polyglot_lang_exists($polyglot_settings['lang_pref'],$text)){
        //lets try to get proper language version
            $text=str_replace("<lang_all>","<lang_{$polyglot_settings['lang_pref']}>",$text);//we don't want just lang_pref parts but also lang_all parts
            $text=str_replace("</lang_all>","</lang_{$polyglot_settings['lang_pref']}>",$text);
			
            $find = "/(?s)<lang_{$polyglot_settings['lang_pref']}>(.*?)<\/lang_{$polyglot_settings['lang_pref']}>/";
            preg_match_all ( $find, $text , $match, PREG_PATTERN_ORDER);
            $text = implode('',$match[1]);
            
        }
        elseif(polyglot_lang_exists($polyglot_settings['default_lang'],$text)){
        //or at least the default language
			$text=str_replace("<lang_all>","<lang_{$polyglot_settings['default_lang']}>",$text);
            $text=str_replace("</lang_all>","</lang_{$polyglot_settings['default_lang']}>",$text);
            $find = "/(?s)<lang_{$polyglot_settings['default_lang']}>(.*?)<\/lang_{$polyglot_settings['default_lang']}>/";
            preg_match_all ( $find, $text , $match, PREG_PATTERN_ORDER);
            $text = implode('',$match[1]);
        }
        
         else {
            //all untranslated stuff
            $text=str_replace("<lang_all>","",$text);
            $text=str_replace("</lang_all>","",$text);
            $find = "/(?s)<lang_(.*?)>(.*?)<\/lang_(.*?)>/";
            $replace = "";
            $text = preg_replace($find,$replace,$text);
        }
    }

	return str_replace(array("<lang_all>","</lang_all>"),array('',''),$text);
} 


/**
Handy shortcuts of polyglot_filter function for direct use in the templates
*/
function p__($text){
	return polyglot_filter($text);
}

function p__e($text){
	echo polyglot_filter($text);
}


/**
Does the same as polyglot_filter but shows the message that informs visitor that selected language version is not available
*/
function polyglot_filter_with_message($text){
global $polyglot_settings;
	$text = trim(polyglot_filter($text));
	if($text == ''){
		$text = polyglot_filter($polyglot_settings['text_is_missing_message']);
	}
	return $text;
}


/*function safe_link(){
	global $post;
	
	$permalink = get_settings('home') . '/' . get_settings('blogfilename') . '?';
	
		if ($post->post_status == 'static')
			$permalink .= 'page_id';
		else
			$permalink .= 'p';
			
	$permalink .= '='.$post->ID;
		
	
	return $permalink;
}*/


/**
Prints out the list of other language versions contained in the current post.
*/
function polyglot_other_langs($none='none', $before='<ul>', $after='</ul>', $pre='<li>(', $afters=')</li>'){
    global $polyglot_settings, $post;

	
	if(!$polyglot_settings['use_helpers_in_uri']){
		$uri_helper = '';
	}
	else {
		$uri_helper = "{$polyglot_settings['uri_helpers']['lang_view']}/";
	}
	
    $content = $post->post_content;//fred
    
    $before = polyglot_filter($before);
    $after = polyglot_filter($after);
    $pre = polyglot_filter($pre);
    $afters = polyglot_filter($afters);
    $other_langs = polyglot_filter($none);
	
    if (preg_match_all ( '/[<|\[]lang_(..)[>|\]]/', $content , $match, PREG_PATTERN_ORDER)) {
        $match = array_unique($match[1]);
        $other_langs = $before;
     
        foreach ($match as $lang){
            if ($polyglot_settings['lang_pref'] != $lang) {
				
				$foo = ($polyglot_settings['use_flags'] ) ?  "<img src=\"".$polyglot_settings['path_to_flags'].$polyglot_settings['flags'][$lang] ."\" alt=\"".get_trans($lang)."\" title=\"".get_trans($lang)."\" />" : get_trans($lang);

            
				$other_langs .= "$pre<a href='".get_permalink();
			
                if ($polyglot_settings['lang_rewrite']) {
					if($polyglot_settings['i_have_manually_edited_my_htaccess_file'] || strpos(get_permalink(),'?') === false){
						$other_langs .= "{$uri_helper}{$lang}/";
						}
					else {
						$other_langs .= "&amp;lang_view=$lang'";
					}
                } else {
					if(strpos(get_permalink(),'?') === false){
							$other_langs .= "?lang_view=$lang'";
					}
					else {
							$other_langs .= "&amp;lang_view=$lang'";
					}
                    
                }
				
								$other_langs .= "' rel=\"alternate\" hreflang=\"{$lang}\">{$foo}</a>$afters";

            }
        }
		if($other_langs != $before)//to avoid empty <ul></ul>
        	$other_langs .= $after;
		else
			$other_langs = $none;
    }
    echo $other_langs;
}

/**
Prepares text for slug
*/
function polyglot_sanitize_title($text){
	global $polyglot_settings;
	
	
	$text = polyglot_filter($text, $polyglot_settings['default_lang']);
	
	return $text;
}

//------------code from 'translate categories' plugin-----------

function polyglot_translate_callback($matches){

return $matches[1].__($matches[2]).$matches[3];

}
/**
Not very nice way how to tranlate category name:(
It uses standard gettex function __ and works only when we have the category name in the .mo file!
*/
function polyglot_translate_the_category($text){
	
	return preg_replace_callback('/(<a[^>]*>)(.*?)(<\/a>)/i','polyglot_translate_callback',$text);	
}

//---------------------------------------------------------------------------

function polyglot_get_users_pref_lang(){
			GLOBAL $polyglot_settings;
			$deflang = $polyglot_settings['default_lang'];
			
			# An advanced PHP Language Detection Script
			# by Fibergeek (fibergeek @ codegurus.be)
			#
			# This script is a modification to a script I found via google
			#
			# 2003-12-18 - Version 1 (I added...)
			#   - you can now also specify the country code in the $knowlangs array
			#   - extraction of the country code ($country)
			#   - I fully documented the code
			#
			# 2004-01-07 - Version 2 (I added...)
			#   - you can now make $knowlangs NULL (the script will set to array to all known languages (ISO-639))
			#
			# NOTE : for those using Brion's script, I renamed $lastquality to $quality
			#
			# Found at URL    : http://mail.wikipedia.org/pipermail/wikitech-l/2002-October/001068.html
			# Assumed creator : Brion VIBBER (wikitech-l@wikipedia.org)
			# HTTP reference  : RFC 2616 - ftp://ftp.isi.edu/in-notes/rfc2616.txt
			
			# ==================================================================================================
			# TODO
			#   You need to add the 2 lines to your source code, and change the content of them of course ;-)
			# ==================================================================================================
			#$polyglot_settings['knownlangs'] = NULL;                                // default to all known languages (ISO-639)
			#$deflang    = NULL;                                // there is no default language
			#
			#$polyglot_settings['knownlangs'] = array('en-us', 'en-uk', 'en', 'nl'); // We know : English (US & UK) and Dutch
			#$deflang    = 'en-uk';                             // In case of an error, we default to English UK
			
			# ==================================================================================================
			# INFORMATION
			# The following variables are returned by this program
			#   $lclist  : the full list with the languages accepted by the client's browser
			#   $lctag   : the tag we are supporting (includes the country code if any)
			#   $quality : the quality
			#   $lang    : the language code
			#   $country : the country code (if any)
			#
			# The following variables are used by this program (and may be overwritten if you use them also!)
			#   $langtag
			#   $qvalue
			#   $eachbit
			#   $tmppos
			#   $tmplclist
			#   $tmplctag
			#   $tmptagarray
			# ==================================================================================================
			
			# ==================================================================================================
			# THE SCRIPT
			# ==================================================================================================
			
			# Check that $knowlangs is an array!
			# NOTE : the list is taken from this URL : http://www.w3.org/WAI/ER/IG/ert/iso639.htm
			if(!is_array($polyglot_settings['knownlangs']))
			{
			  if(is_string($polyglot_settings['knownlangs']) || is_object($polyglot_settings['knownlangs']) || $polyglot_settings['knownlangs'] != NULL)
			    die("Fibergeek's PHP Language Detection Script : You need define \$polyglot_settings['knownlangs'] as an array or as NULL!<br>\n");
			  $polyglot_settings['knownlangs'] = array('aa', 'ab', 'af', 'am', 'ar', 'as', 'ay', 'az', 'ba', 'be', 'bg', 'bh', 'bi', 'bn', 'bo', 'br', 'ca', 'co', 'cs', 'cy', 'da', 'de', 'dz', 'el', 'en', 'eo', 'es', 'et', 'eu', 'fa', 'fi', 'fj', 'fo', 'fr', 'fy', 'ga', 'gd', 'gl', 'gn', 'gu', 'ha', 'he', 'hi', 'hr', 'hu', 'hy', 'ia', 'ie', 'ik', 'in', 'is', 'it', 'iw', 'ja', 'ji', 'jw', 'ka', 'kk', 'kl', 'km', 'kn', 'ko', 'ks', 'ku', 'ky', 'la', 'ln', 'lo', 'lt', 'lv', 'mg', 'mi', 'mk', 'ml', 'mn', 'mo', 'mr', 'ms', 'mt', 'my', 'na', 'ne', 'nl', 'no', 'oc', 'om', 'or', 'pa', 'pl', 'ps', 'pt', 'qu', 'rm', 'rn', 'ro', 'ru', 'rw', 'sa', 'sd', 'sg', 'sh', 'si', 'sk', 'sl', 'sm', 'sn', 'so', 'sq', 'sr', 'ss', 'st', 'su', 'sv', 'sw', 'ta', 'te', 'tg', 'th', 'ti', 'tk', 'tl', 'tn', 'to', 'tr', 'ts', 'tt', 'tw', 'uk', 'ur', 'uz', 'vi', 'vo', 'wo', 'xh', 'yo', 'zh', 'zu');
			}
			
			# Initalisation of the default variables
			if(isset($HTTP_SERVER_VARS))
			  $lclist = trim($HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE']); # PHP running from a server
			else
			  $lclist = trim($_SERVER['HTTP_ACCEPT_LANGUAGE']);          # PHP 5.0 when the old server variables disabled
			$lctag   = $deflang;
			$tmppos  = strpos($lctag, '-');
			$quality = 0.0;
			if($tmppos == FALSE or $tmppos == NULL)
			{
			  $lang    = $deflang;
			  if($deflang == NULL)
			    $country = NULL;
			  else
			    $country = '';
			}
			else
			{
			  $lang    = substr($lctag, 0, $tmppos);
			  $country = substr($lctag, $tmppos + 1);
			  echo "lang sub = $lang";
			}
			
			#
			$langtag = '((?:[a-zA-Z]{1,8})(?:-[a-zA-Z]{1,8})*)';
			$qvalue  ='(0(?:\.[0-9]{1,3})?|1(?:\.0{1,3}))';
			$eachbit = '^' . $langtag . '(?:;q=' . $qvalue . ')?(?:,\s*)?(.*)$';
			
			#
			$tmplclist = $lclist;
			
			# The loop
			while(strlen($tmplclist))
			{
			  if(preg_match("/$eachbit/", $tmplclist, $tmptagarray)) # requires 3.0.9
			  {
			    # Extract data from the tag list
			    $tmplctag = $tmptagarray[1];
			    $tmpquality = $tmptagarray[2];
			    if(strlen($tmpquality) == 0)
			      $tmpquality = 1;
			    $tmplclist = $tmptagarray[3];
			
			    # Find the tag in our $polyglot_settings['knownlangs'] array (this search includes the country code if set) 
			    if(in_array($tmplctag, $polyglot_settings['knownlangs']) and $tmpquality > $quality)
			    {
			      # Extract the language & quality
			      $lctag   = $tmplctag;
			      $lang    = $tmplctag;
			      $country = '';
			      $quality = $tmpquality;
			    }
			    else
			    {
			      # Not found, does the tag include a country code?
			      $tmppos = strpos($tmplctag, '-');
			      if($tmppos <> FALSE)
			      {
			        # OK, the tag includes a country code but it's not in the $polyglot_settings['knownlangs'] array, let's extract the language and look it up
			        if(in_array(substr($tmplctag, 0, $tmppos), $polyglot_settings['knownlangs']) and $tmpquality > $quality)
			        {
			          # Extract the language, country & quality
			          $lctag   = $tmplctag;
			          $lang    = substr($tmplctag, 0, $tmppos);
			          $country = substr($tmplctag, $tmppos + 1);
			          $quality = $tmpquality;
			        }
			      }
			    }
			  }
			  else
			  {
			    # There was an error, abort the loop
			    break;
			  }
			}
	 return $lang;
	}//get_users_pref_lang()

	


//===========================  WIDGET CODE============================
 
function widget_polyglot_init() {
 
	if ( !function_exists('register_sidebar_widget') )
		return;
 
	function widget_polyglot($args) {
		extract($args);
		$options = get_option('widget_polyglot');
		$title = $options['title'];
		$listtype = $options['listtype'] ? true : false ;
 
		echo $before_widget . $before_title . polyglot_filter($title) . $after_title . '<ul class="language_item">';
		echo polyglot_list_langs($listtype) . '</ul>';
		echo $after_widget;
	}
 
	function widget_polyglot_control() {
 
		// Get our options and see if we're handling a form submission.
		$options = get_option('widget_polyglot');
		if ( !is_array($options) )
			$options = array('title'=>__('Language'), 'listtype'=>'');
		if ( $_POST['polyglot-submit'] ) {
 
			// Remember to sanitize and format user input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['polyglot-title']));
			$options['listtype'] = $_POST['polyglot-listtype'];
			update_option('widget_polyglot', $options);
		}
 
		// Be sure you format your options to be valid HTML attributes.
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$listtype = $options['listtype'];
 
		echo '<p style="text-align:right;"><label for="polyglot-title">Title: <input style="width: 200px;" id="polyglot-title" name="polyglot-title" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:right;">Display as: <input type="radio" id="polyListtypeText" name="polyglot-listtype" value=""';
		if ('' == $listtype) echo 'checked="checked" ';
		echo '/><label for="polyListtypeText">normal list</label>
		<input type="radio" id="polyListtypeFlags" name="polyglot-listtype" value="true"' ;
		if ('true' == $listtype) echo 'checked="checked" ';
		echo '/><label for="polyListtypeFlags">flags list</label></p>';
		echo '<input type="hidden" id="polyglot-submit" name="polyglot-submit" value="1" />';
	}
 
	function widget_polyglot_style() {
	?>
	<style type="text/css">li#polyglot ul li:before, .language_item li{list-style-type:none;display:inline !important;padding: 2px !important;margin: 0 !important;}</style>
	<?php
	}
 
	register_sidebar_widget('Polyglot', 'widget_polyglot');
	register_widget_control('Polyglot', 'widget_polyglot_control', 300, 90);
	if ( is_active_widget('widget_polyglot') )
		add_action('wp_head', 'widget_polyglot_style');
}
 
// Run our code later in case this loads prior to any required plugins.
add_action('plugins_loaded', 'widget_polyglot_init');
	
	
  
  
// ABP: filter if not back-end
if(strpos($_SERVER['REQUEST_URI'], 'wp-admin') === false){
  add_filter('option_widget_text', 'polyglot_filter_array', 10, 1);
}

// Function for array filtering
/**
* ABP: filter array values
*/
function &polyglot_filter_array(&$ar){
  foreach($ar as $k => $v){
    if(is_array($v)){
      $ar[$k] = polyglot_filter_array($v);
    } else {
      $ar[$k] = polyglot_filter($v);
    }
  }
  return $ar;
}

//get_the_tags - processor

function polyglot_get_the_tags(&$tags)
{

  if(!empty($tags))
  {
    foreach($tags as $tag)
    {
      $tag->name = polyglot_filter($tag->name);
    }
  }
  
  return $tags;
}


//get_bookmarks - processor

function polyglot_get_bookmarks(&$bookmarks)
{
  foreach($bookmarks as $bookmark)
  {
    $bookmark->link_name = polyglot_filter($bookmark->link_name);
    $bookmark->link_description = polyglot_filter($bookmark->link_description);
  }
  
  return $bookmarks;
}  

//returns proper $locale string (cs->cs_CZ)
function polyglot_get_locale($par)
{ GLOBAL $polyglot_settings;
  return isset($polyglot_settings['wplang'][$polyglot_settings['lang_pref']]) ? $polyglot_settings['wplang'][$polyglot_settings['lang_pref']] : $par;
}
  
//================================Backward Compatibility=============================
function lang_picker_respect_more($text){return polyglot_filter($text);}
function lang_picker($text) {return polyglot_filter($text);}
function lp_other_langs($none='none', $before='<ul>', $after='</ul>', $pre='<li>(', $afters=')</li>'){return polyglot_other_langs($none, $before, $after, $pre, $afters);}
?>
