<div class="search-form">
<form method="get" id="searchform" action="<?php home_url(); ?>">
	<div>
	<label class="hidden" for="s"></label>
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="search-form-input" />
	<input type="submit" id="searchsubmit" value="Search" class="search_button" />
	</div>
</form>
</div>