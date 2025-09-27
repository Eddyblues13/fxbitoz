<script>
  document.addEventListener('DOMContentLoaded', function() {
      const planSelect = document.getElementById('plan-select');
      const amountInput = document.getElementById('amount');
      const dailyProfit = document.getElementById('daily');
      const weeklyProfit = document.getElementById('weekly');
      const monthlyProfit = document.getElementById('monthly');
      const totalProfit = document.getElementById('total');
      const errorElement = document.getElementById('error');
      
      function updateCalculator() {
          const selectedPlan = planSelect.options[planSelect.selectedIndex];
          const dailyPercent = parseFloat(selectedPlan.getAttribute('data-percent'));
          const amount = parseFloat(amountInput.value);
          
          // Get min/max from selected plan
          const minAmount = parseFloat(amountInput.min);
          const maxAmount = parseFloat(amountInput.max);
          
          // Validate amount
          if (isNaN(amount) || amount < minAmount || amount > maxAmount) {
              errorElement.textContent = `Amount must be between $${minAmount} and $${maxAmount}`;
              dailyProfit.textContent = '-';
              weeklyProfit.textContent = '-';
              monthlyProfit.textContent = '-';
              totalProfit.textContent = '-';
              return;
          }
          
          errorElement.textContent = '';
          
          // Calculate profits
          const daily = (amount * dailyPercent / 100).toFixed(2);
          const weekly = (daily * 7).toFixed(2);
          const monthly = (daily * 30).toFixed(2);
          const total = (daily * {{ $plans->first()->duration_days ?? 30 }}).toFixed(2);
          
          // Update display
          dailyProfit.textContent = '$' + daily;
          weeklyProfit.textContent = '$' + weekly;
          monthlyProfit.textContent = '$' + monthly;
          totalProfit.textContent = '$' + total;
      }
      
      // Update min/max when plan changes
      planSelect.addEventListener('change', function() {
          const selectedPlanId = this.value;
          // In a real app, you would fetch the plan details via AJAX or have them in data attributes
          // For this example, we'll use the first plan's values
          amountInput.min = {{ $plans->first()->min_investment }};
          amountInput.max = {{ $plans->first()->max_investment }};
          updateCalculator();
      });
      
      amountInput.addEventListener('input', updateCalculator);
      updateCalculator();
      
      // Tab functionality for commission info
      const depositItems = document.querySelectorAll('.deposits-item');
      const commissionInfos = document.querySelectorAll('[data-deposit]');
      
      depositItems.forEach(item => {
          item.addEventListener('click', function() {
              const planName = this.getAttribute('deposit');
              
              // Hide all commission info
              commissionInfos.forEach(info => {
                  info.style.display = 'none';
              });
              
              // Show selected plan's commission info
              const selectedInfo = document.querySelector(`[data-deposit="${planName}"]`);
              if (selectedInfo) {
                  selectedInfo.style.display = 'block';
              }
          });
      });
  });
</script>
<footer class="footer">
  <div class="container">
    <div class="footer__row">
      <div class="footer__col">
        <div class="footer__nav-row">
          <div class="footer__nav-col">
            <h4 class="footer-title">Menu </h4>
            <ul class="footer__nav">
              <li><a href="{{ url('/about') }}">About us </a></li>
              <li><a href="{{ url('/investments') }}">Investments</a></li>
              <li><a href="{{ url('/faq') }}l">FAQ</a></li>
              <li><a href="{{ url('/contact') }}">Contacts</a></li>
            </ul>
          </div>
          <div class="footer__nav-col">
            <h4 class="footer-title">Actions </h4>
            <ul class="footer__nav">

              <li><a class="text-gradient-strong" href="{{ url('/login') }}">Make a Deposit</a></li>
              <li><a class="text-gradient-strong" href="{{ url('/login') }}">Statistics</a></li>
              <li><a class="text-gradient-strong" href="{{ url('/login') }}">Login</a></li>
            </ul>
          </div>
          <div class="footer__nav-col hidden-sm">
            <h4 class="footer-title">Email</h4>
            <ul class="footer__nav">
              <li>support@fxbitozglobal.com</li>

            </ul>
          </div>
        </div>
      </div>
      <div class="footer__col">
        <div class="follow">
          <!-- <h4 class="footer-title">Follow us on social media: -->
          </h4>

        </div>
      </div>
    </div>

    <div class="footer__bottom">
      <p>&copy; Copyright, <span>2024</span> fxbitozglobal.com All Rights Reserved</p>
      <ul>
        <li><a href="#">Privacy Policy</a></li>
    </div>
  </div>
</footer>
</div>
</div>
<!-- End page  -->
</article>
<!-- Right bar-->
<div class="bar">
  <div class="bar__menu-btn">
    <div class="hamburger"><span class="bar"></span><span class="bar"></span><span class="bar"></span></div>
  </div>

