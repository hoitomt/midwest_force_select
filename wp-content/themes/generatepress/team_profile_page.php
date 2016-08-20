<?php
/**
 * Template Name: Team Profile Page
 *
 * @package GeneratePress
 */

get_header(); ?>
  <div id="team-profile" ng-app="TeamProfile">
    <div ng-controller="PlayerController" ng-init="init()">
    	
      <a ng-click="newPlayer()" ng-show=!showNewPlayerForm class="btn btn-success">
        <span><i class="glyphicon glyphicon-plus"></i>Add Player</span>
      </a>
      <div id="new-player-form" ng-show="showNewPlayerForm">
        <form ng-submit="submit()" class="form-horizontal" novalidate>
          <input type="hidden" ng-model="player.id"/>
          <label>Number</label>
          <input type="text" ng-model="player.number"/>
          <label>Name</label>
          <input type="text" ng-model="player.name"/>
          <button class="btn">Submit</button>
          <a ng-click="newPlayer()" ng-show=showNewPlayerForm class="btn btn-danger">Cancel</a>
        </form>
        
        <form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>
        
        
      </div>
        
      <table class="table table-striped">
        <thead>
        <tr style="background-color: #537bac; color: #fff;">
          <th>Number</th>
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
          <td>{{player.number}}</td>
          <td><a href="{{playerLink(player)}}">{{player.name}}</a></td>
          <td>{{player.height}}</td>
          <td>{{player.position}}</td>
          <td>{{player.school}}</td>
          <td>{{player.year}}</td>
          <td>
            <a ng-click="editPlayer(player)"><i class="glyphicon glyphicon-pencil"></i></a>
            <a ng-click="deletePlayer(player)"><i class="glyphicon glyphicon-remove"></i></a>
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
		ngAppContent.remove();
		document.getElementsByClassName('entry-content')[0].innerHTML += ngAppContent.outerHTML;
		var newNgAppContent = document.getElementById('team-profile');
		newNgAppContent.style.display = '';
	</script>
	
	<script src="/wp-content/themes/generatepress/js/angular/angular.min.js"></script>
	<script src="/wp-content/themes/generatepress/js/angular/angular-resource.min.js"></script>
	<script src="/wp-content/themes/generatepress/js/angular/angular-route.min.js"></script>
	
	<script src="/wp-content/themes/generatepress/team-profile-app/app.js"></script>
	<script src="/wp-content/themes/generatepress/team-profile-app/services/player.js"></script>
	<script src="/wp-content/themes/generatepress/team-profile-app/controllers/player_controller.js"></script>
<?php 
do_action('generate_sidebars');
get_footer();
