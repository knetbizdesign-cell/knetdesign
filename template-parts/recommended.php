<?php
/**
 * 추천 게시물 섹션
 */

// "추천" 카테고리(또는 임의의 주요 포스트) 3개 노출
$featured_query = new WP_Query([
    'posts_per_page' => 3,
    'ignore_sticky_posts' => true,
]);

// 썸네일이 없을 때 사용할 테마 기본 이미지 (1~10.png 순환)
$borobill_thumb_index = 1;
$borobill_thumb_max   = 10;
?>

<section class="section section-featured">
    <div class="section-inner">
        <div class="section-header">
            <h2 class="section-title">추천 게시물</h2>

            <form role="search"
                  method="get"
                  class="search-form section-search"
                  action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <label class="screen-reader-text" for="s">검색어</label>
                <input type="search"
                       id="s"
                       class="search-field"
                       placeholder="검색어를 입력해주세요"
                       value="<?php echo get_search_query(); ?>"
                       name="s" />
            </form>
        </div>

        <div class="featured-grid">
            <?php if ( $featured_query->have_posts() ) : ?>
                <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                    <article class="featured-card">
                        <a href="<?php the_permalink(); ?>" class="featured-thumb-wrap">
                            <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium_large', [
                                    'class' => 'featured-thumb',
                                    'alt'   => esc_attr( get_the_title() ),
                                ] );
                            } else {
                                $fallback_src = get_template_directory_uri() . '/images/' . $borobill_thumb_index . '.png';
                                $borobill_thumb_index++;
                                if ( $borobill_thumb_index > $borobill_thumb_max ) {
                                    $borobill_thumb_index = 1;
                                }
                                ?>
                                <img src="<?php echo esc_url( $fallback_src ); ?>"
                                     class="featured-thumb"
                                     alt="<?php echo esc_attr( get_the_title() ); ?>" />
                                <?php
                            }
                            ?>
                        </a>

                        <div class="featured-meta">
                            <span class="badge badge-small">
                                <?php
                                $cats = get_the_category();
                                echo $cats ? esc_html( $cats[0]->name ) : '카테고리';
                                ?>
                            </span>
                            <span class="meta-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></span>
                        </div>

                        <h3 class="featured-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="section-empty">아직 등록된 추천 게시물이 없습니다.</p>
            <?php endif; ?>
        </div>
    </div>
</section>


