<?php
/**
 * Template Name: Team Index
 *
 * @package GeneratePress
 */

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $teams_stmt = $pdo->prepare("SELECT * FROM teams ORDER BY year DESC, name");
  $teams_stmt->execute();

  Database::disconnect();

  get_header();
?>
  <div id="primary" <?php generate_content_class();?>>
    <main id="main" <?php generate_main_class(); ?>>
      <?php do_action('generate_before_main_content'); ?>
      <article class="page type-page status-publish hentry">
        <div class="inside-article">
          <header class="entry-header">
            <h1 class="entry-title" itemprop="headline">Teams</h1>
          </header>
          <div class="entry-content" itemprop="text">
            <p>Teams are currently forming for the 2017 season, all interested players should fill out our Athlete Introduction Form.</p>
            <p><a href="http://goo.gl/forms/iShf41xwSNJerVKa2" class="btn btn-success" role="button">2017 Force Athlete Introduction</a></p>
            <?php
              if ( is_user_logged_in() ) {
            ?>
            <p><a href="/teams/new" class="btn btn-success" role="button">New Team</a></p>
            <table id="team-table" class="table table-striped">
              <thead>
              <tr style="background-color: #537bac; color: #fff;">
                <th>Name</th>
                <th>Coach</th>
                <th>Year Played</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              <?php while ($row = $teams_stmt->fetch()) { ?>
              <tr>
                <?php $team_link = '/teams/show/?team_id='.$row['id']; ?>
                <td><a href="<?php echo $team_link; ?>"><?php echo $row['name']; ?></a></td>
                <td><?php echo $row['coach']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td class="text-center">
                  <a href="<?php echo '/teams/edit/?team_id='.$row['id'];?>"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a href="<?php echo '/app/teams/delete.php?team_id='.$row['id'];?>" onclick="return confirm('<?php echo 'Are you sure you want to delete '.$row['name'] ?>')"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
              </tr>
              <?php } ?>
              </tbody>
            </table>
            <?php
              }
            ?> <!-- if logged in -->
          </div><!-- .entry-content -->
        </div><!-- .inside-article -->
      </article>
      <?php do_action('generate_after_main_content'); ?>
    </main><!-- #main -->
  </div><!-- #primary -->
<?php
do_action('generate_sidebars');
get_footer();