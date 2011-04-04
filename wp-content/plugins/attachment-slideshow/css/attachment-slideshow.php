<?php 
/*
header("Content-type: text/css");
require_once( dirname(__FILE__) . '/image-gallery-reloaded.php');
  $g_main_height=get_option('g_main_height');
  $g_main_width=get_option('g_main_width');
*/
?>


.attachmentslideshow {
  background: #000;
  padding: 10px;
  color: #fff;
  text-align: center;
}

.atslidebeginning {
  display: block;
  width: 32px;
  height: 32px;
  background: url(../images/rewind.png) no-repeat;
  text-indent: -9999px;
  float: left;
  margin: 0 5px 0 0;
}

.atslideback {
  display: block;
  width: 32px;
  height: 32px;
  background: url(../images/backward.png) no-repeat;
  text-indent: -9999px;
  float: left;
  margin: 0 5px 0 0;
}

.atslideforward {
  display: block;
  width: 32px;
  height: 32px;
  background: url(../images/forward.png) no-repeat;
  text-indent: -9999px;
  float: left;
}

.clear {
  clear: both;
}

.atslidenavbuttons {
  float: right;
}

.atslidepagination {
  width: 70px;
  float: left;
  line-height: 32px;
  font-size: 18px;
  text-align: center;
}

#atnav { 
  margin: 0;
  padding: 0;
}

#atnav li { 
  width: 60px; 
  float: left; 
  margin: 8px; 
  list-style: none;
  padding: 0;
}

#atnav a { 
  width: 50px;  
  display: block; 
  margin: 0;
  padding: 5px;
  background: #161616
}

#atnav .activeSlide a, #atnav a:hover { 
  background: #2e2e2e; 
}

#atnav a:focus { 
  outline: none; 
}

#atnav img { 
  border: none; 
  display: block; 
  margin: 0; 
}

.atslideshow img {
  padding: 0;
  border: 0;
}

h4.atslideshowtitle {
  color: #fff !important;
}

.atslide {
  display: none;
  color: #fff !important;
}

.atslide.atslidefirst {
  display: block;
}

.atslide, .atslide h5 {
  color: #fff !important;
}

.atslidetitle {
  width: 600px;
  text-align: center;
}

.atslideshow {
  width: 600px;
}
