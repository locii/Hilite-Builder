<?php

// --------------------------------------
// We use this tool to create hilite files for colour schemes for our Joomla templates.
// Simply place the package in your local server web directory and the css files will be automagically created based on your settings below.
//---------------------------------------


// Include csscolor.php to create new colours based on the primary colours in the array
// CSSColor.php
// Copyright 2004 Patrick Fitzgerald
// http://www.barelyfitz.com/projects/csscolor/

include_once("csscolor.php");



// Set the error handing for csscolor.
// If an error occurs, print the error
// within a CSS comment so we can see
// it in the CSS file.

PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'errorHandler');
function errorHandler($err) {
    echo("/* ERROR " . $err->getMessage() . " */");
}




// --------------------------------------
// 	Set the name of the colour scheme and the various hex values specific to that theme.
// 	When adding new colour schemes make sure you add a comma between the nested arrays otherwise you will get the white page of doom.
//
//
//	As you can see the syntax for adding the new colours is poretty simple
//	To add another colour below just add "fourth" => "#D9D1BA", and now you can reference the colour in the css liek this $colourfourth.
// --------------------------------------

$colours = array( 
	
	array( 
		"style" => "First",
		"primary" => "#D9B166", 
		"secondary" => "#A6261B",
		"tertiary" => "#D9D1BA",
	),	

	array( 
		"style" => "Second",
		"primary" => "#FFA256", 
		"secondary" => "#ABA73C",
		"tertiary" => "#F7DD77",
	 ),	
);


 
// --------------------------------------
// 	Now this is where the hilite builder gets fancy.
// 	You can take any of the base colours used in the array above and shift them through the colour wheel by degrees
//
// 	In the example above you need to ensure the base colour is declared and the new colour is processed by the csscolour script.
// 		eg $fourth = new CSS_Color(str_replace('#', '', $colour[fourth]));
//
//	Once the new variable is declared then you can use this syntax to shift up and down the saturation of the base colour in order to create lighter or darker colours.
//  You can now reference the shifted colour by using this syntax
//		
//	#'.$primary->bg['-2'].'
//
//	Using the code above will produce a colour that is two shades darker than the primary colour nominated in the array above.
//  
// -------------------------------------- 



foreach($colours as $colour) {
	
	$primary = new CSS_Color(str_replace('#', '', $colour[primary]));
	$secondary = new CSS_Color(str_replace('#', '', $colour[secondary]));
	$tertiary = new CSS_Color(str_replace('#', '', $colour[tertiary]));
	
	// Outputs the css files in the same folder as the build file.
	$file = ''.$colour[style].'.css';

	
	$css = '/*------------------------------------------------------------------
	Template:	'.$colour[style].'
	Version:	Joomla 1.5 / Joomla 2.5
	Copyright:	You
	Created:	September 2012
	------------------------------------------------------------------*/
	

	.firstcolor {color: '.$colour[primary].'}
	.secondcolor {color: '.$colour[secondary].'}
	.thirdcolor {color: '.$colour[tertiary].'}
	
	
	
	.darkerprimary {color: #'.$primary->bg['-2'].'}
	.darkersecondary {color: #'.$secondary->bg['-2'].'}
	.darkertertiary {color: #'.$tertiary->bg['-2'].'}
	
	.lighterprimary {color: #'.$primary->bg['+2'].'}
	.lightersecondary {color: #'.$secondary->bg['+2'].'}
	.lightertertiary {color: #'.$tertiary->bg['+2'].'}


';

// This is the bit that actually creates the css file based on your settings above.
file_put_contents($file, $css);


// -------------------------------------- 
// 	This will output the colours on the page.
// 	If you have added new colours to the arrays above you will need to change this code with your new colours.
// 
// 	eg if you add the fourth colour.
//	
// 	<div style="float:left;width:40px;height:60px;background:'.$colour[fourth].';border-left:40px solid #'.$fourth->bg['-2'].';border-right:40px solid #'.$fourth->bg['+2'].'"></div>
//  
// This is really just for the sake of seeing the colour schemes on the page and not required for the building of the actual css files.
// -------------------------------------- 


echo '<div style="pading:20px;width:600px;margin:0 auto;font-size:90%;font-family:helvetica neue;color:#666;margin:20px auto 60px;height:100px">
<p style="text-align:left">
	<strong>'.$colour[style].'</strong>
</p>

<div style="float:left;width:40px;height:60px;background:'.$colour[primary].';border-left:40px solid #'.$primary->bg['-2'].';border-right:40px solid #'.$primary->bg['+2'].'"></div>
<div style="float:left;width:40px;height:60px;background:'.$colour[secondary].';border-left:40px solid #'.$secondary->bg['-2'].';border-rightp:40px solid #'.$secondary->bg['+2'].'"></div>
<div style="float:left;width:40px;height:60px;background:'.$colour[tertiary].';border-left:40px solid #'.$tertiary->bg['-2'].';border-right:40px solid #'.$tertiary->bg['+2'].'"></div>
<div style="clear:both"></div>	
</div>
';
	}
?>