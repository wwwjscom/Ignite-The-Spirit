<?php
/******************************************************************************
 Lightloader - Image Uploader
 Copyright (C) 2007  Jeremy Nicoll

 This library is free software; you can redistribute it and/or
 modify it under the terms of the GNU Lesser General Public
 License as published by the Free Software Foundation; either
 version 2.1 of the License, or (at your option) any later version.

 This library is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 Lesser General Public License for more details.

 You should have received a copy of the GNU Lesser General Public
 License along with this library; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

 Please see lgpl.txt for a copy of the license - this notice and the file
 lgpl.txt must accompany this code.

 Please go to forums.SeeMySites.net for questions and support of this library.
 Go to www.ScriptSing.com for code updates.
*******************************************************************************/

class ImageSizer {

  var $_baseDir;
  var $_baseImg;
  var $_imgData;

  var $_newImg;
  var $_newData;
  var $_newFormat;

  var $_loadPath;
  var $_defaultColor = array(0,0,0);

  var $keepAspectRatio;
  var $dontMakeBigger;

  function ImageSizer($baseDir) {
    $this->changeBaseDir($baseDir);
    $this->keepAspectRatio = true;
    $this->makeBigger = false;
  }

  function changeBaseDir($baseDir) {
    $this->_baseDir = $baseDir;
  }

  function setDefaultColor($r, $g, $b) {
    $this->_defaultColor = array($r, $g, $b);
  }

  function changeFormat($str) {
    $str = strtolower($str);
    if ($str == 'jpg') $str = $jpeg;
    $acceptable_formats = array('jpeg', 'gif', 'png');
    if (!in_array($str, $acceptable_formats)) return false;
    $this->_newFormat = $str;
  }

  function loadImage($imgPath) {
    $this->_imgData = getimagesize($this->_baseDir. $imgPath);
    $this->_imgData['funcType'] = preg_replace('#image/#i', '', $this->_imgData['mime']);
    $this->_newData = $this->_imgData;
    $funcName = 'imagecreatefrom' . $this->_imgData['funcType'];
    $this->_newImg = $this->_baseImg  = $funcName($this->_baseDir. $imgPath);
    $this->_loadPath = $imgPath;
  }

  function resizeImage($w, $h) {
    $current_w = $this->getWidth();
    $current_h = $this->getHeight();

    if ($this->keepAspectRatio) {
      $percent = 1;
      if ($current_w > $w || $current_h > $h || $this->makeBigger) {
        $h_percent = $percent = $h / $current_h;
        $w_percent = $percent = $w / $current_w;
        $percent = min($h_percent, $w_percent);
      }
      $new_w = $current_w * $percent;
      $new_h = $current_h * $percent;
    } else {
      $new_w = $w;
      $new_h = $h;
    }

    $this->_newImg = ImageCreateTrueColor($new_w, $new_h);
    $this->_newData = array($new_w, $new_h);

    if ($this->getNewType() == 'png' || $this->getNewType() == 'gif') { // This preserves the transparency
      imageAlphaBlending($this->_newImg, false);
      imageSaveAlpha($this->_newImg, true);
    } else { // This is if converting from PNG to another image format
      list($r, $g, $b) = $this->_defaultColor;
      $color = imagecolorallocate($this->_newImg, $r, $g, $b);
      imagefilledrectangle($this->_newImg, 0,0, $new_w, $new_h, $color);
    }

    imagecopyresampled($this->_newImg, $this->_baseImg, 0,0,0,0, $new_w, $new_h, $current_w, $current_h);
    return true;
  }

  function showImage() {
    header('Content-type: ' . $this->getNewMime());
    $funcName = 'image'.$this->getNewType();
    $funcName($this->_newImg ? $this->_newImg : $this->_baseImg);
  }

  function saveToFile($fileloc) {
    $funcName = 'image'.$this->getNewType();
    $funcName($this->_newImg ? $this->_newImg : $this->_baseImg, $fileloc);
  }

  function addWatermark($pngloc) {
  	$overlay = imagecreatefrompng($pngloc);
    imageAlphaBlending($overlay, false);
    imageSaveAlpha($overlay, true);
  	imagecopy($this->_newImg, $overlay, (imagesx($this->_newImg))-(imagesx($overlay)), (imagesy($this->_newImg))-(imagesy($overlay)), 0, 0, imagesx($overlay), imagesy($overlay));
  }

  function getBaseDir() { return $this->_baseDir; }

  function getWidth() { return $this->_imgData[0]; }
  function getHeight() { return $this->_imgData[1]; }
  function getMime() { return $this->_imgData['mime']; }
  function getType() { return $this->_imgData['funcType'];}


  function getNewWidth() { return $this->_newData[0]; }
  function getNewHeight() { return $this->_newData[1]; }
  function getNewMime() {return $this->_newFormat ? 'image/' . $this->_newFormat : $this->_imgData['mime'];}
  function getNewType() {return $this->_newFormat ? $this->_newFormat : $this->_imgData['funcType'];}

}


?>
