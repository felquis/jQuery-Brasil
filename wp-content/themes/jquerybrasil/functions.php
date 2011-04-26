<?phpfunction _nothing_found() { ?>	<h2>Nenhum resultado encontrado</h2>	<?php get_search_form(); }function _paginate() {	echo "<div>";	if(function_exists('wp_pagenavi')) { 		wp_pagenavi(); 	} else { ?>		<p class="pagination"> <?php previous_posts_link("P&aacute;gina anterior") ?> <?php next_posts_link("Pr&oacute;xima p&aacute;gina") ?></p><?php 	} 		echo "</div>";}function _post() { ?><!-- POSTS --><div class="post">	<div class="posthead">		<span class="date">			<?php the_time('d/m/Y') ?>		</span><!-- /date -->		<span class="autor">			<?php the_author_posts_link(); ?> 		</span>		<?php //the_category(" | ")?>	</div><!-- /headpost -->	<div class="postcontent">		<h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title() ?></a></h1>		<?php the_content(); ?>		<?php the_tags("")?>					</div></div><!-- /POSTS --><?php }function get_jquery_categories($img = false) {	$args = array(  		'orderby' => 'name',  		'order' => 'ASC'  	);  	  	$categories = get_categories($args);	if($categories) {  		echo "<ul class='category-list'>";  		foreach($categories as $category) {?>  			<li class="<?php echo $category->name ?>">  				<a href="<?php echo get_category_link( $category->term_id )?>" title="Veja todos os posts de <?php echo $category->name ?>">  				<?php if($img){?>	  				<img height="40" width="40" src="<?php bloginfo('template_directory'); ?>/img/categorias/<?php echo $category->category_nicename?>.png">	  			<?php }?>	  				<span class="title"><?php echo $category->name ?> <span class='count'></span>(<?php echo $category->count ?>)</span></span>	  				<span class="clear"></span>  				</a>  			</li>  		<?php   		}  		echo '</ul>';  	}}function get_autor() {	$blogusers = get_users('&orderby=post_count&order=desc');    foreach ($blogusers as $user) {    	$link = get_author_posts_url( $user->ID, $user->user_nicename );    			echo "<a href='$link' title='Veja todos os posts de {$user->display_name}'>" . get_avatar($user->user_email,70,$user->user_login,$user->user_login) . "</a>";    }}/** * get the latest posts * @param int $qtde * @param boolean $echo */
function get_lastest_post($qtde = 4, $echo = true){	$posts = get_posts("numberposts=$qtde");	$html = "<ul>";	foreach($posts as $post) {		$postid = $post->ID;		$title = $post->post_title;		$cc = $post->comment_count;		$link = get_permalink($postid);		$html .=  "<li><a href='$link'>$title ($cc)</a></li>";	}	$html .= "</ul>";	if($echo) echo $html;}/** * template for comments * @param $comment * @param $args * @param $depth */
function jquery_comment($comment, $args, $depth) {	$GLOBALS['comment'] = $comment; ?>	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">		<span class="avatar"><?php echo get_avatar($comment,$size='64',$default='<path_to_url>' ); ?></span>		<span class="autor-date">			<span class="autor"><?php comment_author_link(); ?></span>			<span class="date"><?php comment_date("j \d\e F \d\e Y"); ?></span>		</span>		<span class="comment_text">			<?php comment_text() ?>			<?php if ($comment->comment_approved == '0') : ?>		         	<em><?php _e('Your comment is awaiting moderation.') ?></em>		        	<br />		    <?php endif; ?>			<?php edit_comment_link(__('(Edit)'),'  ','') ?>			</span>     	<div class="reply">        	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>      	</div>	</li><?php } function the_content_limit($max_char, $more_link_text = '(more...)') {    $content = get_the_content($more_link_text);    the_content_limit_func($content, $max_char, $more_link_text);}function the_content_limit_func($content, $max_char, $more_link_text = '(more...)') {    $content = apply_filters('the_content', $content);    $content = str_replace(']]>', ']]&gt;', $content);    $content = strip_tags($content);   if (strlen($_GET['p']) > 0) {      echo "<div>";      echo $content;      echo "</div>";   } else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {        $content = substr($content, 0, $espacio);        //$content = $content;        echo "<div>";        echo $content;        echo "... <span class='more'>$more_link_text</span>";        echo "</div>";   } else {      echo "<div>";      echo $content;      echo "</div>";   }}?>