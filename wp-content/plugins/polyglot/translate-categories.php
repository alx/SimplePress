<?php
/*
Plugin Name: Translate Categories
Plugin URI: http://fredfred.net/skriker
Description: Translate names of categories
Author: Martin Chlupáč
Author URI: http://fredfred.net/skriker
*/ 

function translate_link($content){
	return __($content);
}

function translate_callback($matches){

return $matches[1].__($matches[2]).$matches[3];

}

function translate_the_category($text){
	
	return preg_replace_callback('/(<a[^>]*>)(.*?)(<\/a>)/i','translate_callback',$text);	
}


add_filter('the_category_rss','__',1);
add_filter('list_cats','translate_link');
add_filter('the_category','translate_the_category');

//potrebuje to nejake upravy v originalnim kodu pro  "tisk" kategorii
?>