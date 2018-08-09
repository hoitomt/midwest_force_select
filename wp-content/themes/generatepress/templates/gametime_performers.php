<?php
/**
 * Template Name: Gametime Performers
 *
 * @package GeneratePress
 */

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  $box_scores_2017_stmt = $pdo->prepare("SELECT p.name as name, p.school as school, p.team_id as team_id, bs.opponent as opponent, bs.date as date, bs.player_id as player_id, bs.total_points as total_points FROM box_scores bs JOIN players p on bs.player_id = p.id WHERE bs.date > '2017-11-01' AND bs.date < '2018-04-01' AND p.active = true ORDER BY total_points DESC");
  $box_scores_2017_stmt->execute();

  $box_scores_november_stmt = $pdo->prepare("SELECT p.name as name, p.school as school, p.team_id as team_id, bs.opponent as opponent, bs.date as date, bs.player_id as player_id, bs.total_points as total_points FROM box_scores bs JOIN players p on bs.player_id = p.id WHERE bs.date > '2017-11-01' AND bs.date < '2017-11-30' AND p.active = true ORDER BY total_points DESC");
  $box_scores_november_stmt->execute();

  $box_scores_december_stmt = $pdo->prepare("SELECT p.name as name, p.school as school, p.team_id as team_id, bs.opponent as opponent, bs.date as date, bs.player_id as player_id, bs.total_points as total_points FROM box_scores bs JOIN players p on bs.player_id = p.id WHERE bs.date > '2017-12-01' AND bs.date < '2017-12-31' AND p.active = true ORDER BY total_points DESC");
  $box_scores_december_stmt->execute();

  $box_scores_january_stmt = $pdo->prepare("SELECT p.name as name, p.school as school, p.team_id as team_id, bs.opponent as opponent, bs.date as date, bs.player_id as player_id, bs.total_points as total_points FROM box_scores bs JOIN players p on bs.player_id = p.id WHERE bs.date > '2018-01-01' AND bs.date < '2018-01-31' AND p.active = true ORDER BY total_points DESC");
  $box_scores_january_stmt->execute();

  $box_scores_february_stmt = $pdo->prepare("SELECT p.name as name, p.school as school, p.team_id as team_id, bs.opponent as opponent, bs.date as date, bs.player_id as player_id, bs.total_points as total_points FROM box_scores bs JOIN players p on bs.player_id = p.id WHERE bs.date > '2018-02-01' AND bs.date < '2018-02-29' AND p.active = true ORDER BY total_points DESC");
  $box_scores_february_stmt->execute();

  $box_scores_march_stmt = $pdo->prepare("SELECT p.name as name, p.school as school, p.team_id as team_id, bs.opponent as opponent, bs.date as date, bs.player_id as player_id, bs.total_points as total_points FROM box_scores bs JOIN players p on bs.player_id = p.id WHERE bs.date > '2018-03-01' AND bs.date < '2018-03-31' AND p.active = true ORDER BY total_points DESC");
  $box_scores_march_stmt->execute();
  
  $box_scores_2016_stmt = $pdo->prepare("SELECT p.name as name, p.school as school, p.team_id as team_id, bs.opponent as opponent, bs.date as date, bs.player_id as player_id, bs.total_points as total_points FROM box_scores bs JOIN players p on bs.player_id = p.id WHERE bs.date > '2016-11-01' AND bs.date < '2017-04-01' AND p.active = true ORDER BY total_points DESC");
  $box_scores_2016_stmt->execute();

  Database::disconnect();

  get_header();
