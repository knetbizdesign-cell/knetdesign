<?php get_header(); ?>

<section class="hero-section">
    <div class="hero-wrapper">
        <div class="hero-bg"></div>

        <?php
        // featured image from latest post for hero illustration
        $borobill_hero_src = get_template_directory_uri() . '/images/1.png';
        $borobill_hero_alt = '바로빌 캐릭터';

        $borobill_hero_query = new WP_Query(
            array(
                'posts_per_page' => 1,
                'post_status'    => 'publish',
            )
        );

        if ( $borobill_hero_query->have_posts() ) {
            while ( $borobill_hero_query->have_posts() ) {
                $borobill_hero_query->the_post();
                if ( has_post_thumbnail() ) {
                    $borobill_hero_src = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    $borobill_hero_alt = get_the_title();
                }
            }
            wp_reset_postdata();
        }
        ?>

        <img src="<?php echo esc_url( $borobill_hero_src ); ?>"
             class="hero-illust"
             alt="<?php echo esc_attr( $borobill_hero_alt ); ?>">

        <div class="hero-content">
            <div class="hero-badge">안녕하세요. 바로빌 블로그에 오신 걸 환영합니다.</div>

            <h1 class="hero-title">바로빌과 함께하는 스마트백 오피스 실무</h1>

            <div class="hero-indicators">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>
</section>

<div class="layout">

    <?php get_template_part('template-parts/recommended'); ?>
    <?php get_template_part('template-parts/category-filter'); ?>
    <?php get_template_part('template-parts/main-list'); ?>
    <?php get_template_part('template-parts/banner'); ?>

</div>

<?php get_footer(); ?>
