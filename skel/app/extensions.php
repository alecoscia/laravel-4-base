<?php

/**
 * @glyph('save') => <span class="glyphicon glyphicon-save"></span>
 */
Blade::extend(function($view) {
	$html = '<span class="glyphicon glyphicon-$1"></span>';
	// return preg_replace("/@glyph\(\\['\"]([a-z]+)\\['\"]\\)/ix", $html, $view);
	return preg_replace("/@glyph\(\\'([a-z\-]+)\\'\\)/ix", $html, $view);
});

/**
 * HTML::glyph('save') => <span class="glyphicon glyphicon-save"></span>
 */
HTML::macro('glyph', function($glyph) {
	return '<span class="glyphicon glyphicon-'.$glyph.'"></span>';
});
