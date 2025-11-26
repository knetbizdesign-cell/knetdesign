/**
 * Borobill Theme JavaScript
 * 카테고리 필터 및 인터랙션 기능
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // 카테고리 필터 기능
        $('.filter-item').on('click', function() {
            var category = $(this).data('category');
            
            // 활성 상태 변경
            $('.filter-item').removeClass('active');
            $(this).addClass('active');
            
            // 포스트 필터링
            if (category === 'all') {
                $('.article-card').fadeIn(300);
            } else {
                $('.article-card').each(function() {
                    var cardCategory = $(this).data('category');
                    if (cardCategory === category) {
                        $(this).fadeIn(300);
                    } else {
                        $(this).fadeOut(300);
                    }
                });
            }
        });
        
        // 카드 스크롤/호버 애니메이션 제거 (정적인 카드)
        
        // 헤더 스크롤 효과
        var lastScroll = 0;
        $(window).on('scroll', function() {
            var currentScroll = $(this).scrollTop();
            
            if (currentScroll > 100) {
                $('.site-header').addClass('scrolled');
            } else {
                $('.site-header').removeClass('scrolled');
            }
            
            lastScroll = currentScroll;
        });
        
        // 부드러운 스크롤
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
            }
        });
        
    });
    
})(jQuery);

