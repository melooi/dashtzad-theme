<?php
/**
 * Template Name: ورود به حساب کاربری
 * Description: صفحه ورود با پیامک (OTP) و نام کاربری
 */

// اگر کاربر لاگین است، redirect به داشبورد
if ( is_user_logged_in() ) {
    wp_redirect( wc_get_account_endpoint_url( 'dashboard' ) );
    exit;
}

get_header( 'main' );
?>

<main id="dz-main" class="dz-login-screen">
  <div class="dz-login-card">

    <!-- برند -->
    <div class="dz-lc-brand">
      <div>
        <div class="dz-lc-name"><?php bloginfo( 'name' ); ?></div>
        <div class="dz-lc-tag"><?php bloginfo( 'description' ); ?></div>
      </div>
      <div class="dz-lc-seal" aria-hidden="true">د</div>
    </div>

    <!-- تب‌های روش ورود -->
    <div class="dz-tabs" role="tablist">
      <button type="button" role="tab" id="dzTabOtp" class="dz-tab is-active"
        onclick="dzSwitchTab('otp')" aria-selected="true" aria-controls="dzPanelOtp">
        <?php echo dz_icon( 'mobile' ); ?> پیامکی
      </button>
      <button type="button" role="tab" id="dzTabPass" class="dz-tab"
        onclick="dzSwitchTab('pass')" aria-selected="false" aria-controls="dzPanelPass">
        <?php echo dz_icon( 'user' ); ?> نام کاربری
      </button>
    </div>

    <!-- ===== پانل OTP ===== -->
    <div id="dzPanelOtp" role="tabpanel">

      <!-- گام ۱: شماره موبایل -->
      <div id="dzLsPhone" class="dz-lc-step">
        <h1 class="dz-lc-title">ورود به <?php bloginfo( 'name' ); ?></h1>
        <p class="dz-lc-sub">شماره موبایل خود را وارد کنید تا کد تایید برایتان ارسال شود.</p>
        <div class="dz-lc-phonewrap">
          <?php echo dz_icon( 'mobile' ); ?>
          <label class="dz-sr-only" for="dzPhone">شماره موبایل</label>
          <input type="tel" id="dzPhone" inputmode="numeric" maxlength="11"
            placeholder="۰۹۱۲ ۳۴۵ ۶۷۸۹" autocomplete="tel">
        </div>
        <p class="dz-field__err" id="dzPhoneErr" aria-live="polite"></p>
        <button type="button" class="dz-btn dz-btn--primary dz-btn--block dz-btn--lg"
          id="dzSendOtp" onclick="dzSendOtp()">
          <?php echo dz_icon( 'paper-plane' ); ?> ارسال کد تایید
        </button>
        <div class="dz-lc-divider">یا</div>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
          class="dz-btn dz-btn--ghost dz-btn--block">
          ادامه به‌عنوان مهمان <?php echo dz_icon( 'arrow-left' ); ?>
        </a>
        <p class="dz-lc-legal">با ورود، <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'terms' ) ) ); ?>">قوانین و مقررات</a> دشت‌زاد را می‌پذیرم.</p>
      </div>

      <!-- گام ۲: کد تایید OTP -->
      <div id="dzLsOtp" class="dz-lc-step" hidden>
        <div class="dz-lc-echowrap">
          <?php echo dz_icon( 'mobile' ); ?>
          <span>کد به <b id="dzPhoneEcho" class="num"></b> ارسال شد</span>
          <button type="button" onclick="dzEditPhone()">ویرایش</button>
        </div>
        <h2 class="dz-lc-title">کد تایید را وارد کنید</h2>
        <div class="dz-otp" id="dzOtp" dir="ltr">
          <input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۱ کد" autocomplete="one-time-code">
          <input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۲ کد">
          <input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۳ کد">
          <input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۴ کد">
          <input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۵ کد">
        </div>
        <p class="dz-field__err" id="dzOtpErr" aria-live="polite"></p>
        <div class="dz-resend-row">
          <span>اعتبار کد: <b id="dzTimer" class="num" style="color:var(--color-dz-clay)">۰۲:۰۰</b></span>
          <button type="button" id="dzResend" disabled onclick="dzResendOtp()">ارسال دوباره</button>
        </div>
        <button type="button" class="dz-btn dz-btn--primary dz-btn--block dz-btn--lg"
          onclick="dzVerifyOtp()">
          <?php echo dz_icon( 'arrow-left-to-bracket' ); ?> ورود به حساب
        </button>
      </div>

    </div><!-- /dzPanelOtp -->

    <!-- ===== پانل نام کاربری ===== -->
    <div id="dzPanelPass" role="tabpanel" hidden>
      <div class="dz-lc-step" style="display:flex">
        <h2 class="dz-lc-title">ورود با نام کاربری</h2>
        <p class="dz-lc-sub">نام کاربری یا ایمیل و رمز عبور خود را وارد کنید.</p>

        <form id="dzLoginForm" method="post" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>">
          <?php wp_nonce_field( 'dz-login', 'dz_login_nonce' ); ?>
          <input type="hidden" name="redirect_to" value="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>">

          <div class="dz-lc-field">
            <?php echo dz_icon( 'user' ); ?>
            <input type="text" id="dzUsername" name="log" placeholder="نام کاربری یا ایمیل"
              autocomplete="username" dir="ltr" style="text-align:right">
          </div>
          <div class="dz-lc-field">
            <i class="fa-solid fa-eye" id="dzEyeIcon" style="cursor:pointer"
              onclick="dzTogglePass()" aria-hidden="true"></i>
            <input type="password" id="dzLoginPass" name="pwd" placeholder="رمز عبور"
              autocomplete="current-password" dir="ltr" style="text-align:right">
          </div>
          <p class="dz-field__err" id="dzPassErr" aria-live="polite"></p>

          <div style="display:flex;justify-content:flex-start">
            <button type="button" onclick="dzToggleForgot()"
              style="font-size:1.35rem;font-weight:700;color:var(--color-dz-primary);background:none;border:none;cursor:pointer;font-family:inherit;padding:0">
              فراموشی رمز عبور
            </button>
          </div>

          <!-- بازیابی رمز -->
          <div id="dzForgotWrap" class="dz-forgot-wrap" hidden>
            <p style="font-size:1.4rem;font-weight:700;color:var(--color-dz-ink);margin:0">
              <?php echo dz_icon( 'key' ); ?> بازیابی رمز عبور
            </p>
            <p style="font-size:1.3rem;color:var(--color-dz-ink-soft);margin:0">شماره موبایل ثبت‌شده را وارد کنید — کد بازیابی پیامک می‌شود.</p>
            <div class="dz-lc-field">
              <?php echo dz_icon( 'mobile' ); ?>
              <input type="tel" id="dzForgotPhone" inputmode="numeric" maxlength="11"
                placeholder="۰۹۱۲ ۳۴۵ ۶۷۸۹" autocomplete="tel">
            </div>
            <p class="dz-field__err" id="dzForgotErr" aria-live="polite"></p>
            <div style="display:flex;gap:.8rem">
              <button type="button" class="dz-btn dz-btn--primary" onclick="dzSendForgot()" style="flex:1">
                <?php echo dz_icon( 'paper-plane' ); ?> ارسال کد بازیابی
              </button>
              <button type="button" class="dz-btn dz-btn--ghost"
                onclick="document.getElementById('dzForgotWrap').hidden=true">انصراف</button>
            </div>
          </div>

          <button type="submit" class="dz-btn dz-btn--primary dz-btn--block dz-btn--lg">
            <?php echo dz_icon( 'arrow-left-to-bracket' ); ?> ورود به حساب
          </button>
        </form>

        <div class="dz-lc-divider">یا</div>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
          class="dz-btn dz-btn--ghost dz-btn--block">
          ادامه به‌عنوان مهمان <?php echo dz_icon( 'arrow-left' ); ?>
        </a>
        <p class="dz-lc-legal">با ورود، <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'terms' ) ) ); ?>">قوانین و مقررات</a> دشت‌زاد را پذیرفته‌اید.</p>
      </div>
    </div><!-- /dzPanelPass -->

  </div><!-- /.dz-login-card -->
