<?php
/**
 * Template tags: reusable presentational helpers used inside templates.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output the Dashtzad brand seal mark.
 *
 * @param string $size Tailwind size utilities (w/h/text).
 */
function dz_brand_seal( $size = 'w-[4.6rem] h-[4.6rem] text-[2.3rem]' ) {
	printf(
		'<span class="%s rounded-full bg-green text-white grid place-items-center font-display font-bold border-2 border-gold flex-none" aria-hidden="true">د</span>',
		esc_attr( $size )
	);
}

/**
 * Section overline + heading block used across the front page and archives.
 *
 * @param array $args kicker, title, sub (all optional, Persian copy).
 */
function dz_section_head( $args = array() ) {
	$args = wp_parse_args( $args, array( 'kicker' => '', 'title' => '', 'sub' => '' ) );
	echo '<div class="min-w-0">';
	if ( $args['kicker'] ) {
		echo '<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[\'\'] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]">' . esc_html( $args['kicker'] ) . '</span>';
	}
	if ( $args['title'] ) {
		echo '<h2 class="font-display font-bold mt-[1.1rem] tracking-[-.01em]">' . esc_html( $args['title'] ) . '</h2>';
	}
	if ( $args['sub'] ) {
		echo '<p class="text-ink-soft text-[1.5rem] mt-[.8rem] max-w-[62rem]">' . esc_html( $args['sub'] ) . '</p>';
	}
	echo '</div>';
}

/**
 * Image placeholder block (used until real media is added in admin).
 *
 * @param string $label   Monospace caption describing the intended image.
 * @param string $classes Extra Tailwind classes for the .dz-placeholder wrapper.
 */
function dz_placeholder( $label = '', $classes = '' ) {
	printf(
		'<div class="dz-placeholder %s"><span class="dz-placeholder__label">%s</span></div>',
		esc_attr( $classes ),
		esc_html( $label )
	);
}

/**
 * Primary navigation items — single source consumed by both the desktop and
 * mobile nav partials, so the link list is never duplicated.
 *
 * Item keys: url, label, icon (FA), and optional flags:
 *   bold    → render with font-bold (the "home" entry)
 *   current → active styling (green underline)
 *   mega    → desktop renders the shop categories mega-menu for this item
 *   ai      → magazine "AI assistant" accent treatment
 *
 * @param string $context 'main' (store) or 'blog' (magazine).
 * @return array<int,array<string,mixed>>
 */
function dz_nav_items( $context = 'main' ) {
	if ( 'blog' === $context ) {
		return array(
			array( 'url' => home_url( '/blog/' ), 'label' => __( 'خانه مجله', 'dashtzad' ), 'icon' => 'fa-house', 'bold' => true, 'current' => ( is_home() && ! is_front_page() ) ),
			array( 'url' => home_url( '/blog/#categories' ), 'label' => __( 'دسته‌ها', 'dashtzad' ), 'icon' => 'fa-layer-group' ),
			array( 'url' => home_url( '/what-to-cook/' ), 'label' => __( 'امروز چی بپزم؟', 'dashtzad' ), 'icon' => 'fa-utensils' ),
			array( 'url' => home_url( '/blog/#dossiers' ), 'label' => __( 'پرونده‌ها', 'dashtzad' ), 'icon' => 'fa-folder-open' ),
			array( 'url' => home_url( '/blog/#videos' ), 'label' => __( 'آموزش تصویری', 'dashtzad' ), 'icon' => 'fa-circle-play' ),
			array( 'url' => home_url( '/blog/#tips' ), 'label' => __( 'ترفندها', 'dashtzad' ), 'icon' => 'fa-lightbulb' ),
			array( 'url' => home_url( '/what-to-cook/' ), 'label' => __( 'دستیار آشپزی هوشمند', 'dashtzad' ), 'icon' => 'fa-wand-magic-sparkles', 'ai' => true ),
		);
	}

	return array(
		array( 'url' => home_url( '/' ), 'label' => __( 'خانه', 'dashtzad' ), 'icon' => 'fa-house', 'bold' => true, 'current' => is_front_page() ),
		array( 'url' => home_url( '/shop/' ), 'label' => __( 'فروشگاه', 'dashtzad' ), 'icon' => 'fa-store', 'mega' => true ),
		array( 'url' => home_url( '/special-sale/' ), 'label' => __( 'فروش ویژه', 'dashtzad' ), 'icon' => 'fa-bolt' ),
		array( 'url' => home_url( '/blog/' ), 'label' => __( 'مجله', 'dashtzad' ), 'icon' => 'fa-book-open' ),
		array( 'url' => home_url( '/bulk-order/' ), 'label' => __( 'خرید عمده', 'dashtzad' ), 'icon' => 'fa-box-open' ),
		array( 'url' => home_url( '/corporate-gifts/' ), 'label' => __( 'هدایای سازمانی', 'dashtzad' ), 'icon' => 'fa-gift' ),
		array( 'url' => home_url( '/about/' ), 'label' => __( 'درباره ما', 'dashtzad' ), 'icon' => 'fa-leaf' ),
		array( 'url' => home_url( '/contact/' ), 'label' => __( 'تماس با ما', 'dashtzad' ), 'icon' => 'fa-headset' ),
	);
}

