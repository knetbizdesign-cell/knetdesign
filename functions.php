<?php

function borobill_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption']);

    register_nav_menus([
        'primary' => 'Primary Menu',
    ]);
}
add_action('after_setup_theme', 'borobill_theme_setup');


function borobill_enqueue_assets() {
    wp_enqueue_style('pretendard', 'https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.min.css');
    wp_enqueue_style('borobill-style', get_stylesheet_uri(), [], '1.0');

    wp_enqueue_script('jquery');
    wp_enqueue_script('borobill-main', get_template_directory_uri() . '/js/main.js', ['jquery'], '1.0', true);
}
add_action('wp_enqueue_scripts', 'borobill_enqueue_assets');


function borobill_post_date() {
    return get_the_date('Y.m.d');
}


// 빠른편집: 특성이미지 필드 추가
function borobill_quick_edit_featured_image( $column_name, $post_type ) {
    // 우리 custom column 'thumbnail' 에만 출력
    if ( 'post' !== $post_type || 'thumbnail' !== $column_name ) {
        return;
    }
    ?>
    <fieldset class="inline-edit-col-right inline-edit-borobill-thumb">
        <div class="inline-edit-col">
            <label>
                <span class="title">특성이미지</span>
                <span class="input-text-wrap">
                    <img src="" class="borobill-qe-thumb" style="max-width:80px;max-height:80px;display:none;margin-bottom:6px;">
                    <button type="button" class="button borobill-set-thumb">이미지 선택</button>
                    <button type="button" class="button borobill-remove-thumb">제거</button>
                    <input type="hidden" name="borobill_qe_thumb_id" class="borobill-qe-thumb-id" value="">
                </span>
            </label>
        </div>
    </fieldset>
    <?php
}
add_action( 'quick_edit_custom_box', 'borobill_quick_edit_featured_image', 10, 2 );


// 빠른편집 저장 시 특성이미지 적용
function borobill_save_quick_edit_featured_image( $post_id ) {
    if ( ! isset( $_POST['borobill_qe_thumb_id'] ) ) {
        return;
    }

    $thumb_id = absint( $_POST['borobill_qe_thumb_id'] );

    if ( $thumb_id ) {
        set_post_thumbnail( $post_id, $thumb_id );
    } else {
        delete_post_thumbnail( $post_id );
    }
}
add_action( 'save_post', 'borobill_save_quick_edit_featured_image' );


// 빠른편집 특성이미지용 스크립트 로드
function borobill_admin_quick_edit_scripts( $hook ) {
    if ( 'edit.php' !== $hook ) {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script(
        'borobill-admin-quick-edit',
        get_template_directory_uri() . '/js/admin-quick-edit.js',
        array( 'jquery' ),
        '1.0',
        true
    );
}
add_action( 'admin_enqueue_scripts', 'borobill_admin_quick_edit_scripts' );


// 글 목록에 썸네일 컬럼 추가
function borobill_add_thumbnail_column( $columns ) {
    $new = array();

    foreach ( $columns as $key => $label ) {
        if ( 'title' === $key ) {
            $new['thumbnail'] = '썸네일';
        }
        $new[ $key ] = $label;
    }

    return $new;
}
add_filter( 'manage_posts_columns', 'borobill_add_thumbnail_column' );

// 썸네일 컬럼 내용 출력
function borobill_render_thumbnail_column( $column, $post_id ) {
    if ( 'thumbnail' !== $column ) {
        return;
    }

    $thumb_id = get_post_thumbnail_id( $post_id );

    echo '<span class="borobill-thumb-cell" data-thumb-id="' . esc_attr( $thumb_id ) . '">';

    if ( $thumb_id ) {
        echo get_the_post_thumbnail( $post_id, 'thumbnail' );
    }

    echo '</span>';
}
add_action( 'manage_posts_custom_column', 'borobill_render_thumbnail_column', 10, 2 );


