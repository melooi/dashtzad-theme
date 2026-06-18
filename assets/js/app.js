/* ============================================================
   دشت‌زاد — theme interactions
   wishlist toggle · newsletter · reviews card-deck · smooth scroll
   (mega-menu reveal is CSS-only)
   ============================================================ */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {

    /* ---------- wishlist toggle ---------- */
    document.querySelectorAll('.dz-bookmark').forEach(function (b) {
      b.addEventListener('click', function (e) {
        e.preventDefault();
        b.classList.toggle('is-active');
        var i = b.querySelector('i');
        if (!i) return;
        if (b.classList.contains('is-active')) { i.classList.remove('fa-regular'); i.classList.add('fa-solid'); }
        else { i.classList.remove('fa-solid'); i.classList.add('fa-regular'); }
      });
    });

    /* ---------- newsletter (demo submit) ---------- */
    document.querySelectorAll('.dz-newsletter').forEach(function (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var input = form.querySelector('.dz-newsletter__input');
        if (input) input.value = '';
        var ok = form.parentElement.querySelector('.dz-newsletter__ok');
        if (ok) {
          ok.classList.remove('hidden'); ok.classList.add('flex');
          setTimeout(function () { ok.classList.add('hidden'); ok.classList.remove('flex'); }, 6000);
        }
      });
    });

    /* ---------- smooth scroll for in-page anchors ---------- */
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
      a.addEventListener('click', function (e) {
        var id = a.getAttribute('href').slice(1);
        if (!id) return;
        var t = document.getElementById(id);
        if (t) { e.preventDefault(); var y = t.getBoundingClientRect().top + window.scrollY - 100; window.scrollTo({ top: y, behavior: 'smooth' }); }
      });
    });

    /* ---------- reviews card-deck (stacked / draggable) ---------- */
    var deck = document.querySelector('.dz-review-deck');
    if (!deck) return;
    var stage = deck.querySelector('.dz-review-deck__stage');
    var cards = Array.prototype.slice.call(stage.querySelectorAll('.dz-review-card'));
    var dotsWrap = deck.querySelector('.dz-review-deck__dots');
    var n = cards.length;
    if (!n) return;
    var active = 0, busy = false, timer = null, dragging = false, justDragged = false, startX = 0, fc = null;
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    cards.forEach(function (_, i) {
      var b = document.createElement('button');
      b.type = 'button'; b.className = 'dz-review-dot'; b.setAttribute('aria-label', 'نظر ' + (i + 1));
      b.addEventListener('click', function () { goTo(i); restart(); });
      dotsWrap.appendChild(b);
    });
    var dots = Array.prototype.slice.call(dotsWrap.children);

    function pose(card, pos) {
      if (pos === 0) {
        card.style.transform = 'translateY(0) scale(1) rotate(0deg)'; card.style.opacity = '1';
        card.style.zIndex = n + 1; card.classList.add('is-front');
      } else {
        var dir = pos % 2 ? -1 : 1;
        card.style.transform = 'translateY(' + (pos * 1.5) + 'rem) scale(' + (1 - pos * 0.05) + ') rotate(' + (dir * 2.6) + 'deg)';
        card.style.opacity = pos >= 3 ? '0' : String(1 - pos * 0.3);
        card.style.zIndex = n - pos; card.classList.remove('is-front');
      }
    }
    function render() {
      cards.forEach(function (c, i) { pose(c, (i - active + n) % n); });
      dots.forEach(function (d, i) { d.classList.toggle('is-active', i === active); });
    }
    function advance(dir) {
      if (busy) return; busy = true;
      var card = cards[active];
      card.style.transition = 'transform .5s cubic-bezier(.4,.1,.3,1), opacity .5s ease';
      card.style.transform = 'translateX(' + (dir * 120) + '%) translateY(-6%) rotate(' + (dir * 10) + 'deg)';
      card.style.opacity = '0';
      setTimeout(function () {
        card.style.transition = 'none'; active = (active + 1) % n; render();
        requestAnimationFrame(function () { requestAnimationFrame(function () { card.style.transition = ''; busy = false; }); });
      }, 430);
    }
    function next() { advance(-1); }
    function prev() { if (busy) return; active = (active - 1 + n) % n; render(); }
    function goTo(i) { if (i === active || busy) return; active = i; render(); }
    function start() { if (reduce) return; stop(); timer = setInterval(next, 6500); }
    function stop() { if (timer) { clearInterval(timer); timer = null; } }
    function restart() { stop(); start(); }

    deck.querySelector('.dz-review-deck__next').addEventListener('click', function () { next(); restart(); });
    deck.querySelector('.dz-review-deck__prev').addEventListener('click', function () { prev(); restart(); });
    deck.addEventListener('mouseenter', stop);
    deck.addEventListener('mouseleave', start);
    stage.addEventListener('click', function (e) { if (justDragged) return; if (cards[active].contains(e.target)) { next(); restart(); } });
    stage.addEventListener('pointerdown', function (e) {
      if (busy) return; fc = cards[active]; if (!fc.contains(e.target)) return;
      dragging = true; justDragged = false; startX = e.clientX; fc.style.transition = 'none'; stop();
    });
    window.addEventListener('pointermove', function (e) {
      if (!dragging || !fc) return; var dx = e.clientX - startX;
      if (Math.abs(dx) > 5) justDragged = true;
      fc.style.transform = 'translateX(' + dx + 'px) rotate(' + (dx * 0.04) + 'deg)';
    });
    window.addEventListener('pointerup', function (e) {
      if (!dragging || !fc) return; var dx = e.clientX - startX; dragging = false; fc.style.transition = '';
      if (Math.abs(dx) > 90) advance(dx < 0 ? -1 : 1); else render();
      restart(); setTimeout(function () { justDragged = false; }, 60);
    });
    function fit() { var m = 0; cards.forEach(function (c) { m = Math.max(m, c.offsetHeight); }); stage.style.height = (m + 60) + 'px'; }
    window.addEventListener('resize', fit);
    function init() { fit(); render(); start(); }
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(init); else init();
    setTimeout(fit, 300);

    /* ---------- اسلایدر متنِ جستجو (placeholder تایپ‌رایتری از نمونه محصولات) ---------- */
    (function () {
      var inputs = document.querySelectorAll('input[data-rotate-ph]');
      if (!inputs.length) return;
      var ITEMS = ['برنج هاشمی', 'چای ایرانی', 'برگه زرد آلو', 'زعفران سرگل', 'پسته اکبری', 'خرمای مضافتی'];
      var LEAD = 'جستجو؛ مثلا ';
      var STATIC = 'جستجو در فروشگاه دشت‌زاد…';
      var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

      Array.prototype.forEach.call(inputs, function (input) {
        if (reduce) { input.placeholder = LEAD + ITEMS[0]; return; }
        var i = 0, ch = 0, deleting = false, timer = null;
        function tick() {
          var word = ITEMS[i];
          if (!deleting) {
            ch++;
            input.placeholder = LEAD + word.slice(0, ch);
            if (ch >= word.length) { deleting = true; timer = setTimeout(tick, 1400); return; }
          } else {
            ch--;
            input.placeholder = LEAD + word.slice(0, ch);
            if (ch <= 0) { deleting = false; i = (i + 1) % ITEMS.length; timer = setTimeout(tick, 320); return; }
          }
          timer = setTimeout(tick, deleting ? 55 : 95);
        }
        function start() { if (!timer && !input.value) { ch = 0; deleting = false; tick(); } }
        function stop() { if (timer) { clearTimeout(timer); timer = null; } }
        input.addEventListener('focus', function () { stop(); input.placeholder = STATIC; });
        input.addEventListener('blur', function () { if (!input.value) start(); });
        input.addEventListener('input', function () { if (input.value) stop(); });
        start();
      });
    })();
  });
})();


