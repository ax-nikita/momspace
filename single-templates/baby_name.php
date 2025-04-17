<?php get_header(); ?>

<div class="theme-breadcrumb__Wrapper theme-breacrumb-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="theme-breacrumb-title"> <?php the_title(); ?></h1>
                <div class="breaccrumb-inner">
                </div>
            </div>
        </div>
    </div>
</div>

<section id="main-container" class="blog main-container">
    <div class="container container-baby-name">
        <?php the_content(); ?>
    </div>
</section>

<?php get_footer(); ?>