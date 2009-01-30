Human Filesize - Shows the size of a file in human readable format
===========================================================================

**Author**: [George Ornbo][]
**Source Code**: [Github][]

Installation
-----

This file pi.human_filesize.php must be placed in the /system/plugins/ folder in your [ExpressionEngine][] installation.

Name
------------------

Human Filesize

Synopsis
-------

Shows the size of a file in human readable format

Description
-------

This plugin returns the size of a file in human readable format (e.g 101.34 KB, 10.41 GB ) Wrap the absolute path filename in these tags to have it processed

	{exp:ss_human_filesize}/uploads/documents/your_document.pdf{/exp:ss_human_filesize}

If you are using Mark Huot's File extension you can just use the EE tag you chose for the file field

	{exp:ss_human_file_size}{your_file_field}{/exp:ss_human_file_size}
	
The function calculates whether to show KB, MB or GB depending on the file size.

Parameters
-------

There are currently no parameters
	
Single Variables
-------

There are currently no single variables
	
Examples
-------

	{exp:ss_human_filesize}/uploads/documents/your_document.pdf{/exp:ss_human_filesize}
		
	
Compatibility
-------

ExpressionEngine Version 1.6.x

See also
-------

http://expressionengine.com/forums/viewthread/92466/
	
License
-------

Friendly 404 is licensed under a [Open Source Initiative - BSD License][] license.

---

This file is written using the MarkDown syntax. It may or may not have been parsed. If you are having trouble reading it try running the contents through http://daringfireball.net/projects/markdown/dingus.

[George Ornbo]: http://shapeshed.com/
[Github]: http://github.com/shapeshed/human_filesize.ee_addon/
[ExpressionEngine]:http://www.expressionengine.com/index.php?affiliate=shapeshed
[Open Source Initiative - BSD License]: http://opensource.org/licenses/bsd-license.php