<?php
/**
 * Single Post Template (Figma 완성형)
 */

get_header();
?>

<div class="layout"> <!-- ★ index.php와 동일한 중앙 레이아웃 유지 -->

<main class="single-post-main">
    <div class="container">

        <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>

            <!-- ★ 카테고리 배지 (index.php 규칙과 동일 색상) -->
            <header class="post-header">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) {

                    $category_name = $categories[0]->name;

                    // index.php 스타일과 동일한 배경/텍스트 컬러 규칙
                    $bg = '#e4e8ed';
                    $text = '#2d4a62';

                    if ($category_name === '사업자 뉴스룸') {
                        $bg = '#e4e9ff';
                        $text = '#5659e1';
                    } elseif ($category_name === '세무회계') {
                        $bg = '#e1eaf3';
                        $text = '#336fae';
                    }

                    echo '<span class="post-category" style="background:' . $bg . '; color:' . $text . ';">'
                         . esc_html($category_name) .
                         '</span>';
                }
                ?>

                <!-- 제목 -->
                <h1 class="post-title"><?php the_title(); ?></h1>

                <!-- 날짜 / 작성자 -->
                <div class="post-meta">
                    <span class="post-date"><?php echo borobill_post_date(); ?></span>
                    <span class="post-author">작성자: <?php the_author(); ?></span>
                </div>
            </header>

            <!-- 썸네일 -->
            <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('large'); ?>
            </div>
            <?php endif; ?>

            <!-- 본문 -->
            <div class="post-content">
                <?php the_content(); ?>
            </div>

            <!-- 태그 -->
            <footer class="post-footer">
                <div class="post-tags">
                    <?php
                    $tags = get_the_tags();
                    if ($tags) {
                        foreach ($tags as $tag) {
                            echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag"># ' . esc_html($tag->name) . '</a>';
                        }
                    }
                    ?>
                </div>
            </footer>

        </article>

        <!-- 이전 글 / 다음 글 -->
        <nav class="post-navigation">
            <div class="nav-previous"><?php previous_post_link('%link', '← 이전 글'); ?></div>
            <div class="nav-next"><?php next_post_link('%link', '다음 글 →'); ?></div>
        </nav>

        <?php endwhile; ?>

    </div>
</main>

</div> <!-- layout 끝 -->

<?php get_footer(); ?>

