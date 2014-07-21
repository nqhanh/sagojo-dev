<?php

/**

 * The template for displaying Category Archive pages.

 *

 * @file      category.php

 * @package   max-magazine

 * @author    Sami Ch.

 * @link      http://gazpo.com

 * 

 **/

?>

<?php get_header(); ?>

<?php $this_category = get_category($cat);
$child = get_category($this_category->cat_ID);
                    if ((get_category_children($this_category->cat_ID) != "")||($child->parent==187)){?>
<div id="content" class="grid col-620 ">
<?php }
else {?><div id="content" class="grid col-940 "><?php }?>
        <!--<div class="page-title">-->
        <div class="breadcrumbs">
                            <span><a href="<?php echo site_url();?>" title="Home">Home</a>
                            <?php /*printf( __( '%s', 'max-magazine' ), '<span>' . single_cat_title( '', false ) . '</span>' ); */?>
                            <?php echo get_category_parents($cat, TRUE, ''); ?></span>
                 
        </div>
                        <!--</div>-->

                        

                <?php

                    $category_description = category_description();

                        if ( ! empty( $category_description ) )

                            echo apply_filters( 'category-archive-meta', '<div class="archive-meta">' . $category_description . '</div>' );

                ?>

                <?php
                    //for each category, show 4 posts
                    $this_category = get_category($cat);
                    if (get_category_children($this_category->cat_ID) != "") {
                        
    
                    $cat_args=array(
    
                      'orderby' => 'ID', //sap xep theo name or ID
    
                      'order' => 'ASC',
    
                      'child_of' => $this_category->cat_ID
    
                       );
    
                    $categories=get_categories($cat_args);
    //phan biet Blog va CNVL
                    if($this_category->cat_ID==124){
                        //$i=0; president-yohan-matsutani
                    $bloglink = new WP_Query("pagename=president-yohan-matsutani"); while($bloglink->have_posts()) : $bloglink->the_post();
                    $blogid = get_cat_ID( 'president-yohan-matsutani' );
                    $linktoblog =  get_permalink($blogid);                  
                    endwhile;
                    wp_reset_postdata();
                    $recent = new WP_Query("pagename=president-yohan-matsutani-category&post_status=array('publish')"); while($recent->have_posts()) : $recent->the_post();
                        echo "<div id=\"post_in_cat\">";
                        echo "<div id=\"cat-title\">";
                        $blogtitle =  __("[:en]President Yohan Matsutani[:vi]President Yohan Matsutani[:ja]松谷容範会長のブログ");
                        echo "<h1><a href='";
                        echo $linktoblog;
                        echo "' title='". sprintf( __( "View all posts in %s" ), $blogtitle ) ."'>" . $blogtitle."</a></h1>";
                        echo "</div>"; 
                        
                        the_content();
                        
                        echo "</div>";//post_in_cat
                    
                    endwhile;
                    wp_reset_postdata();
                    $bloglink = new WP_Query("pagename=ceo-tomomi-naka"); while($bloglink->have_posts()) : $bloglink->the_post();
                    $blogid = get_cat_ID( 'ceo-tomomi-naka' );
                    $linktoblog =  get_permalink($blogid);
                    endwhile;
                    wp_reset_postdata();
                    $recent = new WP_Query("pagename=ceo-tomomi-naka-category&post_status=array('publish')"); while($recent->have_posts()) : $recent->the_post();
                    echo "<div id=\"post_in_cat\">";
                    echo "<div id=\"cat-title\">";
                    $blogtitle = __("[:en]CEO Tomomi Naka[:vi]CEO Tomomi Naka[:ja]中友美社長のブログ");
                    echo "<h1><a href='";
                    echo $linktoblog;
                    echo "' title='". sprintf( __( "View all posts in %s" ), $blogtitle ) ."'>" . $blogtitle."</a></h1>";
                    echo "</div>";
                    
                    the_content();
                     
                    echo "</div>";//post_in_cat
                    
                    endwhile;
                    wp_reset_postdata();
                }
    //phan biet Blog va CNVL
                      foreach($categories as $category) {   
                        //if ($i==0)
                            //include "includes/type1.php";
                        //else  
                        if($this_category->cat_ID==124)                         
                            include "includes/type3.php";
                        if($this_category->cat_ID==187)
                            include "includes/type5.php";
                        //$i++;
                        } // foreach($categories
                    }//if (get_category_children

                    else {
						$child = get_category($this_category->cat_ID);
                        if($child->parent==124)
							get_template_part('content');
						else if($child->parent==187)
							get_template_part('content-hau');
                    }
                ?>

</div>
<?php    
 $this_category = get_category($cat);
 $child = get_category($this_category->cat_ID);
                    if ((get_category_children($this_category->cat_ID) != "")||($child->parent==187)){?>
<?php get_sidebar(); }?>

<?php get_footer(); ?>