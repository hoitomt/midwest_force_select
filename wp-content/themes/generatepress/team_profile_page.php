<?php
/**
 * Template Name: Team Profile Page
 *
 * @package GeneratePress
 */

get_header(); ?>
<style type="text/css">
  [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
    display: none !important;
  }
</style>

  <div id="team-profile" ng-app="PlayerDb">
    <div ng-controller="TeamController">
      <?php
	if ( is_user_logged_in() ) {
      ?>
	<div style="margin-bottom: 10px;">
          <a href="{{newPlayerLink()}}" class="btn btn-success">Add Player</a>
        </div>
      <?php
      	}
      ?>
      <table id="team-table" class="table table-striped" data-slug=<?php 
	    global $post;
    	    $post_slug=$post->post_name;
    	    echo $post_slug;
	?>>
        <thead>
        <tr style="background-color: #537bac; color: #fff;">
          <th class="text-center">Number</th>
          <th>Name</th>
          <th>Height</th>
          <th>Position</th>
          <th>School</th>
          <th>Year</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="player in players | orderBy:'number'">
          <td class="text-center">{{player.number}}</td>
          <td><a href="{{playerLink(player)}}">{{player.name}}</a></td>
          <td>{{height(player)}}</td>
          <td>{{player.position}}</td>
          <td>{{player.school}}</td>
          <td>{{player.year}}</td>
          <td class="text-center">
  	    <?php
	      if ( is_user_logged_in() ) {
	    ?>
              <a ng-click="deletePlayer(player)"><i class="glyphicon glyphicon-remove"></i></a>
            <?php
              }
            ?>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
	
	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
			<?php do_action('generate_before_main_content'); ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) : ?>
					<div class="comments-area">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>
			<?php do_action('generate_after_main_content'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
        <script>
          var ngAppContent = document.getElementById('team-profile');
          jQuery('#team-profile').remove();
          jQuery('.entry-content').append(ngAppContent.outerHTML);
          var newNgAppContent = document.getElementById('team-profile');
          newNgAppContent.style.display = '';
        </script>

	
	<script src="/wp-content/themes/generatepress/js/tinymce/js/tinymce/tinymce.min.js"></script>
	<script src="/wp-content/themes/generatepress/js/jquery-1.12.4.min.js"></script>
	<script src="/wp-content/themes/generatepress/js/angular/angular.min.js"></script>
	<script src="/wp-content/themes/generatepress/js/angular/angular-resource.min.js"></script>
	<script src="/wp-content/themes/generatepress/js/angular/angular-sanitize.min.js"></script>
	<script src="/wp-content/themes/generatepress/js/tinymce/js/angular-ui_tinymce/tinymce.min.js"></script>
	
	<script src="/wp-content/themes/generatepress/app/app.js"></script>
	<script src="/wp-content/themes/generatepress/app/team_controller.js"></script>
	<script src="/wp-content/themes/generatepress/app/player.js"></script>
<?php 
do_action('generate_sidebars');
get_footer();
