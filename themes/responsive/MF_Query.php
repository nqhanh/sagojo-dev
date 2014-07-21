<?php
class MF_Query extends WP_Query{
	private $page_link = "page";
	
    function __construct(array $args){
        if(!array_key_exists('posts_per_page',$args)) $args['posts_per_page'] = 10;
		if(array_key_exists('page_link',$args)) $this->page_link['page_link'];
 
        $args['offset'] = (isset($_GET[$this->page_link])?($_GET[$this->page_link]-1)*$args['posts_per_page']:0);
        parent::query($args);
    }
 
    function next($link_text = "Next"){
 
            $curPage = intval((isset($_GET['page'])?$_GET['page']:1));//Use 1 if $_GET['page'] not set
 
            $link = "<a href='".remove_post_vars(curPageURL());
 
            if($curPage<$this->max_num_pages){
                echo $link.$this->constructQuery($this->merge(array($this->page_link=>$curPage+1),$_GET))."'>".$link_text."</a>";
            } else {
                return false;
            }
 
 
    }
    function prev($link_text = "Previous"){
 
            $curPage = (isset($_GET['page'])?$_GET['page']:1);//Use 1 if $_GET['page'] not set
            $link = "<a href='".remove_post_vars(curPageURL());
            if($curPage>1){
                echo $link.$this->constructQuery($this->merge(array($this->page_link=>$curPage-1),$_GET))."'>$link_text</a>";
            } else {
                return false;
            }
 
 
    }
    private function constructQuery(array $query){
 
 
        $url_ext = "?";
        foreach($query as $k => $v){
            $url_ext .=$k."=".$v."&amp;";
        }
        $url_ext = substr($url_ext, 0, -5);//chop last ampersand off
 
 
        return $url_ext;
 
    }
    private function merge($get, $put){
        //Get values from one array, and put them in another (overriding existing values if appropriate)
        foreach ($get as $k => $v){
                $put[$k]=$v;
        }
        return $put;
 
    }
}
?>