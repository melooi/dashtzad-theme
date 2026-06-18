<?php
/**
 * Template part: Account Dashboard (پنل کاربری — داشبورد)
 * فقط محتوای صفحه (بدون get_header/get_footer)
 *
 * نکته: داده‌های نمونه برای نمایش طراحی است. در پیاده‌سازی نهایی
 * از WooCommerce (wc_get_orders، آدرس‌ها، علاقه‌مندی‌ها) خوانده می‌شود.
 */

$user = wp_get_current_user();

// داده‌های نمونه (مطابق طرح)
$u_name    = 'مریم احمدی';
$u_first   = 'مریم';
$u_phone   = '۰۹۱۲ ۳۴۵ ۶۷۸۹';
$u_tier    = 'مشتری طلایی';

$count_orders   = '۵';
$count_addr     = '۳';
$count_wish     = '۵';

// آخرین سفارش
$last_id    = '۱۵۰۰۱';
$last_date  = '۱۸ خرداد ۱۴۰۵';
$last_qty   = '۳';
$last_total = '۶۱۸,۰۰۰';
$last_eta   = 'تحویل تخمینی: ۲۱ خرداد';
get_header();
?>

<div class="pnl">
  <!-- ===== Header ===== -->
  <header class="pnl-hdr">
    <div class="pnl-hdr__inner">
      <a class="pnl-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="pnl-seal">د</span>
        <span>
          <span class="pnl-brand__name" style="display:block;"><?php esc_html_e( 'دشت‌زاد', 'dashtzad' ); ?></span>
          <span class="pnl-brand__tag"><?php esc_html_e( 'پنل کاربری', 'dashtzad' ); ?></span>
        </span>
      </a>
      <div class="pnl-hdr__spacer"></div>
      <a class="pnl-back" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <i class="fas fa-arrow-left"></i> <span><?php esc_html_e( 'بازگشت به فروشگاه', 'dashtzad' ); ?></span>
      </a>
      <a class="pnl-iconbtn" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'سبد خرید', 'dashtzad' ); ?>">
        <i class="fas fa-cart-shopping"></i>
        <span class="pnl-iconbtn__n num">۱</span>
      </a>
      <div class="pnl-userchip">
        <span class="pnl-userchip__av"><?php echo esc_html( mb_substr( $u_first, 0, 1 ) ); ?></span>
        <span>
          <span class="pnl-userchip__name" style="display:block;"><?php echo esc_html( $u_name ); ?></span>
          <span class="pnl-userchip__tier"><?php echo esc_html( $u_tier ); ?></span>
        </span>
      </div>
    </div>
  </header>

  <!-- ===== Shell ===== -->
  <div class="pnl-shell">

    <!-- ----- Sidebar ----- -->
    <aside class="pnl-aside" data-collapse="true">
      <div class="pnl-uc">
        <div class="pnl-uc__top">
          <span class="pnl-uc__av"><?php echo esc_html( mb_substr( $u_first, 0, 1 ) ); ?></span>
          <div style="min-width:0;">
            <div class="pnl-uc__name"><?php echo esc_html( $u_name ); ?></div>
            <div class="pnl-uc__phone num"><?php echo esc_html( $u_phone ); ?></div>
          </div>
        </div>
        <div class="pnl-tier">
          <div class="pnl-tier__stage">
            <div class="pnl-tier__slide" data-on="true">
              <span class="pnl-tier__ic"><i class="fas fa-crown"></i></span>
              <span class="pnl-tier__txt"><?php echo esc_html( $u_tier ); ?></span>
            </div>
          </div>
        </div>
        <nav class="pnl-nav">
          <button class="pnl-nav__item" data-active="true" data-view="dashboard">
            <span class="pnl-nav__ic"><i class="fas fa-gauge-high"></i></span>
            <span class="pnl-nav__label"><?php esc_html_e( 'داشبورد', 'dashtzad' ); ?></span>
          </button>
          <button class="pnl-nav__item" data-view="orders">
            <span class="pnl-nav__ic"><i class="fas fa-box"></i></span>
            <span class="pnl-nav__label"><?php esc_html_e( 'سفارش‌های من', 'dashtzad' ); ?></span>
            <span class="pnl-nav__count num"><?php echo esc_html( $count_orders ); ?></span>
          </button>
          <button class="pnl-nav__item" data-view="tracking">
            <span class="pnl-nav__ic"><i class="fas fa-map-location-dot"></i></span>
            <span class="pnl-nav__label"><?php esc_html_e( 'پیگیری سفارش', 'dashtzad' ); ?></span>
          </button>
          <button class="pnl-nav__item" data-view="addresses">
            <span class="pnl-nav__ic"><i class="fas fa-location-dot"></i></span>
            <span class="pnl-nav__label"><?php esc_html_e( 'آدرس‌های من', 'dashtzad' ); ?></span>
            <span class="pnl-nav__count num"><?php echo esc_html( $count_addr ); ?></span>
          </button>
          <button class="pnl-nav__item" data-view="wishlist">
            <span class="pnl-nav__ic"><i class="fas fa-heart"></i></span>
            <span class="pnl-nav__label"><?php esc_html_e( 'علاقه‌مندی‌ها', 'dashtzad' ); ?></span>
            <span class="pnl-nav__count num"><?php echo esc_html( $count_wish ); ?></span>
          </button>
          <button class="pnl-nav__item" data-view="account">
            <span class="pnl-nav__ic"><i class="fas fa-user"></i></span>
            <span class="pnl-nav__label"><?php esc_html_e( 'اطلاعات حساب', 'dashtzad' ); ?></span>
          </button>
          <div class="pnl-nav__sep"></div>
          <a class="pnl-nav__item pnl-nav__item--exit" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
            <span class="pnl-nav__ic"><i class="fas fa-arrow-right-from-bracket"></i></span>
            <span class="pnl-nav__label"><?php esc_html_e( 'خروج از حساب', 'dashtzad' ); ?></span>
          </a>
        </nav>
      </div>
    </aside>

    <!-- ----- Main ----- -->
    <main class="pnl-main">

      <!-- Hero -->
      <div class="dash-hero">
        <div class="dash-hero__hi"><?php printf( esc_html__( 'سلام %s جان، خوش آمدی', 'dashtzad' ), esc_html( $u_first ) ); ?></div>
        <p class="dash-hero__sub"><?php esc_html_e( 'به پنل کاربری دشت‌زاد خوش آمدی. اینجا می‌توانی سفارش‌ها را پیگیری کنی، آدرس‌ها و علاقه‌مندی‌هایت را مدیریت کنی و اطلاعات حسابت را به‌روز نگه داری.', 'dashtzad' ); ?></p>
      </div>

      <!-- Stats -->
      <div class="dash-stats">
        <button class="dash-stat">
          <span class="dash-stat__ic" style="background:var(--accent-soft);color:var(--accent);"><i class="fas fa-box"></i></span>
          <span class="dash-stat__num"><?php echo esc_html( $count_orders ); ?></span>
          <span class="dash-stat__lbl"><?php esc_html_e( 'سفارش ثبت‌شده', 'dashtzad' ); ?></span>
        </button>
        <button class="dash-stat">
          <span class="dash-stat__ic" style="background:var(--clay-soft);color:var(--clay);"><i class="fas fa-truck"></i></span>
          <span class="dash-stat__num">۲</span>
          <span class="dash-stat__lbl"><?php esc_html_e( 'در حال ارسال', 'dashtzad' ); ?></span>
        </button>
        <button class="dash-stat">
          <span class="dash-stat__ic" style="background:var(--clay-soft);color:var(--clay);"><i class="fas fa-heart"></i></span>
          <span class="dash-stat__num"><?php echo esc_html( $count_wish ); ?></span>
          <span class="dash-stat__lbl"><?php esc_html_e( 'علاقه‌مندی', 'dashtzad' ); ?></span>
        </button>
        <button class="dash-stat">
          <span class="dash-stat__ic" style="background:var(--color-amber-100);color:var(--gold-deep);"><i class="fas fa-wallet"></i></span>
          <span class="dash-stat__num"><span class="num" style="display:inline-flex;align-items:center;gap:0.3rem;font-weight:700;white-space:nowrap;">۲۴۰,۰۰۰<span class="toman-mark"></span></span></span>
          <span class="dash-stat__lbl"><?php esc_html_e( 'کیف پول', 'dashtzad' ); ?></span>
        </button>
      </div>

      <!-- Grid: latest order + coupon -->
      <div class="dash-grid">

        <!-- Latest Order -->
        <div class="dash-panel">
          <div class="dash-panel__head">
            <span class="dash-panel__title"><i class="fas fa-bag-shopping"></i> <?php esc_html_e( 'آخرین سفارش', 'dashtzad' ); ?></span>
            <button class="dash-link" data-view="orders"><?php esc_html_e( 'همه سفارش‌ها', 'dashtzad' ); ?> <i class="fas fa-angle-left"></i></button>
          </div>
          <div style="padding:1.8rem 2rem;display:flex;flex-direction:column;gap:1.6rem;">
            <div style="display:flex;align-items:center;gap:1.4rem;flex-wrap:wrap;">
              <div class="ord__thumbstack">
                <div class="ord__thumb"><div class="ph" style="width:100%;height:100%;"><span class="ph__label"><?php esc_html_e( 'خرما', 'dashtzad' ); ?></span></div></div>
                <div class="ord__thumb"><div class="ph" style="width:100%;height:100%;"><span class="ph__label"><?php esc_html_e( 'کشمش', 'dashtzad' ); ?></span></div></div>
              </div>
              <div style="flex:1;min-width:14rem;">
                <div style="display:flex;align-items:center;gap:0.8rem;flex-wrap:wrap;">
                  <span class="ord__id"><?php esc_html_e( 'سفارش', 'dashtzad' ); ?> <span class="num">#<?php echo esc_html( $last_id ); ?></span></span>
                  <span class="st-pill" data-tone="gold"><span class="st-dot" data-tone="gold"></span><?php esc_html_e( 'در حال پردازش', 'dashtzad' ); ?></span>
                </div>
                <div class="ord__lines-sub" style="margin-top:0.5rem;">
                  <span class="num"><?php echo esc_html( $last_qty ); ?></span> <?php esc_html_e( 'کالا · ثبت در', 'dashtzad' ); ?> <?php echo esc_html( $last_date ); ?>
                </div>
              </div>
              <div style="text-align:start;">
                <div class="faint" style="font-size:1.2rem;"><?php esc_html_e( 'مبلغ سفارش', 'dashtzad' ); ?></div>
                <div style="font-family:var(--display);font-weight:700;font-size:2rem;">
                  <span class="num" style="display:inline-flex;align-items:center;gap:0.3rem;font-weight:700;white-space:nowrap;"><?php echo esc_html( $last_total ); ?><span class="toman-mark"></span></span>
                </div>
              </div>
            </div>
            <div style="display:flex;align-items:center;gap:0.9rem;padding:1.1rem 1.4rem;border-radius:var(--r);background:var(--accent-soft);color:var(--accent-deep);font-size:1.35rem;font-weight:700;">
              <i class="fas fa-truck"></i> <?php echo esc_html( $last_eta ); ?>
            </div>
            <div style="display:flex;gap:0.9rem;flex-wrap:wrap;">
              <button class="btn btn--primary btn--sm" data-view="tracking"><i class="fas fa-map-location-dot"></i> <?php esc_html_e( 'پیگیری سفارش', 'dashtzad' ); ?></button>
              <button class="btn btn--ghost btn--sm" data-view="orders"><i class="fas fa-receipt"></i> <?php esc_html_e( 'مشاهده جزئیات', 'dashtzad' ); ?></button>
            </div>
          </div>
        </div>

        <!-- Coupon -->
        <div style="display:flex;flex-direction:column;gap:1.6rem;">
          <div class="dash-panel">
            <div class="dash-panel__head">
              <span class="dash-panel__title"><i class="fas fa-ticket"></i> <?php esc_html_e( 'کد تخفیف من', 'dashtzad' ); ?></span>
              <span class="faint" style="font-size:1.2rem;"><?php esc_html_e( 'تا ۳۱ خرداد', 'dashtzad' ); ?></span>
            </div>
            <div class="dash-coupon">
              <div class="dash-coupon__code">
                <div>
                  <div class="dash-coupon__val">BAHAR25</div>
                  <div class="faint" style="font-size:1.2rem;margin-top:0.2rem;"><?php esc_html_e( 'فروش ویژه بهاره · ۲۵٪ تخفیف', 'dashtzad' ); ?></div>
                </div>
                <button class="dash-coupon__copy" data-copy="BAHAR25"><i class="fa-regular fa-copy"></i> <?php esc_html_e( 'کپی', 'dashtzad' ); ?></button>
              </div>
              <p class="faint" style="font-size:1.25rem;line-height:1.8;"><?php esc_html_e( 'این کد را هنگام تسویه‌حساب وارد کنید تا تخفیف روی سبد شما اعمال شود.', 'dashtzad' ); ?></p>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
</div>

<?php
get_footer();
