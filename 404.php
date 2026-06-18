<?php
/**
 * Template: 404 Page
 * صفحهٔ خطای ۴۰۴ — صفحه پیدا نشد
 * 
 * فقط محتوای صفحه (بدون get_header/get_footer)
 * هدر و فوتر از قالب اصلی دریافت می‌شوند
 */
get_header();
?>

<main class="dz-404">
  <section class="dz-404__hero">
    <div class="wrap">
      <!-- Badge/Kicker -->
      <div class="dz-404__kicker">
        <i class="fas fa-triangle-exclamation"></i>
        <span><?php esc_html_e( 'صفحه پیدا نشد', 'dashtzad' ); ?></span>
      </div>

      <!-- Big 404 with Brand Seal -->
      <div class="dz-404__code">
        <span class="dz-404__digit">4</span>
        <div class="dz-404__seal">
          <i class="fas fa-leaf"></i>
        </div>
        <span class="dz-404__digit">4</span>
      </div>

      <!-- Title -->
      <h1 class="dz-404__title">
        <?php esc_html_e( 'متاسفانه این صفحه وجود ندارد', 'dashtzad' ); ?>
      </h1>

      <!-- Description -->
      <p class="dz-404__lead">
        <?php esc_html_e( 'ممکن است آدرس تایپی داشته باشد یا صفحه منتقل شده باشد. می‌توانید از جستجو استفاده کنید یا به صفحهٔ اصلی برگردید.', 'dashtzad' ); ?>
      </p>

      <!-- Search Box -->
      <form class="dz-404__search" role="search">
        <i class="fas fa-search"></i>
        <input
          type="search"
          placeholder="<?php esc_attr_e( 'جستجو در دشت‌زاد...', 'dashtzad' ); ?>"
          aria-label="<?php esc_attr_e( 'جستجو', 'dashtzad' ); ?>"
        >
        <button class="btn btn--primary" type="submit">
          <?php esc_html_e( 'جستجو', 'dashtzad' ); ?>
        </button>
      </form>

      <!-- Quick Actions -->
      <div class="dz-404__actions">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
          <i class="fas fa-home"></i>
          <?php esc_html_e( 'بازگشت به خانه', 'dashtzad' ); ?>
        </a>
        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn btn--ghost">
          <i class="fas fa-leaf"></i>
          <?php esc_html_e( 'فروشگاه', 'dashtzad' ); ?>
        </a>
      </div>

      <!-- Quick Category Links -->
      <div class="dz-404__links">
        <span class="dz-404__links-label">
          <?php esc_html_e( 'محبوب:', 'dashtzad' ); ?>
        </span>
        <a href="<?php echo esc_url( home_url( '/category/teas/' ) ); ?>" class="dz-404__link">
          <i class="fas fa-cup-hot"></i>
          <?php esc_html_e( 'چای‌ها', 'dashtzad' ); ?>
        </a>
        <a href="<?php echo esc_url( home_url( '/category/herbs/' ) ); ?>" class="dz-404__link">
          <i class="fas fa-leaf"></i>
          <?php esc_html_e( 'گیاهان دارویی', 'dashtzad' ); ?>
        </a>
        <a href="<?php echo esc_url( home_url( '/category/accessories/' ) ); ?>" class="dz-404__link">
          <i class="fas fa-mug-hot"></i>
          <?php esc_html_e( 'لوازم جانبی', 'dashtzad' ); ?>
        </a>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="dz-404__link">
          <i class="fas fa-info-circle"></i>
          <?php esc_html_e( 'درباره ما', 'dashtzad' ); ?>
        </a>
      </div>
    </div>
  </section>

  <!-- Suggested Products Section -->
  <section class="dz-404__suggestions">
    <div class="wrap">
      <div class="dz-404__suggestions-head">
        <h2><?php esc_html_e( 'محصولات پیشنهادی', 'dashtzad' ); ?></h2>
        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="dz-404__suggestions-link">
          <?php esc_html_e( 'مشاهدهٔ همه', 'dashtzad' ); ?>
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>

      <div class="dz-404__grid">
        <!-- Sample Product Card 1 -->
        <div class="dz-404__product">
          <div class="dz-404__product-media">
            <div class="ph">
              <div class="ph__label"><?php esc_html_e( 'تصویر محصول', 'dashtzad' ); ?></div>
            </div>
            <span class="dz-404__product-badge"><?php esc_html_e( 'محبوب', 'dashtzad' ); ?></span>
          </div>
          <div class="dz-404__product-body">
            <h3><?php esc_html_e( 'چای سبز دماوند', 'dashtzad' ); ?></h3>
            <div class="dz-404__product-rating">
              <i class="fas fa-star"></i>
              <span>4.8</span>
              <span class="text-stone-500">(۲۴۵ نظر)</span>
            </div>
            <div class="dz-404__product-footer">
              <div class="dz-404__product-price">
                <span>۱۲۰</span>
                <span class="text-xs">تومان</span>
              </div>
              <button class="dz-404__product-add" aria-label="<?php esc_attr_e( 'افزودن به سبد', 'dashtzad' ); ?>">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sample Product Card 2 -->
        <div class="dz-404__product">
          <div class="dz-404__product-media">
            <div class="ph">
              <div class="ph__label"><?php esc_html_e( 'تصویر محصول', 'dashtzad' ); ?></div>
            </div>
            <span class="dz-404__product-badge dz-404__product-badge--discount"><?php esc_html_e( 'تخفیف', 'dashtzad' ); ?></span>
          </div>
          <div class="dz-404__product-body">
            <h3><?php esc_html_e( 'گیاه آرام‌بخش شب', 'dashtzad' ); ?></h3>
            <div class="dz-404__product-rating">
              <i class="fas fa-star"></i>
              <span>4.6</span>
              <span class="text-stone-500">(۱۸۹ نظر)</span>
            </div>
            <div class="dz-404__product-footer">
              <div class="dz-404__product-price">
                <span>۸۵</span>
                <span class="text-xs">تومان</span>
              </div>
              <button class="dz-404__product-add" aria-label="<?php esc_attr_e( 'افزودن به سبد', 'dashtzad' ); ?>">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sample Product Card 3 -->
        <div class="dz-404__product">
          <div class="dz-404__product-media">
            <div class="ph">
              <div class="ph__label"><?php esc_html_e( 'تصویر محصول', 'dashtzad' ); ?></div>
            </div>
            <span class="dz-404__product-badge dz-404__product-badge--new"><?php esc_html_e( 'جدید', 'dashtzad' ); ?></span>
          </div>
          <div class="dz-404__product-body">
            <h3><?php esc_html_e( 'ترکیب بهاری دشت‌زاد', 'dashtzad' ); ?></h3>
            <div class="dz-404__product-rating">
              <i class="fas fa-star"></i>
              <span>4.9</span>
              <span class="text-stone-500">(۶۲ نظر)</span>
            </div>
            <div class="dz-404__product-footer">
              <div class="dz-404__product-price">
                <span>۱۵۵</span>
                <span class="text-xs">تومان</span>
              </div>
              <button class="dz-404__product-add" aria-label="<?php esc_attr_e( 'افزودن به سبد', 'dashtzad' ); ?>">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sample Product Card 4 -->
        <div class="dz-404__product">
          <div class="dz-404__product-media">
            <div class="ph">
              <div class="ph__label"><?php esc_html_e( 'تصویر محصول', 'dashtzad' ); ?></div>
            </div>
            <span class="dz-404__product-badge dz-404__product-badge--bestseller"><?php esc_html_e( 'پرفروش', 'dashtzad' ); ?></span>
          </div>
          <div class="dz-404__product-body">
            <h3><?php esc_html_e( 'عسل طبیعی کوهستان', 'dashtzad' ); ?></h3>
            <div class="dz-404__product-rating">
              <i class="fas fa-star"></i>
              <span>4.7</span>
              <span class="text-stone-500">(۳۳۶ نظر)</span>
            </div>
            <div class="dz-404__product-footer">
              <div class="dz-404__product-price">
                <span>۲۸۰</span>
                <span class="text-xs">تومان</span>
              </div>
              <button class="dz-404__product-add" aria-label="<?php esc_attr_e( 'افزودن به سبد', 'dashtzad' ); ?>">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
