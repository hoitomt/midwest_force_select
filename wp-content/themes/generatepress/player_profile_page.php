f<?php
/**
 * Template Name: Player Profile Page
 *
 * @package GeneratePress
 */

get_header(); ?>

<style type="text/css">
  [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
    display: none !important;
  }
</style>
<div id="player-profile" ng-app="PlayerDb" class="ng-cloak">
  <div ng-controller="PlayerController">  
    <div class="row"
      >&nbsp;<a id="breadcrumb-team" href="/team-profile/">Team Profile</a>&nbsp;
      >&nbsp;<a href="/teams/player/?player_id={{player.id}}">{{player.name}} Profile</a>
    </div>
    <div class="row">
      <div class="col-md-8">
        <h1 class="entry-title" style="margin-bottom: 20px;">{{player.number}} - {{player.name}}</h1>
      </div>
      <div class="col-md-4">
      	<?php
	  if ( is_user_logged_in() ) {
	?>
          <p class="text-right">
      	    <button class="btn btn-primary" ng-click="showEditPlayerForm()" ng-show="!showEditableFields">Edit</button>
    	    <button class="btn btn-danger" ng-click="hideEditPlayerForm()" ng-show="showEditableFields">Cancel</button>
          </p>
        <?php 
          } 
        ?>
      </div>
    </div>
    <!-- Default panel contents -->
    
    <div id="new-player-form" class"ng-cloak" style="padding: 10px; margin-bottom: 10px;">
        <div class="row">
            <div class="col-md-3">
                <a href="#" id="medium-image-link" target="_blank">
		  <img id="player-profile-photo" alt="Player Photo" />
		</a>
		<br />
		<br />
		<div ng-show="showEditableFields" class="form-group">
		  <label class="btn btn-primary btn-file">
			Select Photo <input id="select-player-photo" 
				      type="file" 
				      style="display: none;" 
				      onchange="angular.element(this).scope().uploadFile(this.files)">
		  </label>
		</div>
          	<table class="table">
            	  <tr>
              	    <td>Number</td>
              	    <td>{{player.number}}</td>
            	  </tr>
            	  <tr>
              	    <td>Height</td>
              	    <td>{{height(player)}}</td>
            	  </tr>
            	  <tr>
              	    <td>Position</td>
              	    <td>{{player.position}}</td>
            	  </tr>
            	  <tr>
              	    <td>School</td>
              	    <td>{{player.school}}</td>
            	  </tr>
            	  <tr>
		    <td>Year</td>
	            <td>{{player.year}}</td>
	          </tr>
            	  <tr>
		    <td>GPA</td>
	            <td>{{player.gpa}}</td>
	          </tr>
                </table>
            </div>
            <div class="col-md-9">
                <div style="margin: 0px auto; display: block; height: 512px; background-image: url(http://www.midwestforceselect.com/wp-content/uploads/2016/09/Logo-Midwest-FORCE-Black-Text-512_faded.png); background-repeat: no-repeat; background-position: center center;" ng-show="!showEditableFields">
		  <div class="panel bg-force-panel">
	  	    <div class="panel-heading bg-force-blue">
		      <h3 class="panel-title">Athletic Accomplishments</h3>
		    </div>
		    <div class="panel-body" ng-bind-html="player.athletic_accomplishments"></div>
                  </div>
                  <div class="panel bg-force-panel">
	  	    <div class="panel-heading bg-force-blue">
		      <h3 class="panel-title">Colleges Interested</h3>
		    </div>
		    <div class="panel-body" ng-bind-html="player.colleges_interested"></div>
                  </div>
                </div>
        	<form ng-submit="submit()" class="form-horizontal" ng-show="showEditableFields">            
        	  <input type="hidden" id="player-team-id" ng-model="player.team_id" value="{{player.team_id}}">
	          <div class="form-group">
		    <label for="player-number" class="col-sm-2 control-label">Number</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="player-number" placeholder="Number" ng-model="player.number">
		    </div>
		  </div>
        	  <div class="form-group">
		    <label for="player-name" class="col-sm-2 control-label">Name</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="player-name" placeholder="Name" ng-model="player.name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="player-height" class="col-sm-2 control-label">Height</label>
		    <div class="col-sm-10">
		      <input type="text" class="input-mini" id="player-height" placeholder="Feet" ng-model="player.height_feet">
		      <input type="text" class="input-mini" id="player-height" placeholder="Inches" ng-model="player.height_inches">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="player-position" class="col-sm-2 control-label">Position</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="player-position" placeholder="Position" ng-model="player.position">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="player-school" class="col-sm-2 control-label">School</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="player-school" placeholder="School" ng-model="player.school">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="player-year" class="col-sm-2 control-label">Year</label>
		    <div class="col-sm-10">
		      <select class="form-control" name="player-year" id="player-year" ng-model="player.year" placeholder="Graduating Year">
		      	<option value="2025">2025</option>
		      	<option value="2024">2024</option>
		      	<option value="2023">2023</option>
		      	<option value="2022">2022</option>
		      	<option value="2021">2021</option>
		      	<option value="2020">2020</option>
		      	<option value="2019">2019</option>
		      	<option value="2018">2018</option>
		      	<option value="2017">2017</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="player-gpa" class="col-sm-2 control-label">GPA</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="player-gpa" placeholder="GPA" ng-model="player.gpa">
		    </div>
		  </div>
	          <div class="form-group">
	            <label for="player-athletic_accomplishments" class="col-sm-2 control-label">Athletic Acc.</label>
	            <div class="col-sm-10">
	              <textarea rows="4" ui-tinymce class="form-control" placeholder="Athletic Accomplishments" ng-model="player.athletic_accomplishments"></textarea>
	            </div>
	          </div>
	          <div class="form-group">
	            <label for="player-colleges_interested" class="col-sm-2 control-label">Colleges Interested</label>
	            <div class="col-sm-10">
	              <textarea rows="4" class="form-control" ui-tinymce placeholder="Colleges Interested" ng-model="player.colleges_interested"></textarea>
	            </div>
	          </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn">Save</button>
		      <a ng-click="newPlayer()" ng-show=showNewPlayerForm class="btn btn-danger">Cancel</a>
		    </div>
		  </div>
		</form>
            </div> <!-- col-md-8 -->
          </div>
      </div>
    
    
    
    <div class="row">
      <div class="col-md-4">
      	<img id="player-profile-photo" src="">
      </div>
      
    </div>
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
  var ngAppContent = document.getElementById('player-profile');
  ngAppContent.remove();
  document.getElementsByClassName('entry-content')[0].innerHTML += ngAppContent.outerHTML;
  var newNgAppContent = document.getElementById('player-profile');
  newNgAppContent.style.display = '';
</script>

<script src="/wp-content/themes/generatepress/js/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/wp-content/themes/generatepress/js/jquery-1.12.4.min.js"></script>
<script src="/wp-content/themes/generatepress/js/angular/angular.min.js"></script>
<script src="/wp-content/themes/generatepress/js/angular/angular-resource.min.js"></script>
<script src="/wp-content/themes/generatepress/js/angular/angular-sanitize.min.js"></script>
<script src="/wp-content/themes/generatepress/js/tinymce/js/angular-ui_tinymce/tinymce.min.js"></script>

<script src="/wp-content/themes/generatepress/app/app.js"></script>
<script src="/wp-content/themes/generatepress/app/player_controller.js"></script>
<script src="/wp-content/themes/generatepress/app/player.js"></script>
<script src="/wp-content/themes/generatepress/app/team.js"></script>

<?php 
do_action('generate_sidebars');
get_footer();