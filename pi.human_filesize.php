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
 * @version    1.1.2
 * @since      1.0.0
 * @author     George Ornbo <george@shapeshed.com>, Craig Allen, Aidann Bowley (bridgingunit.com)
 * @see        {@link http://github.com/shapeshed/human_filesize.ee_addon/} 
 * @license    {@link http://opensource.org/licenses/bsd-license.php} 
 */

/**
* Plugin information used by ExpressionEngine
* @global array $plugin_info
*/
$plugin_info = array(
  'pi_name'			=> 'Human Filesize',
  'pi_version'		=> '1.1.2',
  'pi_author'			=> 'George Ornbo, Craig Allen, Aidann Bowley',
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
  * Holds the path to the file to be evaluated
  * @see __construct
  * @var string
  */	
  private $file;
	
  /**
  * The error message used if no file is found
  * @var string
  */	
  private $error_message = "The file was not found - please check your settings";
 
  /**
  * The function first strips tags and trims the string from the template
  * If the file is not found an error string is returned
  * Otherwise a human readable file size is calculated and returned to the tempalte
  * @access	public
  */
  function Human_filesize() 
    {

    global $TMPL, $FNS;	
    
    // BU: options for number format
    $decimals = $TMPL->fetch_param('decimals');
    $dec_point = $TMPL->fetch_param('dec_point');
    $thousands_sep = $TMPL->fetch_param('thousands_sep');
    
    // BU: make sure correct format, plus set defaults
    if($decimals !== FALSE)
    {
    	$decimals = intval($decimals);
    }
    else
    {
    	$decimals = '0';
    }
    if($dec_point !== FALSE)
    {
    	$dec_point = (string) $dec_point;
    	$dec_point = substr($dec_point, 0, 1);
    }
    else
    {
    	$dec_point = '.';
    }
    if($thousands_sep !== FALSE)
    {
    	$thousands_sep = (string) $thousands_sep;
    	$thousands_sep = substr($thousands_sep, 0, 1);
    }
    else
    {
    	$thousands_sep = ',';
    }
    
    
    
    $this->file = trim(strip_tags($TMPL->tagdata));

    $this->file = str_replace(SLASH, '/', $this->file);
	    
    if (stristr($this->file, $_SERVER['DOCUMENT_ROOT']))
    {
      $this->file =  $this->file;
    }
    else
    {
      $this->file = $_SERVER['DOCUMENT_ROOT'] . $this->file;		  
    }	
    
    if (!file_exists($this->file)) 
    {
      return $this->error_message;
    }

    $filesize = filesize($this->file);
    	
    $size = $filesize / 1024;

	// BU: preferred unit
    $unit = $TMPL->fetch_param('unit');
    
	if($unit !== FALSE)
	// output in our preferred format
	{
		switch ($unit) {
		    case 'MB':
		        $size = number_format($size / 1024, $decimals, $dec_point, $thousands_sep);
	        	$size .= ' MB';
		        break;
		    case 'GB':
		        $size = number_format($size / 1024 / 1024, $decimals, $dec_point, $thousands_sep);
	        	$size .= ' GB';
		        break;
		    default:
		    	$size = number_format($size, $decimals, $dec_point, $thousands_sep);
	      		$size .= ' KB';		    
		}
	}
	else
	// calculate whether to show KB, MB or GB depending on the file size.
	{		
		if($size < 1024)
	    {
	      $size = number_format($size, $decimals, $decimal_point, $thousands_sep);
	      $size .= ' KB';
	    } 
	    else 
	    {
	      if($size / 1024 < 1024) 
	      {
	        $size = number_format($size / 1024, $decimals, $decimal_point, $thousands_sep);
	        $size .= ' MB';
	      } 
	      else if ($size / 1024 / 1024 < 1024)  
	      {
	        $size = number_format($size / 1024 / 1024, $decimals, $decimal_point, $thousands_sep);
	        $size .= ' GB';
	      } 
	    }
	}
    
    $this->return_data = $size;
  }

  /**
  * Plugin usage documentation
  *
  * @return	string Plugin usage instructions
  */
  public function usage()
  {

  ob_start(); 
  ?>

	Documentation is available here http://shapeshed.github.com/expressionengine/plugins/filesize/

	Params:
	----------------
	
	unit
		Optional, either KB, MB or GB. If unit param is used but value isn't matched it defaults to KB. 
		If unit param is not used then the plugin shows KB, MB or GB depending on the filesize
	
	decimals
		Optional, the number of decimal points to use. Defaults to zero.
	
	dec_point
		Optional, the separator to use as a decimal point. Defaults to '.'
		
	thousands_sep
		Optional, the separator to use to demarcate thousands. Defaults to ','
		
	Examples:
	----------------
	
	{exp:human_filesize unit='KB'}{my_file}{/exp:human_filesize}
	2,289 KB
	
	{exp:human_filesize unit='MB'}{my_file}{/exp:human_filesize}
	2 MB
	
	{exp:human_filesize unit='MB' decimals='2'}{my_file}{/exp:human_filesize}
	2.24 MB
	
	{exp:human_filesize unit='KB' decimals='2' dec_point=',' thousands_sep=' '}{my_file}{/exp:human_filesize}
	2 288,93 KB (French format)

  <?php
  $buffer = ob_get_contents();
	
  ob_end_clean(); 

  return $buffer;
    
  }
	
}

?>