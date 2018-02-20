<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Simple
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
			echo "<div class='contents'>";
			echo "	<section id='posts' class='posts-collapse'>";
			echo "		<span class='archive-move-on'></span>";
			echo "		<span class='archive-page-counter'>";
			echo "			".str_replace("：", " ", get_the_archive_title())." 下的文章";
			echo "		</span>";
			$argc = array ();
			$title = get_the_archive_title();
			$archiveType = mb_substr($title, 0, 2, 'UTF8');
			$archiveName = mb_substr($title, 3, mb_strlen($title) - 3, 'UTF8');
			$tagId = 0;
			if($archiveType == '分类') {
				$categories = get_categories();
				foreach ($categories as $category) {
					if($category->name == $archiveName) {
						$argc = array (
							'posts_per_page' => 1000,
							'category' => $category->cat_ID
						);
					}
				}
			}
			else if($archiveType == '标签') {
				$tags = get_tags();
				foreach ($tags as $tag) {
					if($tag->name == $archiveName) {
						$argc = array (
							'posts_per_page' => 1000
						);
						$tagId = $tag->term_id;
					}
				}
			}
			$posts = get_posts( $argc );
			$lastYear = 0;
			foreach($posts as $post) {
				if($archiveType == '标签') {
					$tags = get_the_tags($post);
					$contain = false;
					if(count($tags) != 0 && is_array($tags)) {
						foreach($tags as $tag) {
							if($tag->term_id == $tagId) {
								$contain = true;
							}
						}
					}
					if(!$contain) {
						continue;
					}
				}
				$currentYear =get_the_date('Y', $post->ID);
				if ($currentYear != $lastYear) {
					$lastYear = $currentYear;
					echo "<div class='collection-title'>";
					echo "	<h2 class='archive-year' id='archive-year-'".$currentYear."'>".$currentYear."</h2>";
					echo "</div>";
				}
		
				echo "<article class='post post-type-normal'>";
				echo "	<header class='post-header'>";
				echo "		<h1 class='post-title'>";
				echo "			<a class='post-title-link' href='".get_permalink($post)."' target='_blank'>";
				echo "				<span>".$post->post_title."</span>";
				echo "			</a>";
				echo "		 </h1>";
				echo "		<div class='post-meta'>";
				echo "			<time class='post-time' datetime='".esc_attr(get_the_date('c', $post->ID))."'>";
				echo "				".esc_html(get_the_date('m-d', $post->ID));
				echo "			</time>";
				echo "		</div>";
				echo "	</header>";
				echo "</article>";
			}
			echo "</section></div>";
			?>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
