<?php
/**
 * Template Name: Team Show
 *
 * @package GeneratePress
 */
  $team_id = $_GET['team_id'];

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $players_stmt = $pdo->prepare("SELECT r.id as roster_id, p.* FROM rosters r JOIN teams t on t.id = r.team_id JOIN players p on p.id = r.player_id WHERE t.id = :team_id ORDER BY p.number");
  $players_stmt->bindParam(':team_id', $team_id);
  $players_stmt->execute();

  $team_stmt = $pdo->prepare("SELECT * FROM teams WHERE id = :team_id LIMIT 1");
  $team_stmt->bindParam(':team_id', $team_id);
  $team_stmt->execute();
  $team = $team_stmt->fetch(PDO::FETCH_OBJ);

  Database::disconnect();
  
  $coach = $team->coach ? " - ".$team->coach : "";

  get_header();
?>
  <div id="primary" <?php generate_content_class();?>>
    <main id="main" <?php generate_main_class(); ?>>
      <?php do_action('generate_before_main_content'); ?>
        <article id="post-1009" class="post-1009 page type-page status-publish hentry" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
          <div class="inside-article">

            <header class="entry-header">
              <h1 class="entry-title" itemprop="headline"><?php echo $team->name.$coach ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content" itemprop="text">
              <div id="team-profile">
                <div>
                  <?php
                    if ( is_user_logged_in() ) {
                  ?>
                  <div style="margin-bottom: 10px;">
                    <a href="/teams/players/new?team_id=<?php echo $team_id ?>" class="btn btn-success">Add Player</a>
                  </div>
                  <?php
                    }
                  ?>
                  <table id="team-table" class="table table-striped">
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
                    <?php while ($row = $players_stmt->fetch()) { ?>
                    <tr>
                      <td class="text-center"><?php echo $row['number'] ?></td>
                      <?php $player_link = '/teams/players/show/?player_id='.$row['id'].'&team_id='.$team_id; ?>
                      <td><a href="<?php echo $player_link; ?>"><?php echo $row['name']; ?></a></td>
                      <td><?php echo $row['height_feet']."' ".$row['height_inches'].'"'; ?></td>
                      <td><?php echo $row['position']; ?></td>
                      <td><?php echo $row['school']; ?></td>
                      <td><?php echo $row['year']; ?></td>
                      <td class="text-center">
                        <?php
                          if ( is_user_logged_in() ) {
                        ?>
                          <a href="/teams/players/edit/?player_id=<?php echo $row['id'] ?>&team_id=<?php echo $team_id ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                          <a href="/app/rosters/delete.php/?roster_id=<?php echo $row['roster_id'] ?>&team_id=<?php echo $team_id ?>"><i class="glyphicon glyphicon-remove"></i></a>
                        <?php
                          }
                        ?>
                      </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div><!-- #team-profile -->
            </div><!-- .entry-content -->
          </div><!-- .inside-article -->
        </article>
      <?php do_action('generate_after_main_content'); ?>
    </main><!-- #main -->
  </div><!-- #primary -->
<?php
do_action('generate_sidebars');
get_footer();
