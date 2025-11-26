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
        
        // 스크롤 애니메이션 (Intersection Observer 사용)
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass('animated');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            $('.article-card, .featured-card').each(function() {
                observer.observe(this);
            });
        } else {
            // Fallback for older browsers
            function animateOnScroll() {
                $('.article-card, .featured-card').each(function() {
                    var elementTop = $(this).offset().top;
                    var elementBottom = elementTop + $(this).outerHeight();
                    var viewportTop = $(window).scrollTop();
                    var viewportBottom = viewportTop + $(window).height();
                    
                    if (elementBottom > viewportTop && elementTop < viewportBottom) {
                        $(this).addClass('animated');
                    }
                });
            }
            
            $(window).on('scroll', animateOnScroll);
            animateOnScroll();
        }
        
        // 마우스 패럴랙스 효과
        $('.article-card, .featured-card').on('mousemove', function(e) {
            var $card = $(this);
            var cardOffset = $card.offset();
            var x = e.pageX - cardOffset.left;
            var y = e.pageY - cardOffset.top;
            var centerX = $card.width() / 2;
            var centerY = $card.height() / 2;
            var rotateX = (y - centerY) / 20;
            var rotateY = (centerX - x) / 20;
            
            $card.css({
                'transform': 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-8px) scale(1.02)'
            });
        });
        
        $('.article-card, .featured-card').on('mouseleave', function() {
            $(this).css({
                'transform': ''
            });
        });
        
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

