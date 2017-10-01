f<?php
/**
 * Template Name: Player Show
 *
 * @package GeneratePress
 */
  $player_id = $_GET['player_id'];

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $player_stmt = $pdo->prepare("SELECT * FROM players WHERE id = :player_id");
  $player_stmt->bindParam(':player_id', $player_id);

  $player_stmt->execute();
  $player = $player_stmt->fetch(PDO::FETCH_OBJ);
  
  $videos_stmt = $pdo->prepare("SELECT * FROM player_videos WHERE player_id = :player_id");
  $videos_stmt->bindParam(':player_id', $player_id);

  $videos_stmt->execute();

  Database::disconnect();

  $team_id = $player->team_id;

  get_header();
?>
<style>
hr {
  margin: 5px 0;
}
</style>

  <div id="primary" <?php generate_content_class();?>>
    <main id="main" <?php generate_main_class(); ?>>
      <?php do_action('generate_before_main_content'); ?>

        <article id="post-1009" class="post-1009 page type-page status-publish hentry" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
          <div class="inside-article">
            <div class="entry-content" itemprop="text">
              <div id="player-profile">
                <div>
                  <div class="row"
                    >&nbsp;<a id="breadcrumb-team" href="/teams/show/?team_id=<?php echo $team_id ?>">Team Profile</a>&nbsp;
                    >&nbsp; <?php echo $player->name ?>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <h1 class="entry-title" style="margin-bottom: 20px;"><?php echo $player->name ?> - <?php echo $player->number ?></h1>
                    </div>
                    <div class="col-md-4">
                      <?php
                  if ( is_user_logged_in() ) {
                ?>
                        <p class="text-right">
                          <a class="btn btn-primary" href="/teams/players/edit/?player_id=<?php echo $player->id ?>">Edit</a>
                        </p>
                      <?php
                        }
                      ?>
                    </div>
                  </div>
                  <!-- Default panel contents -->

                  <div id="new-player-form" style="padding: 10px; margin-bottom: 10px;">
                    <div class="row">
                      <div class="col-md-3">
                        <img id="player-profile-photo" src="<?php echo $player->photo_url ?>" alt="Player Photo" />
                        <br />
                        <br />
                        <div class="form-group">
                 	  <?php if ( is_user_logged_in() ) { ?>
                          <label class="btn btn-primary btn-file">
                            Select Photo <input id="select-player-photo" 
                            			type="file" 
                            			style="display: none;"
                            			onchange="uploadFileToS3('<?php echo $player->id ?>')">
                          </label>
                          <?php } ?>
                        </div>
                        <table class="table">
                          <tr>
                            <td>Number</td>
                            <td><?php echo $player->number ?></td>
                          </tr>
                          <tr>
                            <td>Height</td>
                            <td><?php echo $player->height_feet."' ".$player->height_inches."\"" ?></td>
                          </tr>
                          <tr>
                            <td>Position</td>
                            <td><?php echo $player->position ?></td>
                          </tr>
                          <tr>
                            <td>School</td>
                            <td><?php echo $player->school ?></td>
                          </tr>
                          <tr>
                            <td>Year</td>
                            <td><?php echo $player->year ?></td>
                          </tr>
                          <tr>
                            <td>GPA</td>
                            <td><?php echo $player->gpa ?></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-9">
                        <div style="margin: 0px auto; 
                        	    display: block; 
                        	    background-image: url(http://www.midwestforceselect.com/wp-content/uploads/2016/09/Logo-Midwest-FORCE-Black-Text-512_faded.png); 
                        	    background-repeat: no-repeat; 
                        	    background-position: center center;">
                          <div class="panel bg-force-pa
                          nel">
                            <div class="panel-heading bg-force-blue">
                              <h3 class="panel-title">Athletic Accomplishments</h3>
                            </div>
                            <div class="panel-body"><?php echo $player->athletic_accomplishments ?></div>
                          </div>
                          <div class="panel bg-force-panel">
                            <div class="panel-heading bg-force-blue">
                              <h3 class="panel-title">Colleges Interested</h3>
                            </div>
                            <div class="panel-body"><?php echo $player->colleges_interested ?></div>
                          </div>
                          <div class="panel bg-force-panel">
                            <div class="panel-heading bg-force-blue">
                              <h3 class="panel-title">Videos</h3>
                            </div>
                            <div class="panel-body">
                      	      <?php if ( is_user_logged_in() ) { ?>
                              <form action="/app/players/add_video.php" method="POST" class>
                            	<input type="hidden" name="player_id" value="<?php echo $player_id ?>">
				<div class="form-group row">
				  <label for="description" class="col-sm-2 col-form-label">Description</label>
				  <div class="col-sm-10">
				    <input class="form-control" type="text" name="description" id="description">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="video_url" class="col-sm-2 col-form-label">Video URL</label>
				  <div class="col-sm-10">
				    <input class="form-control" type="text" name="video_url" id="video_url" placeholder="YouTube URL">
				  </div>
				</div>
				<button type="submit" class="btn btn-primary">Add Video</button>
                              </form>
                              <?php } ?>
                              <?php while ($video = $videos_stmt->fetch()) { ?>
                              	<p style="margin: 5px 0px 0px 0px;"><?php echo $video['description'] ?></p>
                              	<?php $mod_video_url = str_replace("youtu.be", "www.youtube.com/embed", $video['video_url']) ?>
                                <iframe width="560" height="315" style="margin: 10px 0;" src="<?php echo $mod_video_url ?>" frameborder="0" allowfullscreen></iframe>
                      	        <?php if ( is_user_logged_in() ) { ?>
                      	          <a href="/app/players/delete_video.php?player_id=<?php echo $player_id ?>&id=<?php echo $video['id'] ?>"
                      	             method="delete"
                      	             class="btn btn-danger">Delete</a>
                      	        <?php } ?>
                                <hr>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div> <!-- col-md-8 -->
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- .entry-content -->
          </div><!-- .inside-article -->
        </article>
      <?php do_action('generate_after_main_content'); ?>
    </main><!-- #main -->
  </div><!-- #primary -->
  
  <script src="/wp-content/themes/generatepress/js/jquery-1.12.4.min.js"></script>
  <script src="/wp-content/themes/generatepress/js/aws/aws-sdk.min.js"></script>
  <script src="/wp-content/themes/generatepress/js/photo_uploader.js"></script>
<?php
do_action('generate_sidebars');
get_footer();
