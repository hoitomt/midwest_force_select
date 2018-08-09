<?php
/**
 * Template Name: Gametime Performer New
 *
 * @package GeneratePress
 */
  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $players_stmt = $pdo->prepare("SELECT p.* from players p WHERE CONVERT(p.year, UNSIGNED INTEGER) <= 2021 AND CONVERT(p.year, UNSIGNED INTEGER) >= 2018 ORDER BY p.name");
  $players_stmt->execute();
  
  Database::disconnect();

  get_header(); 
?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
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
          >&nbsp;<a id="breadcrumb" href="/gametime-performers/">gametime performers</a>&nbsp; > &nbsp; New
        </div>
        <br>
        <h1 class="entry-title" itemprop="headline">Add Gametime Performance</h1>
      </header><!-- .entry-header -->
      <div class="entry-content" itemprop="text">
        <div class="row">
          <div class="col-md-9">
            <form class="form-horizontal" id="new_box_score" action="/app/box_scores/create.php" accept-charset="UTF-8" method="post">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="assists">Player</label>
                <div class="col-sm-7">
                  <select class="form-control" name="player_id" id="player_id">
                    <option value="0"></option>
	            <?php while ($row = $players_stmt->fetch()) { ?>
	              <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
	            <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="game">Game</label>
                <div class="col-sm-3">
                  <input type="text" name="date" id="date" placeholder="Date" class="datepicker form-control" data-provide="datepicker">
                </div>
                <div class="col-sm-4">
                  <input type="text" name="opponent" id="opponent" placeholder="Opponent" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="total_points">Total points</label>
                <div class="col-sm-2">
                  <input placeholder="Total" class="form-control" type="text" name="total_points" id="total_points">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="assists">Assists</label>
                <div class="col-sm-2">
                  <input placeholder="Assists" class="form-control" type="text" name="assists" id="assists">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="rebounds">Rebounds</label>
                <div class="col-sm-2">
                  <input placeholder="Reb." class="form-control" type="text" name="rebounds" id="rebounds">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-2">Makes</div>
                <div class="col-sm-2">Attempts</div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="two_point_attempt">Two Point Field Goals</label>
                <div class="col-sm-2">
                  <input placeholder="Makes" class="form-control" type="text" name="two_point_make" id="two_point_make">
                </div>
                <div class="col-sm-2">
                  <input placeholder="Att." class="form-control" type="text" name="two_point_attempt" id="two_point_attempt">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="three_point_attempt">Three Point Field Goals</label>
                <div class="col-sm-2">
                  <input placeholder="Makes" class="form-control" type="text" name="three_point_make" id="three_point_make">
                </div>
                <div class="col-sm-2">
                  <input placeholder="Att." class="form-control" type="text" name="three_point_attempt" id="three_point_attempt">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="one_point_attempt">Free Throws</label>
                <div class="col-sm-2">
                  <input placeholder="Makes" class="form-control" type="text" name="one_point_make" id="one_point_make">
                </div>
                <div class="col-sm-2">
                  <input placeholder="Att." class="form-control" type="text" name="one_point_attempt" id="one_point_attempt">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a class="btn btn-danger" href="/gametime-performers/">Cancel</a>
                </div>
              </div>
            </form>            
          </div> <!-- col-md-9 -->
        </div>
      </div><!-- .entry-content -->
    </div><!-- .inside-article -->
  </article>
  <?php do_action('generate_after_main_content'); ?>
</main><!-- #main -->
</div><!-- #primary -->
<script>
  jQuery('.datepicker').datepicker({
    autoclose: true
  });
</script>

<?php
do_action('generate_sidebars');
get_footer();
