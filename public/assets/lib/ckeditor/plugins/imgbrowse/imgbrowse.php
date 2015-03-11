<?php
// class to browse images in a folder (for CKEditor plugin)
// from: http://coursesweb.net/javascript/
class imgbrowse {
  // IN $root - REPLACE "/imgup" WITH THE PATH TO THE FOLDER WITH IMAGES RELATIVE TO ROOT OF YOUR WEBSITE ON SERVER
  protected $root = '/uploads/images/';
  protected $imgext = ['bmp', 'gif', 'jpg', 'jpe', 'jpeg', 'png'];    // allowed image extensions
  protected $imgdr = '';     // current folder (in $root) with images

  function __construct() {
    if(isset($_POST['imgroot'])) $this->root = trim(strip_tags($_POST['imgroot']));
    $this->root = trim($this->root, '/') .'/';
    $this->imgdr = isset($_POST['imgdr']) ? trim(trim(strip_tags($_POST['imgdr'])), '/') .'/' : '';
  }

  // return two-dimensional array with folders-list and images in specified $imgdr
  public function getMenuImgs() {
    $re = ['menu'=>'', 'imgs'=>''];
    try{
      $obdr = new DirectoryIterator($_SERVER['DOCUMENT_ROOT'] .'/'. $this->root . $this->imgdr);         // object of the dir
    }
    catch(Exception $e) {
      return '<h2>ERROR from PHP:</h2><h3>'. $e->getMessage() .'</h3><h4>Check the $root value in imgbrowse.php to see if it is the correct path to the image folder; RELATIVE TO ROOT OF YOUR WEBSITE ON SERVER</h4>';
    }

    // get protocol and host name to add absolute path in <img src>
    $protocol = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $site = $protocol. $_SERVER['SERVER_NAME'] .'/';

    // traverse the $obdr
    foreach($obdr as $fileobj) {
      $name = $fileobj->getFilename();

      // if image file, else, directory (but not . or ..), add data in $re
      if($fileobj->isFile() && in_array($fileobj->getExtension(), $this->imgext)) $re['imgs'] .= '<span><img src="'. $site . $this->root . $this->imgdr . $name .'" alt="'. $name .'" height="50" />'. $name .'</span>';
      else if($fileobj->isDir() && !$fileobj->isDot()) $re['menu'] .= '<li><span title="'. $this->imgdr . $name .'">'. $name .'</span></li>';
    }
    if($re['menu'] != '') $re['menu'] = '<ul>'. $re['menu'] .'</ul>';
    if($re['imgs'] == '') $re['imgs'] = '<h1>No Images</h1>';
    return $re;
  }
}

// uses the imgbrowse class
$obj = new imgbrowse;
$content = $obj->getMenuImgs();
echo json_encode($content);