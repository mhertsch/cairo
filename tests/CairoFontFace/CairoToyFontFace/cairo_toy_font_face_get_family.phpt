--TEST--
cairo_font_face_get_family function
--SKIPIF--
<?php
if(!extension_loaded('cairo')) die('skip - Cairo extension not available');
if(!class_exists('CairoToyFontFace')) die('skip - CairoToyFontFace not enabled');
?>
--FILE--
<?php
// Test with all parameters
$c = cairo_toy_font_face_create("sans-serif", CAIRO_FONT_SLANT_NORMAL, CAIRO_FONT_WEIGHT_NORMAL);
var_dump(cairo_toy_font_face_get_family($c));

// Set up handler for catchable errors
function catch_error($errno, $errstr) {
    echo 'CAUGHT ERROR: ' . $errstr . PHP_EOL;
}
set_error_handler('catch_error', E_RECOVERABLE_ERROR);

// Test with a different class
var_dump(cairo_toy_font_face_get_family(new stdClass));

// Test with a non-object
var_dump(cairo_toy_font_face_get_family("Foo"));
?>
--EXPECTF--
string(10) "sans-serif"
CAUGHT ERROR: Argument 1 passed to cairo_toy_font_face_get_family() must be an instance of CairoToyFontFace, instance of stdClass given

Warning: cairo_toy_font_face_get_family() expects parameter 1 to be CairoToyFontFace, object given in %s on line %d
NULL
CAUGHT ERROR: Argument 1 passed to cairo_toy_font_face_get_family() must be an instance of CairoToyFontFace, string given

Warning: cairo_toy_font_face_get_family() expects parameter 1 to be CairoToyFontFace, string given in %s on line %d
NULL
 
