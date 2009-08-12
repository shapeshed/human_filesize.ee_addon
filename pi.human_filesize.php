<?php
/** 
 * ExpressionEngine
 *
 * LICENSE
 *
 * ExpressionEngine by EllisLab is copyrighted software
 * The licence agreement is available here http://expressionengine.com/docs/license.html
 * 
 * Human Filesize
 * 
 * @category   Plugins
 * @package    Human Filesize
 * @version    1.1.0
 * @since      1.0.0
 * @author     George Ornbo <george@shapeshed.com>
 * @see        {@link http://github.com/shapeshed/human_filesize.ee_addon/} 
 * @license    {@link http://opensource.org/licenses/bsd-license.php} 
 */

/**
* Plugin information used by ExpressionEngine
* @global array $plugin_info
*/
$plugin_info = array(
						'pi_name'			=> 'Human Filesize',
						'pi_version'		=> '1.0.0',
						'pi_author'			=> 'George Ornbo',
						'pi_author_url'		=> 'http://shapeshed.com/',
						'pi_description'	=> 'Shows the size of a file in human readable format',
						'pi_usage'			=> Human_filesize::usage()
					);

class Human_filesize{

	/**
	* Returned string
	* @var array
	*/
    var $return_data;

 
	/**
	* Get the document size
	* @access	public
	*/
	function Human_filesize() 
	    {

	        global $TMPL, $FNS;	
		
			// Get the full path to the doc
			$file_path = $_SERVER['DOCUMENT_ROOT'].$TMPL->tagdata;
			
			// Slashes get converted to entities so convert back
			$file_path = str_replace(SLASH, '/', $file_path);
			
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
ob_start(); 
?>
Documentation is available here http://shapeshed.github.com/expressionengine/extensions/filesize.html

<?php
$buffer = ob_get_contents();

ob_end_clean(); 

return $buffer;
}
	
}

?>