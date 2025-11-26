<?php
/**
 * 카테고리 필터 탭
 *
 * 실제 필터 동작은 js/main.js 와 .article-card[data-category] 속성을 사용.
 */

$categories = get_categories( [
    'hide_empty' => false,
] );
?>

<section class="section section-filter">
    <div class="section-inner">
        <div class="filter-wrap">
            <button class="filter-item active" data-category="all">전체</button>
            <?php foreach ( $categories as $cat ) : ?>
                <button class="filter-item"
                        data-category="<?php echo esc_attr( $cat->slug ); ?>">
                    <?php echo esc_html( $cat->name ); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>