/**
 * Shop categories shown inside the store header mega-menu.
 * `tone` holds the swatch utility classes for the category icon tile.
 *
 * @return array<int,array<string,string>>
 */
function dz_shop_mega_cats() {
	$out = array();
	foreach ( dz_product_categories() as $dz_slug => $dz_cat ) {
		$out[] = array(
			'slug'  => $dz_slug,
			'icon'  => $dz_cat['icon'],
			'label' => $dz_cat['name'],
			'tone'  => $dz_cat['hero_tone'],
		);
	}
	return $out;
}

/**
 * Single source of truth for store product categories AND their per-category
 * filter sets. Each main category (rice, legume, …) owns its own subcategory
 * chips and filter groups — the archive template reads everything from here so
 * "برنج" shows rice filters, "آجیل" shows nut filters, and so on.
 *
 * When WooCommerce lands, map the queried product_cat term slug to these keys
 * (or move the per-term config into term meta) and keep the same array shape.
 *
 * Filter group shape:
 *   array( 'title' => …, 'type' => 'checkbox'|'radio', 'name' => …(radio only),
 *          'options' => array( array( 'label' => …, 'count' => …, 'checked' => bool ) ) )
 *
 * @return array<string,array<string,mixed>>
 */
function dz_product_categories() {
	return array(

		'rice' => array(
			'name'      => __( 'برنج', 'dashtzad' ),
			'icon'      => 'fa-bowl-rice',
			'hero_tone' => 'bg-green-soft text-green-deep',
			'count'     => '۳۶',
			'desc'      => __( 'برنج ایرانی اصیل — هاشمی، طارم و دم‌سیاهِ معطر؛ بوجاری و سورت‌شده، مستقیم از شالیزارهای شمال و باغ‌داران مورد اعتماد دشت‌زاد.', 'dashtzad' ),
			'subcats'   => array(
				array( 'label' => __( 'همه برنج‌ها', 'dashtzad' ), 'count' => '۳۶', 'active' => true ),
				array( 'label' => __( 'هاشمی', 'dashtzad' ), 'count' => '۱۲', 'active' => false ),
				array( 'label' => __( 'طارم', 'dashtzad' ), 'count' => '۹', 'active' => false ),
				array( 'label' => __( 'دم‌سیاه', 'dashtzad' ), 'count' => '۶', 'active' => false ),
				array( 'label' => __( 'صدری', 'dashtzad' ), 'count' => '۵', 'active' => false ),
				array( 'label' => __( 'عنبربو', 'dashtzad' ), 'count' => '۴', 'active' => false ),
			),
			'filters'   => array(
				array( 'title' => __( 'نوع برنج', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'هاشمی', 'dashtzad' ), 'count' => '۱۲' ),
					array( 'label' => __( 'طارم', 'dashtzad' ), 'count' => '۹' ),
					array( 'label' => __( 'دم‌سیاه', 'dashtzad' ), 'count' => '۶' ),
					array( 'label' => __( 'صدری', 'dashtzad' ), 'count' => '۵' ),
					array( 'label' => __( 'عنبربو', 'dashtzad' ), 'count' => '۴' ),
				) ),
				array( 'title' => __( 'وزن بسته', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( '۱ کیلوگرم', 'dashtzad' ), 'count' => '۱۸' ),
					array( 'label' => __( '۵ کیلوگرم', 'dashtzad' ), 'count' => '۲۲' ),
					array( 'label' => __( '۱۰ کیلوگرم', 'dashtzad' ), 'count' => '۱۴' ),
				) ),
				array( 'title' => __( 'منطقه کشت', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'گیلان', 'dashtzad' ), 'count' => '۲۰' ),
					array( 'label' => __( 'مازندران', 'dashtzad' ), 'count' => '۱۱' ),
					array( 'label' => __( 'آستانه اشرفیه', 'dashtzad' ), 'count' => '۵' ),
				) ),
				array( 'title' => __( 'ویژگی‌ها', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'فقط کالاهای موجود', 'dashtzad' ), 'checked' => true ),
					array( 'label' => __( 'تخفیف‌دار', 'dashtzad' ) ),
					array( 'label' => __( 'کشت ارگانیک', 'dashtzad' ) ),
					array( 'label' => __( 'بوجاری و سورت‌شده', 'dashtzad' ) ),
					array( 'label' => __( 'دانه‌بلند و معطر', 'dashtzad' ) ),
				) ),
			),
		),

		'legume' => array(
			'name'      => __( 'حبوبات', 'dashtzad' ),
			'icon'      => 'fa-seedling',
			'hero_tone' => 'bg-clay-soft text-clay-deep',
			'count'     => '۲۸',
			'desc'      => __( 'حبوبات درشت و یک‌دستِ دماوند — لوبیا، عدس، نخود و لپه؛ بوجاری و سورت‌شده، بدون سنگ و خاشاک و با پختی یکنواخت.', 'dashtzad' ),
			'subcats'   => array(
				array( 'label' => __( 'همه حبوبات', 'dashtzad' ), 'count' => '۲۸', 'active' => true ),
				array( 'label' => __( 'لوبیا', 'dashtzad' ), 'count' => '۸', 'active' => false ),
				array( 'label' => __( 'عدس', 'dashtzad' ), 'count' => '۶', 'active' => false ),
				array( 'label' => __( 'نخود', 'dashtzad' ), 'count' => '۵', 'active' => false ),
				array( 'label' => __( 'لپه', 'dashtzad' ), 'count' => '۵', 'active' => false ),
				array( 'label' => __( 'ماش', 'dashtzad' ), 'count' => '۴', 'active' => false ),
			),
			'filters'   => array(
				array( 'title' => __( 'نوع حبوبات', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'لوبیا قرمز', 'dashtzad' ), 'count' => '۵' ),
					array( 'label' => __( 'لوبیا چیتی', 'dashtzad' ), 'count' => '۳' ),
					array( 'label' => __( 'عدس', 'dashtzad' ), 'count' => '۶' ),
					array( 'label' => __( 'نخود', 'dashtzad' ), 'count' => '۵' ),
					array( 'label' => __( 'لپه', 'dashtzad' ), 'count' => '۵' ),
					array( 'label' => __( 'ماش', 'dashtzad' ), 'count' => '۴' ),
				) ),
				array( 'title' => __( 'وزن بسته', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( '۹۰۰ گرم', 'dashtzad' ), 'count' => '۲۰' ),
					array( 'label' => __( '۵ کیلوگرم', 'dashtzad' ), 'count' => '۱۲' ),
				) ),
				array( 'title' => __( 'ویژگی‌ها', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'فقط کالاهای موجود', 'dashtzad' ), 'checked' => true ),
					array( 'label' => __( 'تخفیف‌دار', 'dashtzad' ) ),
					array( 'label' => __( 'درشت و یک‌دست', 'dashtzad' ) ),
					array( 'label' => __( 'بوجاری‌شده', 'dashtzad' ) ),
					array( 'label' => __( 'پخت سریع', 'dashtzad' ) ),
				) ),
			),
		),

		'nuts' => array(
			'name'      => __( 'خشکبار و میوه خشک', 'dashtzad' ),
			'icon'      => 'fa-apple-whole',
			'hero_tone' => 'bg-clay-soft text-clay-deep',
			'count'     => '۴۸',
			'desc'      => __( 'میوه‌های خشک، برگه، خرما و کشمش — آفتاب‌خشک و بدون افزودنی، مستقیم از باغ‌های دماوند و باغ‌داران مورد اعتماد دشت‌زاد. هرچه می‌چشید، همان طعم اصیلِ زمین است.', 'dashtzad' ),
			'subcats'   => array(
				array( 'label' => __( 'همه محصولات', 'dashtzad' ), 'count' => '۴۸', 'active' => true ),
				array( 'label' => __( 'میوه خشک', 'dashtzad' ), 'count' => '۲۴', 'active' => false ),
				array( 'label' => __( 'برگه', 'dashtzad' ), 'count' => '۹', 'active' => false ),
				array( 'label' => __( 'خرما', 'dashtzad' ), 'count' => '۷', 'active' => false ),
				array( 'label' => __( 'توت و کشمش', 'dashtzad' ), 'count' => '۶', 'active' => false ),
				array( 'label' => __( 'انجیر', 'dashtzad' ), 'count' => '۲', 'active' => false ),
			),
			'filters'   => array(
				array( 'title' => __( 'زیردسته‌ها', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'میوه خشک', 'dashtzad' ), 'count' => '۲۴' ),
					array( 'label' => __( 'برگه', 'dashtzad' ), 'count' => '۹' ),
					array( 'label' => __( 'خرما', 'dashtzad' ), 'count' => '۷' ),
					array( 'label' => __( 'توت و کشمش', 'dashtzad' ), 'count' => '۶' ),
					array( 'label' => __( 'انجیر', 'dashtzad' ), 'count' => '۲' ),
				) ),
				array( 'title' => __( 'ویژگی‌ها', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'فقط کالاهای موجود', 'dashtzad' ), 'checked' => true ),
					array( 'label' => __( 'تخفیف‌دار', 'dashtzad' ) ),
					array( 'label' => __( 'بدون افزودنی و شکر', 'dashtzad' ) ),
					array( 'label' => __( 'آفتاب‌خشک', 'dashtzad' ) ),
					array( 'label' => __( 'بسته‌بندی هدیه', 'dashtzad' ) ),
				) ),
			),
		),

		'tea' => array(
			'name'      => __( 'چای و دمنوش', 'dashtzad' ),
			'icon'      => 'fa-mug-hot',
			'hero_tone' => 'bg-green-soft text-green-deep',
			'count'     => '۲۲',
			'desc'      => __( 'چای ممتاز لاهیجان و دمنوش‌های گیاهی — بهاره، خوش‌عطر و بدون اسانس؛ از باغ‌های چای شمال تا فنجان شما.', 'dashtzad' ),
			'subcats'   => array(
				array( 'label' => __( 'همه محصولات', 'dashtzad' ), 'count' => '۲۲', 'active' => true ),
				array( 'label' => __( 'چای سیاه', 'dashtzad' ), 'count' => '۱۰', 'active' => false ),
				array( 'label' => __( 'چای سبز', 'dashtzad' ), 'count' => '۴', 'active' => false ),
				array( 'label' => __( 'دمنوش گیاهی', 'dashtzad' ), 'count' => '۸', 'active' => false ),
			),
			'filters'   => array(
				array( 'title' => __( 'نوع', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'چای سیاه', 'dashtzad' ), 'count' => '۱۰' ),
					array( 'label' => __( 'چای سبز', 'dashtzad' ), 'count' => '۴' ),
					array( 'label' => __( 'دمنوش گیاهی', 'dashtzad' ), 'count' => '۸' ),
				) ),
				array( 'title' => __( 'فرم برگ', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'سرگل', 'dashtzad' ), 'count' => '۷' ),
					array( 'label' => __( 'قلم', 'dashtzad' ), 'count' => '۶' ),
					array( 'label' => __( 'شکسته', 'dashtzad' ), 'count' => '۵' ),
				) ),
				array( 'title' => __( 'ویژگی‌ها', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'فقط کالاهای موجود', 'dashtzad' ), 'checked' => true ),
					array( 'label' => __( 'تخفیف‌دار', 'dashtzad' ) ),
					array( 'label' => __( 'بهاره', 'dashtzad' ) ),
					array( 'label' => __( 'بدون اسانس', 'dashtzad' ) ),
				) ),
			),
		),

		'spice' => array(
			'name'      => __( 'ادویه و زعفران', 'dashtzad' ),
			'icon'      => 'fa-mortar-pestle',
			'hero_tone' => 'bg-green-soft text-green-deep',
			'count'     => '۱۹',
			'desc'      => __( 'زعفران سرگل نگین قائنات و ادویه‌جاتِ تازه آسیاب‌شده — دارچین، هل، زردچوبه و آویشن؛ معطر و خالص، بدون رنگ و افزودنی.', 'dashtzad' ),
			'subcats'   => array(
				array( 'label' => __( 'همه محصولات', 'dashtzad' ), 'count' => '۱۹', 'active' => true ),
				array( 'label' => __( 'زعفران', 'dashtzad' ), 'count' => '۶', 'active' => false ),
				array( 'label' => __( 'دارچین', 'dashtzad' ), 'count' => '۳', 'active' => false ),
				array( 'label' => __( 'هل', 'dashtzad' ), 'count' => '۳', 'active' => false ),
				array( 'label' => __( 'زردچوبه', 'dashtzad' ), 'count' => '۴', 'active' => false ),
			),
			'filters'   => array(
				array( 'title' => __( 'نوع ادویه', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'زعفران', 'dashtzad' ), 'count' => '۶' ),
					array( 'label' => __( 'دارچین', 'dashtzad' ), 'count' => '۳' ),
					array( 'label' => __( 'هل', 'dashtzad' ), 'count' => '۳' ),
					array( 'label' => __( 'زردچوبه', 'dashtzad' ), 'count' => '۴' ),
					array( 'label' => __( 'آویشن', 'dashtzad' ), 'count' => '۳' ),
				) ),
				array( 'title' => __( 'فرم', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'کامل', 'dashtzad' ), 'count' => '۱۱' ),
					array( 'label' => __( 'آسیاب‌شده', 'dashtzad' ), 'count' => '۸' ),
				) ),
				array( 'title' => __( 'ویژگی‌ها', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'فقط کالاهای موجود', 'dashtzad' ), 'checked' => true ),
					array( 'label' => __( 'تخفیف‌دار', 'dashtzad' ) ),
					array( 'label' => __( 'سرگل نگین', 'dashtzad' ) ),
					array( 'label' => __( 'تازه آسیاب‌شده', 'dashtzad' ) ),
				) ),
			),
		),

		'ajil' => array(
			'name'      => __( 'آجیل و مغزها', 'dashtzad' ),
			'icon'      => 'fa-bowl-food',
			'hero_tone' => 'bg-amber-soft text-gold-deep',
			'count'     => '۳۱',
			'desc'      => __( 'آجیل و مغزهای تازه دشت‌زاد — پسته، بادام، گردو و فندق؛ تازه بوداده یا خام، با درجه‌یکِ تضمینی و بوجاری دانه‌به‌دانه.', 'dashtzad' ),
			'subcats'   => array(
				array( 'label' => __( 'همه محصولات', 'dashtzad' ), 'count' => '۳۱', 'active' => true ),
				array( 'label' => __( 'پسته', 'dashtzad' ), 'count' => '۸', 'active' => false ),
				array( 'label' => __( 'بادام', 'dashtzad' ), 'count' => '۶', 'active' => false ),
				array( 'label' => __( 'گردو', 'dashtzad' ), 'count' => '۵', 'active' => false ),
				array( 'label' => __( 'فندق', 'dashtzad' ), 'count' => '۴', 'active' => false ),
				array( 'label' => __( 'آجیل مخصوص', 'dashtzad' ), 'count' => '۸', 'active' => false ),
			),
			'filters'   => array(
				array( 'title' => __( 'نوع مغز', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'پسته', 'dashtzad' ), 'count' => '۸' ),
					array( 'label' => __( 'بادام', 'dashtzad' ), 'count' => '۶' ),
					array( 'label' => __( 'گردو', 'dashtzad' ), 'count' => '۵' ),
					array( 'label' => __( 'فندق', 'dashtzad' ), 'count' => '۴' ),
					array( 'label' => __( 'تخمه', 'dashtzad' ), 'count' => '۳' ),
				) ),
				array( 'title' => __( 'طعم', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'تازه بوداده', 'dashtzad' ), 'count' => '۱۸' ),
					array( 'label' => __( 'خام', 'dashtzad' ), 'count' => '۹' ),
					array( 'label' => __( 'کم‌نمک', 'dashtzad' ), 'count' => '۷' ),
					array( 'label' => __( 'بی‌نمک', 'dashtzad' ), 'count' => '۶' ),
				) ),
				array( 'title' => __( 'ویژگی‌ها', 'dashtzad' ), 'type' => 'checkbox', 'options' => array(
					array( 'label' => __( 'فقط کالاهای موجود', 'dashtzad' ), 'checked' => true ),
					array( 'label' => __( 'تخفیف‌دار', 'dashtzad' ) ),
					array( 'label' => __( 'درجه‌یک', 'dashtzad' ) ),
					array( 'label' => __( 'تازه بوجاری‌شده', 'dashtzad' ) ),
				) ),
			),
		),

	);
}

/**
 * Fetch one category config by slug, falling back to the first defined
 * category when the slug is unknown.
 *
 * @param string $slug Category key (rice, legume, nuts, tea, spice, ajil).
 * @return array<string,mixed>
 */
function dz_get_category( $slug = '' ) {
	$cats = dz_product_categories();
	if ( isset( $cats[ $slug ] ) ) {
		return array( 'slug' => $slug ) + $cats[ $slug ];
	}
	$first = array_key_first( $cats );
	return array( 'slug' => $first ) + $cats[ $first ];
}
