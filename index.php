<?php get_header(); ?>

<section class="hero-section">
    <div class="hero-wrapper">
        <div class="hero-bg"></div>

        <!-- static hero image: 1.png -->
        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/1.png' ); ?>"
             class="hero-illust"
             alt="바로빌 캐릭터">

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
