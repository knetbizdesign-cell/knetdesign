<?php
/**
 * 메인 게시글 리스트
 *
 * 메인 쿼리(loop)를 사용하여 이미지와 같이 카드 + 썸네일 형태로 출력.
 */
?>

<section class="section section-list">
    <div class="section-inner">
        <div class="post-list">
            <?php
            // 썸네일이 없을 때 사용할 테마 기본 이미지 (1~10.png 순환)
            $borobill_list_thumb_index = 4; // 추천 영역 1~3 사용 가정, 리스트는 4부터
            $borobill_list_thumb_max   = 10;
            ?>

            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                    $cats = get_the_category();
                    $primary_cat_slug = $cats ? $cats[0]->slug : 'etc';
                    ?>
                    <article class="article-card"
                             data-category="<?php echo esc_attr( $primary_cat_slug ); ?>">
                        <div class="article-info">
                            <div class="article-meta">
                                <span class="badge badge-small">
                                    <?php echo $cats ? esc_html( $cats[0]->name ) : '카테고리'; ?>
                                </span>
                                <span class="meta-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></span>
                            </div>
                            <h3 class="article-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>

                        <div class="article-thumb-wrap">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'medium_large', [
                                        'class' => 'article-thumb',
                                        'alt'   => esc_attr( get_the_title() ),
                                    ] );
                                } else {
                                    $fallback_src = get_template_directory_uri() . '/images/' . $borobill_list_thumb_index . '.png';
                                    $borobill_list_thumb_index++;
                                    if ( $borobill_list_thumb_index > $borobill_list_thumb_max ) {
                                        $borobill_list_thumb_index = 4;
                                    }
                                    ?>
                                    <img src="<?php echo esc_url( $fallback_src ); ?>"
                                         class="article-thumb"
                                         alt="<?php echo esc_attr( get_the_title() ); ?>" />
                                    <?php
                                }
                                ?>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="section-empty">게시물이 아직 없습니다. 관리자에서 글을 추가해 주세요.</p>
            <?php endif; ?>
        </div>

        <div class="section-more">
            <?php
            the_posts_pagination( [
                'mid_size'  => 1,
                'prev_text' => '이전',
                'next_text' => '다음',
            ] );
            ?>
        </div>
    </div>
</section>


