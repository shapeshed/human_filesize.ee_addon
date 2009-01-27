<?php
/**
* Plugin File for Shape Shed Human Filesize Plugin
*
* Returns the size of a file in human readable format (e.g 101.34 KB )
*
* This file must be placed in the
* /system/plugins/ folder in your ExpressionEngine installation.
* 
* @version 1.0.0
* @author George Ornbo <http://shapeshed.com/>
* @license {@link http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0 Unported} All source code commenting and attribution must not be removed. This is a condition of the attribution clause of the license.
*/

/**
* Plugin information used by ExpressionEngine
* @global array $plugin_info
*/
$plugin_info = array(
						'pi_name'			=> 'SS Human Filesize',
						'pi_version'		=> '1.0.0',
						'pi_author'			=> 'George Ornbo, Shape Shed',
						'pi_author_url'		=> 'http://shapeshed.com/',
						'pi_description'	=> 'Shows the size of a file in human readable format',
						'pi_usage'			=> Ss_human_filesize::usage()
					);

class Ss_human_filesize{

	/**
	* Returned string
	* @var array
	*/
    var $return_data;

 
	/**
	* Get the document size
	* @access	public
	*/
	function Ss_human_filesize() 
	    {

	        global $TMPL, $FNS;	
	
			// Get the full path to the doc
			$file_path = $_SERVER['DOCUMENT_ROOT'].$TMPL->tagdata;
			
			// Check the file exists. If not get the hell outta here!
			if (!file_exists($file_path)) {
				return;
			}			
			
			// Get the file size in bytes
			$filesize = filesize($file_path);
				
			// Now Format the bytes in a human readable format			
		    $size = $filesize / 1024;
		
		    if($size < 1024)
		        {
		        $size = number_format($size, 2);
		        $size .= ' KB';
		        } 
		
		    else 
		        {
		        if($size / 1024 < 1024) 
		            {
		            $size = number_format($size / 1024, 2);
		            $size .= ' MB';
		            } 
		        else if ($size / 1024 / 1024 < 1024)  
		            {
		            $size = number_format($size / 1024 / 1024, 2);
		            $size .= ' GB';
		            } 
		        }
	 		
			$this->return_data = $size;
		
		}

	/**
	* Plugin usage documentation
	*
	* @return	string Plugin usage instructions
	*/

	function usage()
	{
		
	return "This plugin returns the size of a file in human readable format (e.g 101.34 KB, 10.41 GB )
	
	Wrap the absolute path filename in these tags to have it processed

	{exp:doc_size}/uploads/documents/your_document.pdf{/exp:doc_size}

	If you are using Mark Huot's File extension you can just use the EE tag you chose for the file field

	{exp:ss_human_file_size}{your_file_field}{/exp:ss_human_file_size}
	
	The function calculates whether to show KB, MB or GB depending on the file size. 
	
	";		

	}
	
}

?>