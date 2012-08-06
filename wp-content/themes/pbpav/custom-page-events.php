<?php
/*
Template Name: Events
*/
?>

<?php get_header(); ?>

<div id="content">

<h1 class="posttitle">Events</h1>

<p class="eventsearch">View Events By: </p>
<div class="eventformsearc">
<?php 

$catargs = array(
  'hide_empty' => 0
);

$terms = get_terms( 'eventcat', $catargs );
if ($terms) {
  //var_dump($terms);
  echo '<form action="/events/" method="get" name="searchcat" id="searchcat">';
  echo '<select name="eventcat" id="eventcat">';
  echo '<option value="0">All Categories</option>';
  foreach ($terms as $cat) {
    $checked = null;
    if ($_REQUEST['eventcat'] == $cat->term_id) {
      $checked = ' selected';
    }
    echo '<option value="' . $cat->term_id . '"' . $checked . '>' . $cat->name . '</a>';
  }
  echo '</select>';
  echo '</form>';
}
?>
</div>
<div class="clear"></div>


<?php
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;

if ($_REQUEST['eventcat']) {
  
  $curterm = get_term($_REQUEST['eventcat'],'eventcat' );
  if ($curterm) {
    //$curtermparameter = 'eventcat=' . $curterm->slug;
    $curtermparameter = $curterm->slug;    
    //echo $curtermparameter;
  }
}

$comparedate = strtotime('-8 hours');

$args = array(
'post_type' => 'event',
'showposts' => '6',
'paged' => $page,
'eventcat' => $curtermparameter,
'meta_key' => 'removedate',
'meta_compare' => '>=',
'meta_value' => $comparedate
);

//query_posts("post_type=event&showposts=6&paged=$page&$curtermparameter");
query_posts($args);


?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   
   <?php
     include (TEMPLATEPATH . '/includes/eventloop.php');                 
   ?>
  
	<?php endwhile; ?>

		  <?php numeric_pagination(); ?>


	<?php else : ?>
	
	<p><?php _e('Not Found','gravy'); ?></p>

	<?php endif; ?>

</div><!--/content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
