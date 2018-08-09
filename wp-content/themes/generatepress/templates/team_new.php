<?php
/**
 * Template Name: Team New
 *
 * @package GeneratePress
 */
  get_header();
?>
  <div id="primary" <?php generate_content_class();?>>
    <main id="main" <?php generate_main_class(); ?>>
      <?php do_action('generate_before_main_content'); ?>
      <article class="page type-page status-publish hentry">
        <div class="inside-article">
          <header class="entry-header">
            <h1 class="entry-title" itemprop="headline">New Team</h1>
          </header>
          <div class="entry-content" itemprop="text">
            <div class="row">
              <div class="col-md-9">

                <form class="form-horizontal" action="/app/teams/create.php" method="POST">
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Team Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="coach" class="col-sm-2 control-label">Coach</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="coach" id="coach" placeholder="Coach">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="year" class="col-sm-2 control-label">Year</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="year" id="year" placeholder="Year">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-1">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                    <div class="col-sm-offset-1 col-sm-1">
                      <a href="/teams/index" class="btn btn-danger">Cancel</a>
                    </div>
                  </div>
                </form>
              </div> <!-- col-md-8 -->
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
