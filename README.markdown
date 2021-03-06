# Human Filesize - Shows the size of a file in human readable format

**Authors**: [George Ornbo][], [Craig Allen](http://www.craigallen.net.au/home.php)
**Source Code**: [Github][]

## Compatibility

* ExpressionEngine Version 1.6.x (1.x.x releases), ExpressionEngine Version 2.0.x (2.x.x releases)

## License

Human Filesize is free for personal and commercial use. 

If you use it commercially use a donation of $10 is suggested. You can send [donations here](http://pledgie.org/campaigns/2898). 

Human Filesize is licensed under a [Open Source Initiative - BSD License][] license.

## Installation

For EE 1.6.x the file pi.human_filesize.php must be placed in the /system/plugins/ folder in your [ExpressionEngine][] installation.

For EE 2.0.0 the human\_filesize folder must be placed in the /system/expressionengine/third_party/ folder in your [ExpressionEngine][] installation.

## Name

Human Filesize

## Synopsis

Shows the size of a file in human readable format

## Description

This plugin returns the size of a file in human readable format (e.g 101.34 KB, 10.41 GB ) Wrap the absolute path filename in these tags to have it processed

	{exp:human_filesize}/uploads/documents/your_document.pdf{/exp:human_filesize}

If you are using Mark Huot's File extension you can just use the EE tag you chose for the file field

	{exp:human_filesize}{your_file_field}{/exp:human_filesize}
	
The function calculates whether to show KB, MB or GB depending on the file size.

## Parameters

There are currently no parameters
	
## Single Variables

There are currently no single variables
	
## Examples

	{exp:human_filesize}/uploads/documents/your_document.pdf{/exp:human_filesize}		
	
[George Ornbo]: http://shapeshed.com/
[Github]: http://github.com/shapeshed/human_filesize.ee_addon/
[ExpressionEngine]:http://www.expressionengine.com/index.php?affiliate=shapeshed
[Open Source Initiative - BSD License]: http://opensource.org/licenses/bsd-license.php