?>
  <div id="primary" <?php generate_content_class();?>>
    <main id="main" <?php generate_main_class(); ?>>
      <?php do_action('generate_before_main_content'); ?>
        <article id="post-1009" class="post-1009 page type-page status-publish hentry" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
          <div class="inside-article">

            <header class="entry-header">
              <h1 class="entry-title" itemprop="headline">Gametime Performers</h1>
            </header><!-- .entry-header -->

            <div class="entry-content" itemprop="text">
              <div id="team-profile">
                <div>
                  <?php
                    if ( is_user_logged_in() ) {
                  ?>
                  <div style="margin-bottom: 10px;">
                    <a href="/gametime-performers/new" class="btn btn-success">Add Gametime Performance</a>
                  </div>
                  <?php
                    }
                  ?>
                  <img src="http://www.midwestforceselect.com/wp-content/uploads/2017/01/gt_performers_header.png" alt="bauhaus" width="1024" class="alignnone size-full wp-image-577" style="margin-bottom: 10px;" />

		  <ul id="monthTabs" class="nav nav-tabs" role="tablist" style="margin-left: 0px;">
		  	<li role="presentation" class="active"><a href="#season" aria-controls="home" role="tab" data-toggle="tab">Season</a></li>
		  	<li role="presentation"><a href="#november" role="tab" data-toggle="tab">November</a></li>
		  	<li role="presentation"><a href="#december" role="tab" data-toggle="tab">December</a></li>
		  	<li role="presentation"><a href="#january" role="tab" data-toggle="tab">January</a></li>
		  	<li role="presentation"><a href="#february" role="tab" data-toggle="tab">February</a></li>
		  	<li role="presentation"><a href="#march" role="tab" data-toggle="tab">March</a></li>
		  	<li role="presentation"><a href="#last-season" role="tab" data-toggle="tab">2016-2017 Season</a></li>
		  </ul>
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="season">
		      <div id="results-table">
  			<table id="gametime-performers" class="table table-striped">
			  <tr>
			    <th>Name</th>
			    <th>School</th>
			    <th>Date</th>
			    <th>Opponent</th>
			    <th>Points</th>
			  </tr>
			  <?php while ($row = $box_scores_2017_stmt->fetch()) { ?>
                            <tr>
                              <td><a href="/teams/players/show/?player_id=<?php echo $row['player_id']; ?>&team_id=<?php echo $row['team_id']; ?>"><?php echo $row['name']; ?></a></td>
                              <td><?php echo $row['school']; ?></td>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['opponent']; ?></td>
                              <td><?php echo $row['total_points']; ?></td>
                            </tr>
		          <?php } ?>
  			</table>
		      </div><!-- #results-table -->
		    </div>
		    <div role="tabpanel" class="tab-pane" id="november">
		      <div id="results-table">
  			<table id="gametime-performers" class="table table-striped">
			  <tr>
			    <th>Name</th>
			    <th>School</th>
			    <th>Date</th>
			    <th>Opponent</th>
			    <th>Points</th>
			  </tr>
			  <?php while ($row = $box_scores_november_stmt->fetch()) { ?>
                            <tr>
                              <td><a href="/teams/players/show/?player_id=<?php echo $row['player_id']; ?>&team_id=<?php echo $row['team_id']; ?>"><?php echo $row['name']; ?></a></td>
                              <td><?php echo $row['school']; ?></td>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['opponent']; ?></td>
                              <td><?php echo $row['total_points']; ?></td>
                            </tr>
		          <?php } ?>
  			</table>
		      </div><!-- #results-table -->
		    </div>
		    <div role="tabpanel" class="tab-pane" id="december">
		      <div id="results-table">
  			<table id="gametime-performers" class="table table-striped">
			  <tr>
			    <th>Name</th>
			    <th>School</th>
			    <th>Date</th>
			    <th>Opponent</th>
			    <th>Points</th>
			  </tr>
			  <?php while ($row = $box_scores_december_stmt->fetch()) { ?>
                            <tr>
                              <td><a href="/teams/players/show/?player_id=<?php echo $row['player_id']; ?>&team_id=<?php echo $row['team_id']; ?>"><?php echo $row['name']; ?></a></td>
                              <td><?php echo $row['school']; ?></td>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['opponent']; ?></td>
                              <td><?php echo $row['total_points']; ?></td>
                            </tr>
		          <?php } ?>
  			</table>
		      </div><!-- #results-table -->
		    </div>
		    <div role="tabpanel" class="tab-pane" id="january">
		      <div id="results-table">
  			<table id="gametime-performers" class="table table-striped">
			  <tr>
			    <th>Name</th>
			    <th>School</th>
			    <th>Date</th>
			    <th>Opponent</th>
			    <th>Points</th>
			  </tr>
			  <?php while ($row = $box_scores_january_stmt->fetch()) { ?>
                            <tr>
                              <td><a href="/teams/players/show/?player_id=<?php echo $row['player_id']; ?>&team_id=<?php echo $row['team_id']; ?>"><?php echo $row['name']; ?></a></td>
                              <td><?php echo $row['school']; ?></td>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['opponent']; ?></td>
                              <td><?php echo $row['total_points']; ?></td>
                            </tr>
		          <?php } ?>
  			</table>
		      </div><!-- #results-table -->
		    </div>
		    <div role="tabpanel" class="tab-pane" id="february">
		      <div id="results-table">
  			<table id="gametime-performers" class="table table-striped">
			  <tr>
			    <th>Name</th>
			    <th>School</th>
			    <th>Date</th>
			    <th>Opponent</th>
			    <th>Points</th>
			  </tr>
			  <?php while ($row = $box_scores_february_stmt->fetch()) { ?>
                            <tr>
                              <td><a href="/teams/players/show/?player_id=<?php echo $row['player_id']; ?>&team_id=<?php echo $row['team_id']; ?>"><?php echo $row['name']; ?></a></td>
                              <td><?php echo $row['school']; ?></td>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['opponent']; ?></td>
                              <td><?php echo $row['total_points']; ?></td>
                            </tr>
		          <?php } ?>
  			</table>
		      </div><!-- #results-table -->
		    </div>
		    <div role="tabpanel" class="tab-pane" id="march">
		      <div id="results-table">
  			<table id="gametime-performers" class="table table-striped">
			  <tr>
			    <th>Name</th>
			    <th>School</th>
			    <th>Date</th>
			    <th>Opponent</th>
			    <th>Points</th>
			  </tr>
			  <?php while ($row = $box_scores_march_stmt->fetch()) { ?>
                            <tr>
                              <td><a href="/teams/players/show/?player_id=<?php echo $row['player_id']; ?>&team_id=<?php echo $row['team_id']; ?>"><?php echo $row['name']; ?></a></td>
                              <td><?php echo $row['school']; ?></td>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['opponent']; ?></td>
                              <td><?php echo $row['total_points']; ?></td>
                            </tr>
		          <?php } ?>
  			</table>
		      </div><!-- #results-table -->
		    </div>
		    <div role="tabpanel" class="tab-pane" id="last-season">
		      <div id="results-table">
  			<table id="gametime-performers" class="table table-striped">
			  <tr>
			    <th>Name</th>
			    <th>School</th>
			    <th>Date</th>
			    <th>Opponent</th>
			    <th>Points</th>
			  </tr>
			  <?php while ($row = $box_scores_2016_stmt->fetch()) { ?>
                            <tr>
                              <td><a href="/teams/players/show/?player_id=<?php echo $row['player_id']; ?>&team_id=<?php echo $row['team_id']; ?>"><?php echo $row['name']; ?></a></td>
                              <td><?php echo $row['school']; ?></td>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['opponent']; ?></td>
                              <td><?php echo $row['total_points']; ?></td>
                            </tr>
		          <?php } ?>
  			</table>
		      </div><!-- #results-table -->
		    </div>
		  </div>
                </div>
              </div><!-- #team-profile -->
            </div><!-- .entry-content -->
          </div><!-- .inside-article -->
        </article>
      <?php do_action('generate_after_main_content'); ?>
    </main><!-- #main -->
  </div><!-- #primary -->
  
<script>
  jQuery('#monthTabs a').click(function (e) {
    console.log("Clicked a tab");
    e.preventDefault();
    jQuery(this).tab('show');
  });
</script>
<?php
do_action('generate_sidebars');
get_footer();
