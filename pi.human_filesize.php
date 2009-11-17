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
 * @version    1.1.1
 * @since      1.0.0
 * @author     George Ornbo <george@shapeshed.com>, Craig Allen
 * @see        {@link http://github.com/shapeshed/human_filesize.ee_addon/} 
 * @license    {@link http://opensource.org/licenses/bsd-license.php} 
 */

/**
* Plugin information used by ExpressionEngine
* @global array $plugin_info
*/
$plugin_info = array(
  'pi_name'			=> 'Human Filesize',
  'pi_version'		=> '1.1.1',
  'pi_author'			=> 'George Ornbo, Craig Allen',
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

    if($size < 1024)
    {
      $size = number_format($size, 0);
      $size .= 'KB';
    } 
    else 
    {
      if($size / 1024 < 1024) 
      {
        $size = number_format($size / 1024, 0);
        $size .= 'MB';
      } 
      else if ($size / 1024 / 1024 < 1024)  
      {
        $size = number_format($size / 1024 / 1024, 0);
        $size .= 'GB';
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
    return "Documentation is available here http://shapeshed.github.com/expressionengine/plugins/filesize/";
  }
	
}

?>