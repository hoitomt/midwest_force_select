<?php
/**
 * Template Name: Player Edit
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
  
  $roster_stmt = $pdo->prepare("SELECT * FROM rosters WHERE player_id = :player_id order by id DESC limit 1");
  $roster_stmt->bindParam(':player_id', $player_id);

  $roster_stmt->execute();
  $roster = $roster_stmt->fetch(PDO::FETCH_OBJ);

  Database::disconnect();
  
  $team_id = $_GET['team_id'] ?: $roster->team_id;
  
  get_header();

?>

  <div id="primary" <?php generate_content_class();?>>
    <main id="main" <?php generate_main_class(); ?>>
    <?php do_action('generate_before_main_content'); ?>
      <article id="post-1009" class="post-1009 page type-page status-publish hentry" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
        <div class="inside-article">

          <header class="entry-header">
            <div class="row"
              >&nbsp;<a id="breadcrumb-team" href="/teams/show/?team_id=<?php echo $team_id ?>">Team Profile</a>&nbsp; > <?php echo $player->name ?>
            </div>
            <br>
            <h1 class="entry-title" itemprop="headline"><?php echo $player->name ?></h1>
          </header><!-- .entry-header -->

          <div class="entry-content" itemprop="text">
            <div id="player-profile">
              <div>
                <!-- Default panel contents -->

                <div id="new-player-form" style="padding: 10px; margin-bottom: 10px;">
                  <div class="row">
                    <div class="col-md-9">
                      <form class="form-horizontal" action="/app/players/update.php" method="post">
                        <input type="hidden" name="team_id" value="<?php echo $team_id ?>">
                        <input type="hidden" name="player_id" value="<?php echo $player_id ?>">
                        <div class="form-group">
                          <label for="player-number" class="col-sm-2 control-label">Number</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" placeholder="Number" value="<?php echo $player->number ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-name" class="col-sm-2 control-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $player->name ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-height" class="col-sm-2 control-label">Height</label>
                          <div class="col-sm-10">
                            <input type="text" class="input-mini" name="height_feet" placeholder="Feet" ng-model="player.height_feet" value="<?php echo $player->height_feet ?>">
                            <input type="text" class="input-mini" name="height_inches" placeholder="Inches" value="<?php echo $player->height_inches ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-position" class="col-sm-2 control-label">Position</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="position" placeholder="Position" value="<?php echo $player->position ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-school" class="col-sm-2 control-label">School</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="school" placeholder="School" value="<?php echo $player->school ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-year" class="col-sm-2 control-label">Year</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="graduating_year" placeholder="Graduating Year">
                              <?php
                                $graduating_year_array = array("2026", "2025", "2024", "2023", "2022", "2021", "2020", "2019", "2018");
                                foreach ($graduating_year_array as $year)
                                  if($year == $player->year) {
                                    echo "<option value=".$year." selected>".$year."</option>";
                                  } else {
                                    echo "<option value=".$year.">".$year."</option>";
                                  }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-gpa" class="col-sm-2 control-label">GPA</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="gpa" placeholder="GPA" value="<?php echo $player->gpa ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-athletic_accomplishments" class="col-sm-2 control-label">Athletic Acc.</label>
                          <div class="col-sm-10">
                            <textarea rows="4" ui-tinymce class="form-control" placeholder="Athletic Accomplishments" name="athletic_accomplishments"><?php echo $player->athletic_accomplishments ?></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-colleges_interested" class="col-sm-2 control-label">Colleges Interested</label>
                          <div class="col-sm-10">
                            <textarea rows="4" class="form-control" ui-tinymce placeholder="Colleges Interested" name="colleges_interested"><?php echo $player->colleges_interested ?></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn">Save</button>
                            <a href="/teams/show/?team_id=<?php echo $team_id ?>" class="btn btn-danger">Cancel</a>
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

          </div><!-- .entry-content -->
        </div><!-- .inside-article -->
      </article>
    <?php do_action('generate_after_main_content'); ?>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
do_action('generate_sidebars');
get_footer();
