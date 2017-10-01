<?php
/**
 * Template Name: Player New
 *
 * @package GeneratePress
 */
  $team_id = $_GET['team_id'];

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  $team_stmt = $pdo->prepare("SELECT * FROM teams WHERE id = :team_id LIMIT 1");
  $team_stmt->bindParam(':team_id', $team_id);
  $team_stmt->execute();
  $team = $team_stmt->fetch(PDO::FETCH_OBJ);

  $players_stmt = $pdo->prepare("SELECT p.id, p.name, p.year, p.school, GROUP_CONCAT(t.name SEPARATOR ',') as teams FROM rosters r
join players p on r.player_id = p.id
join teams t on r.team_id = t.id
GROUP BY p.id");
  $players_stmt->execute();

  Database::disconnect();

  get_header(); 
?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 0px;
    }
    .dataTables_filter {
      margin-bottom: 5px;
    }
  </style>
  <div id="primary" <?php generate_content_class();?>>
    <main id="main" <?php generate_main_class(); ?>>
    <?php do_action('generate_before_main_content'); ?>
      <article id="post-1009" class="post-1009 page type-page status-publish hentry" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
        <div class="inside-article">

          <header class="entry-header">
            <div class="row"
              >&nbsp;<a id="breadcrumb-team" href="/teams/show/?team_id=<?php echo $team_id ?>">Team Profile</a>&nbsp; > Add Player
            </div>
            <br>
            <h1 class="entry-title" itemprop="headline">Add Player to <?php echo $team->name." - ".$team->coach ?></h1>
          </header><!-- .entry-header -->
          <form action="/app/rosters/update.php" method="POST">
            <input type="hidden" name="team_id" value="<?php echo $team->id ?>">
            <div class="row">
    	      <div class="col-md-10"></div>
              <div class="col-md-2">
              <span class="pull-right"><input type="submit" class="btn btn-success" style="margin: 5px 0" value="Add Players"></span>
              </div>
            </div>
            <table id="team-table" class="table table-striped">
          	<thead>
                    <tr style="background-color: #537bac; color: #fff;">
                      <th>Name</th>
                      <th>School</th>
                      <th>Year</th>
                      <th>Teams</th>
                      <th></th>
                    </tr>
		</thead>
                <tbody>
                    <?php while ($row = $players_stmt->fetch()) { ?>
                    <tr>
                      <?php $player_link = '/teams/players/show/?player_id='.$row['id']; ?>
                      <td><a href="<?php echo $player_link; ?>"><?php echo $row['name']; ?></a></td>
                      <td><?php echo $row['school']; ?></td>
                      <td><?php echo $row['year']; ?></td>
                      <td><?php echo $row['teams']; ?></td>
                      <td class="text-center">
                        <?php
                          if ( is_user_logged_in() ) {
                        ?>
                          <div class="form-check">
			    <label class="form-check-label">
			      <input class="form-check-input" name="player_ids[]" type="checkbox" value="<?php echo $row['id'] ?>">
			    </label>
			  </div>
                        <?php
                          }
                        ?>
                      </td>
                    </tr>
                    <?php } ?>
		</tbody>
	  </table>
	</form>

          <div class="entry-content" itemprop="text">
            <div id="player-profile">
              <h1 class="entry-title" itemprop="headline">New Player for <?php echo $team->name." - ".$team->coach ?></h1>
              <div>
                <!-- Default panel contents -->

                <div id="new-player-form" style="padding: 10px; margin-bottom: 10px;">
                  <div class="row">
                    <div class="col-md-9">
                      <form class="form-horizontal" action="/app/players/create.php" method="post">
                        <input type="hidden" name="team_id" value="<?php echo $team_id ?>">
                        <div class="form-group">
                          <label for="player-number" class="col-sm-2 control-label">Number</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" placeholder="Number">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-name" class="col-sm-2 control-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-height" class="col-sm-2 control-label">Height</label>
                          <div class="col-sm-10">
                            <input type="text" class="input-mini" name="height_feet" placeholder="Feet" ng-model="player.height_feet">
                            <input type="text" class="input-mini" name="height_inches" placeholder="Inches">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-position" class="col-sm-2 control-label">Position</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="position" placeholder="Position">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-school" class="col-sm-2 control-label">School</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="school" placeholder="School">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-year" class="col-sm-2 control-label">Year</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="graduating_year" placeholder="Graduating Year">
                              <option value="2026">2026</option>
                              <option value="2025">2025</option>
                              <option value="2024">2024</option>
                              <option value="2023">2023</option>
                              <option value="2022">2022</option>
                              <option value="2021">2021</option>
                              <option value="2020">2020</option>
                              <option value="2019">2019</option>
                              <option value="2018">2018</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-gpa" class="col-sm-2 control-label">GPA</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="gpa" placeholder="GPA">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-athletic_accomplishments" class="col-sm-2 control-label">Athletic Acc.</label>
                          <div class="col-sm-10">
                            <textarea rows="4" ui-tinymce class="form-control" placeholder="Athletic Accomplishments" name="athletic_accomplishments"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="player-colleges_interested" class="col-sm-2 control-label">Colleges Interested</label>
                          <div class="col-sm-10">
                            <textarea rows="4" class="form-control" ui-tinymce placeholder="Colleges Interested" name="colleges_interested"></textarea>
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

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
jQuery(function(){
    jQuery('#team-table').DataTable({
    });
    //jQuery('div.dataTables_paginate .paginate_button').addClass('form-control');
    //jQuery('div.dataTables_filter').addClass('form-group');
});
</script>

<?php
do_action('generate_sidebars');
get_footer();
