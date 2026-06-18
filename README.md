# قالب وردپرس دشت‌زاد (Dashtzad Theme)

قالب اختصاصی فروشگاهی **وردپرس + ووکامرس**، طراحی **RTL فارسی** با **Tailwind CSS**.
بدون ری‌اکت، بدون page-builder، بدون قالب آماده — کاملاً Component-first.

---

## پیش‌نیازها
- WordPress 6.4+ و PHP 8.0+
- WooCommerce (برای صفحات فروشگاه/سبد/تسویه — مرحله‌ی بعد)
- Node.js 18+ و npm (فقط برای ساخت CSS)

## نصب
۱. ساخت فایل CSS (Tailwind را کامپایل می‌کند):
```bash
cd dashtzad-theme
npm install
npm run build        # خروجی: assets/css/tailwind.css
# یا هنگام توسعه:
npm run dev          # واچ و ساخت خودکار
```
۲. کل پوشه‌ی `dashtzad-theme` را در مسیر زیر کپی کنید:
```
wp-content/themes/dashtzad-theme
```
(یا پوشه را zip کرده و از مسیر «نمایش ← پوسته‌ها ← افزودن پوسته ← بارگذاری» نصب کنید — قبلش حتماً `npm run build` اجرا شده باشد.)

۳. در پیشخوان وردپرس پوسته‌ی **Dashtzad** را فعال کنید.

۴. تنظیمات اولیه:
- **خواندن:** صفحه‌ی نخست → یک صفحه‌ی ثابت (تا `front-page.php` نمایش داده شود).
- **منوها:** یک منو به جایگاه «منوی اصلی» اختصاص دهید (در حال حاضر منوی هدر ثابت/طراحی‌شده است).
- صفحات اصلی را با اسلاگ‌های انگلیسی بسازید: `/about/`, `/contact/`, `/faq/`, `/terms/`, `/blog/`, `/shop/`, `/bulk-order/`, `/corporate-gifts/`, `/special-sale/`, `/track-order/`.

## ساختار
```
dashtzad-theme/
  style.css            هدر متادیتای قالب
  functions.php        بوت‌استرپ
  header.php footer.php چرم مشترک
  front-page.php       صفحه‌ی اصلی
  index.php            fallback
  inc/                 setup, enqueue, helpers, template-tags
  components/          قطعات قابل‌استفاده‌ی مجدد (product-card …)
  assets/css/input.css ورودی Tailwind  → tailwind.css (خروجی build)
  assets/js/app.js     تعامل‌ها
  assets/fonts/        فونت Yekan Bakh
```

## قواعد رعایت‌شده
- رنگ‌ها فقط از توکن‌های نام‌دار Tailwind (بدون رنگ خام).
- بدون px مستقیم؛ مقیاس `1rem = 10px`.
- RTL با ویژگی‌های منطقی (`start/end`).
- ارقام فارسی و تاریخ جلالی فقط در لایه‌ی نمایش؛ ذخیره/محاسبه انگلیسی و میلادی.
- متن‌های ثابت با توابع i18n وردپرس (`esc_html_e( …, 'dashtzad' )`).
- بدون CDN برای Tailwind در تولید (کامپایل‌شده).

## سیستم وضعیت محصول (WooCommerce — production)
منبع واحدِ وضعیت: `inc/product-state-resolver.php` → تابع `dz_resolve_product_state( $product )`.
همهٔ کارت‌ها، آرشیو، صفحهٔ تک‌محصول، CTAها، بج‌ها و نمایشِ قیمت از همین resolver وضعیت می‌گیرند.

**هشت وضعیت معتبر:** `available`, `unavailable`, `special`, `bestseller`, `new-arrival`, `discounted`, `contact`, `discontinued` (همه‌جا `new-arrival` — هرگز `new`).

**منطق وضعیت:**
- `discontinued` ← متای `_dz_product_state = discontinued`
- `unavailable` ← موجودیِ ووکامرس = `outofstock`
- `contact` ← `_dz_call_for_price = yes` یا `_dz_product_state = contact`
- `special` ← `_dz_product_state = special` و تاریخِ کمپین فعال (`_dz_special_end_date`)
- `discounted` ← `$product->is_on_sale()` ووکامرس
- `bestseller` ← عبور از آستانهٔ فروش (پیش‌فرض ۳۰، فیلترِ `dz_bestseller_threshold`) یا متای دستی
- `new-arrival` ← انتشار در ۳۰ روز اخیر (فیلترِ `dz_new_arrival_days`) یا متای دستی
- `available` ← پیش‌فرض

**قیمت/موجودی/سبد/تسویه همیشه از WooCommerce.** متاها فقط حالتِ نمایشی را کنترل می‌کنند (هرگز قیمت/موجودیِ واقعی در متا ذخیره نمی‌شود).

**فیلدهای ادمین محصول** (تب «عمومی» دادهٔ محصول — `inc/product-admin-fields.php`):
`_dz_product_state`, `_dz_call_for_price`, `_dz_special_end_date`, `_dz_replacement_product_id`.
اگر ACF با همین کلیدها نصب باشد، resolver ابتدا از ACF می‌خواند.

**مسدودسازیِ خرید سمت سرور** برای `contact` / `unavailable` / `discontinued` با فیلترهای
`woocommerce_is_purchasable` و `woocommerce_add_to_cart_validation` (در resolver). مخفی‌کردنِ دکمه کافی نیست.

**فایل‌های مرتبط:**
- `template-parts/woocommerce/product-card.php` — کارتِ وضعیت‌محور (خروجی `data-state="…"`).
- `woocommerce/content-product.php` — هر آیتمِ حلقهٔ آرشیو با همان کارت.
- `woocommerce/single-product.php` — صفحهٔ تک‌محصولِ وضعیت‌محور (نسخهٔ مرجعِ override: WooCommerce 3.6.0).
- `assets/css/src/04-sections/product-states.css` — استایلِ سیستم (در `input.css` ایمپورت شده).

> **پیش‌نمایش/مرجع:** `wp/pages/product-states.php` و `wp/css/product-states.css` فقط **مرجعِ طراحی** هستند
> (نوارِ «سوییچِ زندهٔ ۸ حالت» صرفاً ابزارِ پیش‌نمایش است). منطقِ تولید از `data-state`ِ سرور-رندر می‌آید، نه از سوییچِ کلاینت.

## نکته
داده‌ی محصولات صفحه‌ی اصلی فعلاً نمونه است و در مرحله‌ی ووکامرس با `WC_Query` جایگزین می‌شود.
وضعیت پیشرفت در `_progress/` (در `.gitignore`، در نسخه‌ی نهایی شیپ نمی‌شود).
