<?php
/**
 * Template Name: Tournament New
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
     	  <?php if ( generate_show_title() ) : ?>
	    <header class="entry-header">
	      <?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
            </header><!-- .entry-header -->
	  <?php endif; ?>
          <div class="entry-content" itemprop="text">
            <div class="row">
              <div class="col-md-9">
		<h2>Register</h2>
                <form class="form-horizontal stripe-registration">
                  <div class="form-group">
                    <label for="club_name" class="col-sm-2 control-label">Club Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="club_name" id="club_name" placeholder="Club Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email_address" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email_address" id="email_address" placeholder="Email Address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="team" class="col-sm-2 control-label">Team</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="team_name" placeholder="Team">
                      	<option selected></option>
                        <option value="17U">17U</option>
                        <option value="16U">16U</option>
                        <option value="15U">15U</option>
                        <option value="14U">14U</option>
                        <option value="13U">13U</option>
                        <option value="12U">12U</option>
                        <option value="11U">11U</option>
                        <option value="10U">10U</option>
                        <option value="9U">9U</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="registration_fee" class="col-sm-2 control-label">Fee</label>
                    <div class="col-sm-10">
                    	$225 (until February 1st, 2018)
                      <input type="hidden" class="form-control" name="registration_fee" id="registration_fee" value="225">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-1">
                      <button class="btn btn-success stripe-registration">Register</button>
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
    
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="/wp-content/themes/generatepress/js/stripe-registration.js"></script>
  </div><!-- #primary -->
<?php
do_action('generate_sidebars');
get_footer();
