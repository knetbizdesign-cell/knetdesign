<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-container">
        <div class="header-content">

            <div class="header-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" class="logo-img" alt="바로빌">
                </a>
            </div>

            <nav class="header-nav">
                <ul class="nav-menu">
                    <li><a href="#" class="nav-link">세무·회계·비즈니스</a></li>
                    <li><a href="#" class="nav-link">사업자 뉴스룸</a></li>
                    <li><a href="#" class="nav-link">바로빌 가이드</a></li>
                    <li><a href="#" class="nav-link">고객사례·인사이트</a></li>
                </ul>
            </nav>

            <div class="header-actions">
                <a href="#" class="chatbot-btn">챗봇바로가기</a>
            </div>

        </div>
    </div>
</header>
