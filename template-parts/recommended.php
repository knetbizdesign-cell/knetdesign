<?php
/**
 * 추천 게시물 섹션
 */

// "추천" 카테고리(또는 임의의 주요 포스트) 3개 노출
$featured_query = new WP_Query([
    'posts_per_page' => 3,
    'ignore_sticky_posts' => true,
]);

// 추천 카드 전용 기본 이미지 매핑 (2, 3, 4번 이미지를 순서대로 사용)
$borobill_featured_fallbacks = [
    1 => '2.png',
    2 => '3.png',
    3 => '4.png',
];
$borobill_featured_index = 1;
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
                <button type="submit" class="search-icon-btn" aria-label="검색">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/search.png' ); ?>"
                         alt="검색 아이콘">
                </button>
            </form>
        </div>

        <div class="featured-grid">
            <?php
            // 실제 출력된 카드 개수 카운트
            $borobill_card_count = 0;

            if ( $featured_query->have_posts() ) :
                while ( $featured_query->have_posts() ) :
                    $featured_query->the_post();
                    $borobill_card_count++;
                    ?>
                    <article class="featured-card">
                        <a href="<?php the_permalink(); ?>" class="featured-thumb-wrap">
                            <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium_large', [
                                    'class' => 'featured-thumb',
                                    'alt'   => esc_attr( get_the_title() ),
                                ] );
                            } else {
                                // 지정된 2.png, 3.png, 4.png 이미지를 순서대로 사용
                                $fallback_key = isset( $borobill_featured_fallbacks[ $borobill_featured_index ] )
                                    ? $borobill_featured_index
                                    : 1;
                                $fallback_src = get_template_directory_uri() . '/images/' . $borobill_featured_fallbacks[ $fallback_key ];
                                $borobill_featured_index++;
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
            <?php endif; ?>

            <?php
            // 항상 3장의 카드가 보이도록, 부족한 개수만큼 플레이스홀더 카드 추가
            for ( $i = $borobill_card_count + 1; $i <= 3; $i++ ) :
                $fallback_key = isset( $borobill_featured_fallbacks[ $borobill_featured_index ] )
                    ? $borobill_featured_index
                    : 1;
                $fallback_src = get_template_directory_uri() . '/images/' . $borobill_featured_fallbacks[ $fallback_key ];
                $borobill_featured_index++;
                ?>
                <article class="featured-card featured-card--placeholder">
                    <div class="featured-thumb-wrap">
                        <img src="<?php echo esc_url( $fallback_src ); ?>"
                             class="featured-thumb"
                             alt="추천 게시물 이미지">
                    </div>
                    <div class="featured-meta">
                        <span class="badge badge-small">바로빌 가이드</span>
                        <span class="meta-date"><?php echo esc_html( date( 'Y.m.d' ) ); ?></span>
                    </div>
                    <h3 class="featured-title">추천 게시물을 준비 중입니다.</h3>
                </article>
            <?php endfor; ?>
        </div>
    </div>
</section>