</main>

<script>
(function(){
  function toEn(s){ return String(s).replace(/[۰-۹]/g,function(d){ return d.charCodeAt(0)-1776; }); }
  function toFa(n){ return String(n).replace(/\d/g,function(d){ return String.fromCharCode(d.charCodeAt(0)+1728); }); }

  window.dzSwitchTab = function(tab){
    var isOtp = tab==='otp';
    ['Otp','Pass'].forEach(function(t){
      var active = (t==='Otp') === isOtp;
      document.getElementById('dzTab'+t).classList.toggle('is-active', active);
      document.getElementById('dzTab'+t).setAttribute('aria-selected', active);
      document.getElementById('dzPanel'+t).hidden = !active;
    });
  };

  window.dzSendOtp = function(){
    var phone = toEn(document.getElementById('dzPhone').value.trim());
    var err = document.getElementById('dzPhoneErr');
    if(!phone || phone.length < 11 || !phone.startsWith('09')){
      err.textContent = 'شماره موبایل معتبر نیست'; return;
    }
    err.textContent = '';
    document.getElementById('dzPhoneEcho').textContent = document.getElementById('dzPhone').value.trim();
    document.getElementById('dzLsPhone').hidden = true;
    document.getElementById('dzLsOtp').hidden = false;
    dzStartTimer();
    setTimeout(function(){ document.getElementById('dzOtp').querySelector('input').focus(); }, 100);
    // AJAX به wp-admin/admin-ajax.php برای ارسال OTP
    fetch('<?php echo esc_url( admin_url( "admin-ajax.php" ) ); ?>', {
      method:'POST',
      headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body:'action=dz_send_otp&phone='+encodeURIComponent(phone)+'&nonce=<?php echo wp_create_nonce("dz_otp"); ?>'
    }).catch(function(){});
  };

  window.dzEditPhone = function(){
    document.getElementById('dzLsOtp').hidden = true;
    document.getElementById('dzLsPhone').hidden = false;
    clearInterval(dzTimerInterval);
  };

  var dzTimerInterval, dzTimerSecs = 120;
  window.dzStartTimer = function(){
    clearInterval(dzTimerInterval); dzTimerSecs = 120;
    var btn = document.getElementById('dzResend');
    btn.disabled = true;
    dzTimerInterval = setInterval(function(){
      dzTimerSecs--;
      var m = Math.floor(dzTimerSecs/60), s = dzTimerSecs%60;
      document.getElementById('dzTimer').textContent = toFa(String(m).padStart(2,'0'))+':'+toFa(String(s).padStart(2,'0'));
      if(dzTimerSecs<=0){ clearInterval(dzTimerInterval); btn.disabled=false; document.getElementById('dzTimer').textContent=''; }
    },1000);
  };

  window.dzResendOtp = function(){
    dzStartTimer();
    document.getElementById('dzOtpErr').textContent='';
    document.querySelectorAll('#dzOtp input').forEach(function(i){ i.value=''; i.classList.remove('is-filled'); });
    document.getElementById('dzOtp').querySelector('input').focus();
  };

  window.dzVerifyOtp = function(){
    var code = Array.from(document.querySelectorAll('#dzOtp input')).map(function(i){ return toEn(i.value); }).join('');
    var err = document.getElementById('dzOtpErr');
    if(code.length<5){ err.textContent='کد ۵ رقمی را وارد کنید'; return; }
    err.textContent='';
    fetch('<?php echo esc_url( admin_url( "admin-ajax.php" ) ); ?>', {
      method:'POST',
      headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body:'action=dz_verify_otp&phone='+encodeURIComponent(toEn(document.getElementById('dzPhoneEcho').textContent))+'&code='+encodeURIComponent(code)+'&nonce=<?php echo wp_create_nonce("dz_otp"); ?>'
    }).then(function(r){ return r.json(); }).then(function(d){
      if(d.success) window.location.href = d.data.redirect || '<?php echo esc_url( wc_get_account_endpoint_url("dashboard") ); ?>';
      else err.textContent = d.data.message || 'کد وارد شده صحیح نیست';
    }).catch(function(){ err.textContent='خطا در ارتباط با سرور'; });
  };

  window.dzTogglePass = function(){
    var inp = document.getElementById('dzLoginPass'), ico = document.getElementById('dzEyeIcon');
    if(inp.type==='password'){ inp.type='text'; ico.className='fa-solid fa-eye-slash'; }
    else { inp.type='password'; ico.className='fa-solid fa-eye'; }
  };

  window.dzToggleForgot = function(){
    var w = document.getElementById('dzForgotWrap'); w.hidden=!w.hidden;
  };

  window.dzSendForgot = function(){
    var phone = toEn(document.getElementById('dzForgotPhone').value.trim());
    var err = document.getElementById('dzForgotErr');
    if(!phone||phone.length<11){ err.textContent='شماره موبایل معتبر نیست'; return; }
    err.textContent='';
    document.getElementById('dzForgotWrap').hidden=true;
  };

  /* OTP digit navigation */
  document.addEventListener('DOMContentLoaded',function(){
    var inputs = document.querySelectorAll('#dzOtp input');
    inputs.forEach(function(inp,i){
      inp.addEventListener('input',function(){
        var v = toEn(inp.value).replace(/\D/g,'');
        inp.value = v ? toFa(v) : '';
        inp.classList.toggle('is-filled',!!v);
        if(v && i<inputs.length-1) inputs[i+1].focus();
      });
      inp.addEventListener('keydown',function(e){
        if(e.key==='Backspace'&&!inp.value&&i>0) inputs[i-1].focus();
      });
    });
  });
})();
</script>

<?php get_footer( 'main' ); ?>
