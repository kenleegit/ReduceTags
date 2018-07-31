<?php
//Read a Word-saved HTML file and remove the formating tags.
//But P tags. Remove all attributes in P tags.
//So the result HTML could be to Joomla articles
//TODO: Handle the residual text from <title>XXXX</title> tags

$file = $argv[1];
//print "File=" . $file;

//Read from file into a string
$string = file_get_contents($file, true);

//Strip all tags except P
$html = strip_tags($string,'<p>');
//echo $html;

//But P tags contains many attributes
//Remove newlines from string
//Reference: https://stackoverflow.com/questions/3760816/remove-new-lines-from-string
$out1=trim(preg_replace('/\s+/', ' ', $html));
//print $out1;

//Chars appearing in attributes of p tag
//$pattern = '/<p .*\'>/';
$pattern = '@<p ([0-9a-zA-Z =:;"\'\-\.]*)>@';
$replacement ='<p>';
$out2=preg_replace($pattern, $replacement, $out1);
//print $out2;

//Remove <p>&nbsp;</p>
$pattern = '@<p>&nbsp;</p>@';
$replacement = '';
$out3=trim(preg_replace($pattern, $replacement, $out2));
//print $out3;

//Add newlines after end of p tags
$pattern = '@</p>@';
$replacement = '</p>' . PHP_EOL;
$out4=preg_replace($pattern, $replacement, $out3);
print $out4;