/* ===== کارت محصول سریع (منبع: wp/js/product-card.js) ===== */
/* ============================================================
   product-card.js  —  تعاملات کارت محصول «سریع» دشت‌زاد
   • انیمیشن دکمه علاقه‌مندی (قلب)
   • دکمه افزودن → پنل انتخاب وزن/بسته‌بندی (۲ مرحله، لیست عمودی) → استپر تعداد
     (با حذف دو‌مرحله‌ای قرمز). اگر وزن نداشت، مستقیم استپر.
   • تایمر شگفت‌انگیز روی محصولات تخفیف‌دار (data-timer = دقیقه)
   • حالت ناموجود: دکمه زنگوله → پاپ‌اپ اطلاع موجودی
   داده‌ها از data-* محصول؛ بدون وابستگی؛ روی همه .dz-pc اجرا می‌شود.
   ============================================================ */
(function () {
  'use strict';

  var FA = '۰۱۲۳۴۵۶۷۸۹';
  function toFa(n) { return String(n).replace(/\d/g, function (d) { return FA[d]; }); }
  function parseFa(s) {
    return parseInt(String(s).replace(/[۰-۹]/g, function (d) { return FA.indexOf(d); }).replace(/[^0-9]/g, ''), 10) || 0;
  }
  function grp(n) { n = Math.round(n / 5000) * 5000; return toFa(n.toLocaleString('en-US')).replace(/,/g, '٬'); }
  function fmtG(g) {
    if (g >= 1000) { var k = Math.round(g / 100) / 10; return toFa(String(k).replace('.', '٫')) + ' کیلوگرم'; }
    return toFa(String(g)) + ' گرم';
  }
  function pad2(n) { n = String(n); return n.length < 2 ? '0' + n : n; }

  /* ---------- علاقه‌مندی ---------- */
  function initFav(btn) {
    if (btn.dataset.dzReady) return;
    btn.dataset.dzReady = '1';
    if (!btn.querySelector('.dz-pc__burst')) {
      var sp = document.createElement('span'); sp.className = 'dz-pc__burst'; btn.appendChild(sp);
    }
    var icon = btn.querySelector('i');
    btn.addEventListener('click', function () {
      var on = btn.classList.toggle('is-fav');
      if (icon) { icon.classList.toggle('fa-regular', !on); icon.classList.toggle('fa-solid', on); }
      btn.classList.remove('pop'); void btn.offsetWidth; if (on) btn.classList.add('pop');
    });
  }

  /* ---------- تایمر شگفت‌انگیز ---------- */
  function initTimer(card) {
    var mins = parseInt(card.getAttribute('data-timer'), 10);
    if (!mins || card.querySelector('.dz-pc__timer')) return;
    var media = card.querySelector('.dz-pc__media') || card.querySelector('.dz-pc__img');
    if (!media || media.classList.contains('dz-pc__img')) media = card.querySelector('.dz-pc__img').parentNode;
    var t = document.createElement('div'); t.className = 'dz-pc__timer';
    t.innerHTML = '<i class="fa-solid fa-bolt"></i> شگفت‌انگیز <b></b>';
    media.appendChild(t);
    var b = t.querySelector('b');
    var end = Date.now() + mins * 60000;
    (function tick() {
      var s = Math.max(0, Math.round((end - Date.now()) / 1000));
      var hh = Math.floor(s / 3600), mm = Math.floor(s % 3600 / 60), ss = s % 60;
      b.textContent = toFa(pad2(hh) + ':' + pad2(mm) + ':' + pad2(ss));
      setTimeout(tick, 1000);
    })();
  }

  /* ---------- اطلاع موجودی (ناموجود) ---------- */
  function initNotify(card) {
    var btn = card.querySelector('.dz-pc__notify');
    if (!btn || btn.dataset.dzReady) return;
    btn.dataset.dzReady = '1';
    var pop = document.createElement('div'); pop.className = 'dz-pc__pop'; pop.hidden = true;
    pop.innerHTML =
      '<button type="button" class="dz-pc__x" aria-label="بستن"><i class="fa-solid fa-xmark"></i></button>' +
      '<div class="dz-pc__pop-in"><i class="fa-regular fa-bell"></i><div class="dz-pc__pop-h">خبرم کن وقتی موجود شد</div>' +
      '<p>شماره‌ات را بگذار تا به‌محض شارژ موجودی پیامک کنیم.</p>' +
      '<input type="tel" inputmode="tel" placeholder="۰۹۱۲ ۰۰۰ ۰۰۰۰">' +
      '<button type="button" class="dz-pc__pop-go">ثبت اطلاع‌رسانی</button></div>';
    card.appendChild(pop);
    btn.addEventListener('click', function () { pop.hidden = false; pop.classList.remove('in'); void pop.offsetWidth; pop.classList.add('in'); });
    pop.querySelector('.dz-pc__x').addEventListener('click', function () { pop.hidden = true; });
    pop.querySelector('.dz-pc__pop-go').addEventListener('click', function () {
      pop.querySelector('.dz-pc__pop-in').innerHTML =
        '<i class="fa-solid fa-circle-check" style="color:var(--green)"></i><div class="dz-pc__pop-h">ثبت شد</div>' +
        '<p>به‌محض موجود شدن به‌ت خبر می‌دهیم.</p>';
    });
  }

  /* ---------- دکمه افزودن → پنل وزن/بسته → استپر ---------- */
  function initAdd(add) {
    if (add.dataset.dzReady) return;
    add.dataset.dzReady = '1';
    var card = add.closest('.dz-pc');
    var foot = add.parentNode;

    var baseNew = parseFa(add.getAttribute('data-base-price') || (card && card.getAttribute('data-base-price')) || '0');
    var baseOld = parseFa((card && card.getAttribute('data-old-price')) || '0');
    var baseG = parseInt((card && card.getAttribute('data-grams')) || '0', 10);
    var wlabel = card && card.querySelector('.dz-pc__weight');
    if (!baseG && wlabel) baseG = /کیلو/.test(wlabel.textContent) ? parseFa(wlabel.textContent) * 1000 : parseFa(wlabel.textContent);
    var priceSpan = card && card.querySelector('.dz-pc__price');
    var oldSpan = card && card.querySelector('.dz-pc__price-old');
    if (!baseNew && priceSpan) baseNew = parseFa(priceSpan.firstChild.nodeValue);

    /* استپر تعداد */
    var qty = document.createElement('div'); qty.className = 'dz-pc__qty'; qty.hidden = true;
    qty.innerHTML =
      '<button type="button" class="dz-pc__inc" aria-label="افزایش">+</button>' +
      '<span class="dz-pc__n">۱</span>' +
      '<button type="button" class="dz-pc__dec" aria-label="کاهش">−</button>';
    foot.insertBefore(qty, add.nextSibling);
    var nEl = qty.querySelector('.dz-pc__n'), inc = qty.querySelector('.dz-pc__inc'), dec = qty.querySelector('.dz-pc__dec');
    var c = 0, armed = false;
    function render() { nEl.textContent = toFa(c); }
    function bump() { nEl.classList.remove('bump'); void nEl.offsetWidth; nEl.classList.add('bump'); }
    function arm() { armed = true; dec.classList.add('danger'); dec.innerHTML = '<i class="fa-solid fa-trash-can"></i>'; }
    function disarm() { armed = false; dec.classList.remove('danger'); dec.innerHTML = '−'; }
    function showStepper() { c = 1; render(); disarm(); qty.hidden = false; qty.classList.remove('in'); void qty.offsetWidth; qty.classList.add('in'); }
    inc.addEventListener('click', function () { if (armed) disarm(); c++; render(); bump(); });

    function setPrice(v) { if (priceSpan) priceSpan.firstChild.nodeValue = grp(v) + ' '; }
    function applyFactor(f, m) { m = m || 1; if (baseG && wlabel) setLabel(fmtG(baseG * f)); setPrice(baseNew * f * m); if (oldSpan) oldSpan.textContent = grp(baseOld * f * m); }
    function setLabel(txt) { if (!wlabel) return; var ic = wlabel.querySelector('i'); wlabel.textContent = ''; if (ic) wlabel.appendChild(ic); wlabel.appendChild(document.createTextNode(' ' + txt)); }

    var hasPanel = baseG > 0 && !!card;
    var sel = null, fSel = 1, mSel = 1, step1, step2, wq, wp, wpriceB, goB;
    var resetSteps = function () {};

    if (hasPanel) {
      sel = document.createElement('div'); sel.className = 'dz-pc__wsel'; sel.hidden = true;
      sel.innerHTML =
        '<button type="button" class="dz-pc__x dz-pc__wclose" aria-label="بستن"><i class="fa-solid fa-xmark"></i></button>' +
        '<div class="dz-pc__wstep" data-s="1"><div class="dz-pc__wh"><i class="fa-solid fa-box-open"></i> انتخاب وزن بسته‌بندی</div><div class="dz-pc__wopts wq"></div><div class="dz-pc__wsum">قیمت: <b></b> <span class="toman-mark"></span></div><button type="button" class="dz-pc__wnext js-wnext">ادامه <i class="fa-solid fa-chevron-left"></i></button></div>' +
        '<div class="dz-pc__wstep" data-s="2" hidden><div class="dz-pc__wh"><button type="button" class="dz-pc__wback" aria-label="بازگشت"><i class="fa-solid fa-chevron-right"></i></button> نوع بسته‌بندی</div><div class="dz-pc__wopts wp"></div><div class="dz-pc__wsum">جمع: <b></b> <span class="toman-mark"></span></div><button type="button" class="dz-pc__wnext js-wgo"><i class="fa-solid fa-cart-plus"></i> افزودن به سبد</button></div>';
      card.appendChild(sel);
      step1 = sel.querySelector('[data-s="1"]'); step2 = sel.querySelector('[data-s="2"]');
      wq = sel.querySelector('.wq'); wp = sel.querySelector('.wp');
      wpriceB = step1.querySelector('.dz-pc__wsum b'); goB = step2.querySelector('.dz-pc__wsum b');

      [1, 2, 4].forEach(function (f, i) {
        var b = document.createElement('button'); b.type = 'button'; b.className = 'dz-pc__wopt' + (i === 0 ? ' sel' : '');
        b.setAttribute('data-f', f);
        b.innerHTML = '<span class="dz-pc__wradio"></span><span class="dz-pc__wname">' + fmtG(baseG * f) + '</span>' +
          (i === 1 ? '<span class="dz-pc__wbest">پرفروش</span>' : '') +
          '<span class="dz-pc__wprice-row">' + grp(baseNew * f) + '</span>';
        wq.appendChild(b);
      });
      var packs = [{ k: 'اقتصادی', ic: 'fa-coins', m: 1 }, { k: 'وکیوم', ic: 'fa-compress', m: 1.05 }, { k: 'هدیه', ic: 'fa-gift', m: 1.18 }];
      packs.forEach(function (p, i) {
        var b = document.createElement('button'); b.type = 'button'; b.className = 'dz-pc__wopt' + (i === 0 ? ' sel' : '');
        b.setAttribute('data-m', p.m);
        b.innerHTML = '<span class="dz-pc__wradio"></span><span class="dz-pc__wname"><i class="fa-solid ' + p.ic + '"></i> ' + p.k + '</span><span class="dz-pc__wprice-row"></span>';
        wp.appendChild(b);
      });

      function setWprice(f) { if (wpriceB) wpriceB.textContent = grp(baseNew * f); }
      function setFinal() { if (goB) goB.textContent = grp(baseNew * fSel * mSel); }
      function updatePackPrices() {
        wp.querySelectorAll('.dz-pc__wopt').forEach(function (b) {
          var m = +b.getAttribute('data-m'); var d = Math.round(baseNew * fSel * (m - 1) / 5000) * 5000;
          b.querySelector('.dz-pc__wprice-row').textContent = d > 0 ? grp(d) : 'رایگان';
        });
      }
      function reanim() { sel.classList.remove('in'); void sel.offsetWidth; sel.classList.add('in'); }
      resetSteps = function () {
        step2.hidden = true; step1.hidden = false;
        wq.querySelectorAll('.dz-pc__wopt').forEach(function (x, i) { x.classList.toggle('sel', i === 0); });
        wp.querySelectorAll('.dz-pc__wopt').forEach(function (x, i) { x.classList.toggle('sel', i === 0); });
        fSel = 1; mSel = 1; setWprice(1);
      };
      setWprice(1);

      wq.querySelectorAll('.dz-pc__wopt').forEach(function (b) {
        b.addEventListener('mouseenter', function () { setWprice(+b.getAttribute('data-f')); });
        b.addEventListener('mouseleave', function () { var s = wq.querySelector('.dz-pc__wopt.sel'); setWprice(s ? +s.getAttribute('data-f') : fSel); });
        b.addEventListener('click', function () {
          wq.querySelectorAll('.dz-pc__wopt').forEach(function (x) { x.classList.remove('sel'); }); b.classList.add('sel');
          fSel = +b.getAttribute('data-f'); setWprice(fSel);
        });
      });
      sel.querySelector('.js-wnext').addEventListener('click', function () { updatePackPrices(); setFinal(); step1.hidden = true; step2.hidden = false; reanim(); });
      wp.querySelectorAll('.dz-pc__wopt').forEach(function (b) {
        b.addEventListener('click', function () {
          wp.querySelectorAll('.dz-pc__wopt').forEach(function (x) { x.classList.remove('sel'); }); b.classList.add('sel');
          mSel = +b.getAttribute('data-m'); setFinal();
        });
      });
      sel.querySelector('.js-wgo').addEventListener('click', function () { applyFactor(fSel, mSel); sel.hidden = true; showStepper(); });
      sel.querySelector('.dz-pc__wback').addEventListener('click', function () { step2.hidden = true; step1.hidden = false; reanim(); });
      sel.querySelector('.dz-pc__wclose').addEventListener('click', function () {
        sel.hidden = true; resetSteps(); applyFactor(1, 1);
        add.style.display = ''; add.style.animation = 'dzQtyIn .3s'; setTimeout(function () { add.style.animation = ''; }, 320);
      });
    }

    add.addEventListener('click', function () {
      add.classList.add('out');
      setTimeout(function () {
        add.style.display = 'none'; add.classList.remove('out');
        if (hasPanel) { resetSteps(); sel.hidden = false; sel.classList.remove('in'); void sel.offsetWidth; sel.classList.add('in'); }
        else { showStepper(); }
      }, 180);
    });

    dec.addEventListener('click', function () {
      if (c > 1) { c--; render(); bump(); return; }
      if (!armed) { arm(); return; }
      c = 0; qty.hidden = true; disarm();
      if (hasPanel) applyFactor(1, 1);
      add.style.display = ''; add.style.animation = 'dzQtyIn .3s'; setTimeout(function () { add.style.animation = ''; }, 320);
    });
  }

  function init(root) {
    root = root || document;
    root.querySelectorAll('.dz-pc__fav').forEach(initFav);
    root.querySelectorAll('.dz-pc').forEach(function (card) {
      initTimer(card);
      if (card.classList.contains('dz-pc--oos')) { initNotify(card); }
      else { card.querySelectorAll('.dz-pc__add').forEach(initAdd); }
    });
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', function () { init(); });
  else init();
  window.dzProductCardInit = init;
})();
