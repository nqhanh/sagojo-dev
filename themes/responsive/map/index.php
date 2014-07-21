<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script type="text/javascript"><!--
	il = {
		show: function(elem) {
			document.getElementById(elem).style.display = 'block';			
			document.getElementById('default').style.display = 'none';
		},
		hide: function(elem) {
			document.getElementById(elem).style.display = 'none';			
			document.getElementById('default').style.display = 'block';
		}
	}	
--></script>
<script type="text/javascript"><!--
	div = {
		show: function(elem) {
			document.getElementById(elem).style.display = 'block';
		},
		hide: function(elem) {
			document.getElementById(elem).style.display = 'none';
		}
	}	
--></script>
<style type="text/css"><!--
	il {display:none}
--></style>
</head>

<body onload="MM_preloadImages('http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-dongbac.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-taybac.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-hanoi.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-dong.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-nghe-tinh.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-hue.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-danang.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-taynguyen.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-namtrungbo.png','http://sagojo.com/wp-content/themes/responsive/map/bando-sagojo-hochiminh.png','http://sagojo.com/wp-content/themes/responsive/map/bando-taynambo.png')">
	
    
    <div id="map_map">
    <img src="<?php echo bloginfo('template_directory')?>/map/map-sagojo.png" width="295" height="498" border="0" usemap="#Map" id="Image1" alt="Bản đồ tìm việc làm nhanh toàn quốc"/>
    <map name="Map" id="Map">
	  <area class="area_hover" shape="poly" coords="1,1,1,1" href="#" onmouseover="div.show('default')" onmouseout="div.hide('default')">
	  <div class="hoverdb">
		  <area shape="poly" coords="105,6,130,18,148,19,149,26,139,37,145,43,151,48,156,52,165,61,161,65,159,71,154,74,142,72,132,72,122,68,116,63,106,62,99,54,97,45,88,40,81,32,80,24,86,21,88,13,97,8" href="http://sagojo.com/vi/tim-viec-lam/find/?category=&location=Đông+Bắc&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-sagojo-dongbac.png',1);il.show('dongbac')" onmouseout="MM_swapImgRestore();il.hide('dongbac')"  alt="Tìm kiếm việc làm vùng Đông Bắc" />
		  <div class="tooltip">Tìm kiếm việc làm <br/> vùng Đông Bắc</div>
	  </div>
	  <div class="hoverdhbb">
		<area shape="poly" coords="186,61,173,61,168,69,162,71,159,78,149,79,139,79,134,89,133,98,125,106,118,106,127,113,135,113,149,92,157,86,168,81" href="http://sagojo.com/vi/tim-viec-lam/find/?category=&location=Duyên+hải+Bắc+bộ&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-sagojo-dong.png',1);il.show('mongcai')" onmouseout="MM_swapImgRestore();il.hide('mongcai')" alt="Tìm kiếm việc làm vùng duyên hải Bắc bộ" />
		<div class="tooltipntb">Tìm kiếm việc làm <br/> vùng duyên hải <br/> Bắc bộ</div>
	  </div>
	  
	  <div class="hoverbb">
		<area shape="poly" coords="97,62,107,66,115,69,122,75,129,76,129,81,130,87,128,95,121,100,111,102,102,97,98,93,92,93,95,86,89,79,91,68" href="http://sagojo.com/en/tim-viec-lam/find/?category=&location=Bắc+bộ&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-sagojo-hanoi.png',1);il.show('hanoi')" onmouseout="MM_swapImgRestore();il.hide('hanoi')" alt="Tìm kiếm việc làm vùng Bắc bộ" />
		<div class="tooltipbb">Tìm kiếm việc làm <br/> vùng Bắc bộ</div>
	  </div>
	  
	  <div class="hovertb">
		<area shape="poly" coords="74,27,77,40,89,44,94,54,91,58,88,66,88,78,90,88,85,92,77,90,73,84,66,82,55,87,46,88,35,81,30,73,30,65,27,58,23,58,18,57,14,48,11,42,8,36,11,30,14,28,26,33,32,35,38,31,43,25" href="http://sagojo.com/vi/tim-viec-lam/find/?category=&location=Tây+Bắc&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-sagojo-taybac.png',1);il.show('taybac')" onmouseout="MM_swapImgRestore();il.hide('taybac')" alt="Tìm kiếm việc làm vùng Tây Bắc" />
		<div class="tooltiptb">Tìm kiếm việc làm <br/> vùng Tây Bắc</div>
	  </div>
	  
	  <div class="hoverbtb">
		<area shape="poly" coords="127,116,119,110,111,106,102,102,97,97,88,100,82,95,76,101,86,106,93,112,88,123,83,128,73,128,65,127,63,136,68,139,76,148,86,155,97,157,99,166,105,175,112,177,114,182,119,191,128,199,135,205,142,216,143,228,149,233,158,232,159,237,169,241,174,242,179,242,185,243,190,239,183,236,178,232,173,226,166,222,161,214,154,208,150,203,144,196,141,187,140,181,135,176,129,173,126,169,122,163,119,157,115,151,114,146,118,138,121,128" href="http://sagojo.com/vi/tim-viec-lam/find/?category=&location=Bắc+Trung+bộ&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-sagojo-bactrungbo.png',1);il.show('bactrungbo')" onmouseout="MM_swapImgRestore();il.hide('bactrungbo')" alt="Tìm kiếm việc làm vùng Bắc trung bộ" />        
		<div class="tooltipbtb">Tìm kiếm việc làm <br/> vùng Bắc trung bộ</div>
	  </div>
	  
	  <div class="hovertn">
		<area shape="poly" coords="209,293,209,309,213,322,215,339,210,342,213,354,216,359,210,360,209,370,210,380,206,394,197,394,194,397,184,400,175,395,170,387,170,375,170,371,177,365,175,359,176,348,178,335,178,326,173,318,172,304,174,293,177,283,179,274,181,271" href="http://sagojo.com/vi/tim-viec-lam/find/?category=&location=Tây+nguyên&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-sagojo-taynguyen.png',1);il.show('taynguyen')" onmouseout="MM_swapImgRestore();il.hide('taynguyen')" alt="Tìm kiếm việc làm ở Tây Nguyên" />
		<div class="tooltiptn">Tìm kiếm việc làm <br/> ở Tây Nguyên</div>
	  </div>
	  
	  <div class="hoverntb">
		<area shape="poly" coords="194,243,186,246,181,245,175,247,169,252,168,257,175,263,183,264,189,268,193,271,198,276,203,278,208,280,211,284,211,288,213,297,211,305,215,312,216,317,219,323,220,332,219,341,215,347,221,352,223,356,220,362,216,365,215,369,214,376,214,383,214,389,211,394,206,397,202,400,197,404,188,406,181,405,177,405,177,411,179,416,178,422,181,426,186,421,194,415,200,412,207,409,220,399,229,387,231,364,229,354,237,352,231,339,231,315,224,291,215,269,199,250" href="http://sagojo.com/vi/tim-viec-lam/find/?category=&location=Nam+Trung+bộ&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-sagojo-namtrungbo.png',1);il.show('namtrungbo')" onmouseout="MM_swapImgRestore();il.hide('namtrungbo')" alt="Tìm kiếm việc làm vùng Nam trung bộ" />
		<div class="tooltipntb">Tìm kiếm <br/> việc làm <br/>  vùng Nam <br/>  trung bộ</div>
	  </div>
	  
	  <div class="hoverdnb">
		<area shape="poly" coords="166,432,174,428,174,420,173,414,170,407,170,400,167,395,163,387,165,381,165,371,158,377,150,382,139,384,135,391,124,391,123,400,127,407,144,414,153,424,155,433" href="http://sagojo.com/vi/tim-viec-lam/find/?category=&location=Đông+Nam+bộ&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-sagojo-hochiminh.png',1);il.show('dongnambo')" onmouseout="MM_swapImgRestore();il.hide('dongnambo')" alt="Tìm kiếm việc làm vùng Đông Nam bộ" />
		<div class="tooltiptn">Tìm kiếm việc làm <br/> vùng Đông Nam bộ</div>
	  </div>
	  
	  <div class="hovermt">
		<area shape="poly" coords="147,449,151,440,150,433,144,428,140,420,136,414,128,418,120,417,110,416,100,417,94,421,89,431,82,433,82,437,95,441,93,449,92,456,92,465,88,481,92,486,90,492,97,493,107,482,114,475,119,473,129,471,136,460,145,458" href="http://sagojo.com/vi/tim-viec-lam/find/?category=&location=Miền+Tây&query=" onmouseover="MM_swapImage('Image1','','<?php echo bloginfo("template_directory")?>/map/bando-taynambo.png',1);il.show('mientay')" onmouseout="MM_swapImgRestore();il.hide('mientay')" alt="Tìm kiếm việc làm ở Miền Tây" />
		<div class="tooltipmt">Tìm kiếm việc làm <br/> ở Miền Tây</div>
	  </div>
	</map>
		
</div>
</body>
</html>