</div>
<!-- Mega menu-->
<div class="mega-menu">
  <div class="container">
    <div class="mega-menu__top"> <a class="mega-menu__logo" href="{{ url('/') }}"><img
          src="storage/app/public/photos/photos/Nv6MZojh34tyRGB5CIGvEvhk3GjrNuP36Cte8Sy5.html" alt=""></a>
    </div>
    <div class="mega-menu__row">
      <div class="mega-menu__col">
        <div class="mega-menu__center">
          <nav class="mega-menu__nav">
            <ul>
              <li class=" is-active"><a href="{{ url('/') }}">Home page </a></li>
              <li><a href="{{ url('/about') }}">About us</a></li>
              <li><a href="{{ url('/investments') }}">Investments</a></li>
              <li><a href="{{ url('/faq') }}l">FAQ</a></li>
              <li><a href="{{ url('/contact') }}">Contacts</a></li>
              <li><a href="{{ url('/how-to-buy-crypto') }}">How to buy crypto</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="mega-menu__col">
        <div class="mega-menu__center"><a class="link-icon" href="{{ url('/register') }}">
            <svg class="svg-icon">


              <svg class="svg-icon">
                <use href="temp/custom/assets/icons/sprite.svg#icon-002-wallet"></use>
              </svg><span>Registration</span></a><a class="link-icon" href="{{ url('/register') }}">
            <svg class="svg-icon">
              <use href="assets/icons/sprite.html#icon-003-shield"></use>
            </svg><span>Login </span></a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Mobile menu-->
<div class="mobile-menu">
  <div class="mobile-menu__top"><a class="link-icon" href="/register">
      <svg class="svg-icon">
        <use href="temp/custom/assets/icons/sprite.svg#icon-001-profits"></use>

        <svg class="svg-icon">
          <use href="temp/custom/assets/icons/sprite.svg#icon-002-wallet"></use>
        </svg><span>Registration</span></a><a class="link-icon" href="{{ url('/register') }}">
      <svg class="svg-icon">
        <use href="temp/custom/assets/icons/sprite.svg#icon-003-shield"></use>
      </svg><span>Login </span></a>
  </div>
  <nav class="mobile-menu__nav">
    <ul>
      <li><a href="{{ url('/') }}">Home page </a></li>
      <li><a href="{{ url('/about') }}">About us</a></li>
      <li><a href="{{ url('/investments') }}">Investments</a></li>
      <li><a href="{{ url('/faq') }}">FAQ</a></li>
      <li><a href="{{ url('/contact') }}">Contacts</a></li>

    </ul>
  </nav>



</div>
</div>
<!-- Modals-->
<!-- success-->
<div class="modal" id="success">
  <div class="modal-inner">
    <div class="modal-inner__close js-close-modal">
      <svg class="svg-icon">
        <use href="temp/custom/assets/icons/sprite.svg#icon-cross"></use>
      </svg>
    </div>
    <div class="modal-header">
      <h3 class="title">Success! </h3>
    </div>
    <div class="modal-content">
      <div class="typography">
        <p id='infs'></p>
      </div>
      <div class="modal-icon"> <img src="temp/custom/assets/images/check-line.svg" alt="">
      </div>
    </div>
    <div class="modal-footer modal-footer--center">
      <button class="btn btn--primary js-close-modal">Close </button>
    </div>
  </div>
</div>
<!-- error-->
<div class="modal" id="error">
  <div class="modal-inner">
    <div class="modal-inner__close js-close-modal">
      <svg class="svg-icon">
        <use href="temp/custom/assets/icons/sprite.svg#icon-cross"></use>
      </svg>
    </div>
    <div class="modal-header">
      <h3 class="title">Error! </h3>
    </div>
    <div class="modal-content">
      <div class="typography">
        <p id='inf'></p>
      </div>
      <div class="modal-icon"> <img src="temp/custom/assets/images/cross-line.svg" alt="">
      </div>
    </div>
    <div class="modal-footer modal-footer--center">
      <button class="btn btn--primary js-close-modal">Close </button>

    </div>
  </div>


</div>
<!-- gradient all svg-->
<svg class="primary-gradient">
  <lineargradient id="primary-gradient">
    <stop offset="0%" stop-color="#49ecdd"></stop>
    <stop offset="100%" stop-color="#94d472"></stop>
  </lineargradient>
</svg>
</main>


<script src="temp/custom/assets/js/app.js"></script>
<script src="code.createjs.com/createjs-2015.11.26.min.html"></script>
<script src="temp/custom/indexAnimate.js"></script>

<div class="last-widget">
  <!-- TradingView Widget BEGIN -->

  <div
    style="height:62px; background-color: #1D2330; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38;padding:1px;padding: 0px; margin: 0px; width: 100%;">
    <div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe
        src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=dark&amp;pref_coin_id=1505&amp;invert_hover=no"
        width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0"
        style="border:0;margin:0;padding:0;"></iframe></div>
    <div
      style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
      <a href="https://coinlib.io/" target="_blank"
        style="font-weight: 500; color: #626B7F; text-decoration:none; font-size:11px"></a>
    </div>
  </div>




  <script type="text/javascript">
    {}
  </script>
</div>

<link rel="stylesheet" href="temp/custom/resource/views/home/home4/alert/css/fake-notification-min.css">
<link rel="stylesheet" href="temp/custom/resource/views/home/home4/alert/css/animate.min.css">
<link rel="stylesheet" href="temp/custom/resource/views/home/home4/alert/css/font-awesome.min.css">
</body>

</html>