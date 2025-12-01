<?php
/**
 * 카테고리 필터 탭
 *
 * 실제 필터 동작은 js/main.js 와 .article-card[data-category] 속성을 사용.
 *
 * 현재는 요청에 따라, 아래 4개의 탭만 고정으로 노출합니다.
 * - 세무·비즈니스
 * - 사업자 뉴스룸
 * - 바로빌 가이드
 * - 고객사례·인사이트
 *
 * data-category 값(슬러그)은 실제 카테고리 슬러그에 맞게 수정해서 사용하세요.
 */
?>

<section class="section section-filter">
    <div class="section-inner">
        <div class="filter-wrap">
            <button class="filter-item active" data-category="all">전체</button>

            <!-- 아래 네 개만 노출되도록 고정 -->
            <button class="filter-item" data-category="tax-business">세무·비즈니스</button>
            <button class="filter-item" data-category="business-newsroom">사업자 뉴스룸</button>
            <button class="filter-item" data-category="barobill-guide">바로빌 가이드</button>
            <button class="filter-item" data-category="customer-insight">고객사례·인사이트</button>
        </div>
    </div>
</section>

