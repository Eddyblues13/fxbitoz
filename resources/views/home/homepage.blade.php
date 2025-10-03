@include('home.header');

<article class="main-layout__content">
  <!-- Begin page-->
  <!---->
  <section class="intro auth-layout">
    <div class="container">
      <div class="intro__row">
        <div class="intro__col"> <img class="intro__robot" src="temp/custom/assets/images/intro/robot.png" alt=""
            role="presentation" />
        </div>
        <div class="intro__col">
          <div class="intro__content">
            <h1 class="intro__title">Safe investment with Us <span class="intro-bremby"> </span>
            </h1>
            <div class="intro__description">
              <p><span class="color-primary">GET</span> LIFETIME INCOME ON INVESTMENT</p>
            </div>


            <a class="btn btn--primary" href="/register">Register</a>
            <a class="btn btn--primary" href="/login">Login</a>

            <ul class="intro-icons">
              <li>
                <div class="intro-icons__icon" style="width: 100%;">
                  <svg class="svg-icon">
                    <use href="temp/custom/assets/icons/sprite.svg#icon-002-blockchain-1"></use>
                  </svg>
                </div>
                <div class="intro-icons__description" style="text-align: center;">
                  <p>Professional Crypto Industry Development Team </p>
                </div>
              </li>
              <li>
                <div class="intro-icons__icon" style="width: 100%;">
                  <svg class="svg-icon">
                    <use href="temp/custom/assets/icons/sprite.svg#icon-001-blockchain"></use>
                  </svg>
                </div>
                <div class="intro-icons__description" style="text-align: center;">
                  <p>Unique robot for trading </p>
                </div>
              </li>
              <li>
                <div class="intro-icons__icon" style="width: 100%;">
                  <svg class="svg-icon">
                    <use href="temp/custom/assets/icons/sprite.svg#icon-003-user"></use>
                  </svg>
                </div>
                <div class="intro-icons__description" style="text-align: center;">
                  <p>Manage operations without user intervention</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="intro__bg">
      <div id="animation_container" style="background-color:rgba(0, 0, 153, 0.00); width:1900px; height:858px">
        <canvas id="canvas" width="1900" height="858"
          style="position: absolute; display: block; background-color:rgba(0, 0, 153, 0.00);"></canvas>
        <div id="dom_overlay_container"
          style="pointer-events:none; overflow:hidden; width:1900px; height:858px; position: absolute; left: 0px; top: 0px; display: block;">
        </div>
      </div>
    </div>
  </section>
  </section>


  <section class="deposits">
    <div class="container container-large">
      <div class="section-intro">
        <h3 class="title">Investment Proposals</h3>
        <div class="section-intro__description">
          <p style="margin-top: -20px;">fxbitozglobal.com employees ensure that every investor in our company can earn
            money
          </p>
        </div>
      </div>
      <div class="deposits__block">
        <div class="investment-plans-container">
          @foreach($plans as $plan)
          <div class="investment-plan">
            <span class="plan-label {{ strtolower($plan->name) }}">{{ $plan->name }}</span>
            <h1 class="plan-title">{{ $plan->title }}</h1>
            <h2 class="plan-subtitle">{{ $plan->hourly_return }}</h2>

            <div class="plan-details">
              <table>
                <tr>
                  <td>Investment</td>
                  <td>${{ number_format($plan->min_investment) }}-${{ number_format($plan->max_investment) }}</td>
                </tr>
                <tr>
                  <td>Capital Back</td>
                  <td>{{ $plan->capital_back ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                  <td>Return Type</td>
                  <td>{{ $plan->return_type }}</td>
                </tr>
                <tr>
                  <td>Number of Period</td>
                  <td>{{ $plan->number_of_periods }} Times</td>
                </tr>
                @if($plan->profit_withdrawal)
                <tr>
                  <td>Profit Withdraw</td>
                  <td>{{ $plan->profit_withdrawal }}</td>
                </tr>
                @endif
                @if($plan->cancellation_policy)
                <tr>
                  <td>Cancel</td>
                  <td>{{ $plan->cancellation_policy }}</td>
                </tr>
                @endif
              </table>

              @if(!$plan->profit_holidays)
              <p class="plan-note">* No Profit Holidays</p>
              @endif

              <div class="divider"></div>

              <a href="/login" class="invest-now-btn">INVEST NOW</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <script src="temp/custom/js/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
	
//Calculator
function calc(n){

select = document.getElementById("selectid");
tar = select.value;

alert;
var okrs	= [2];


 minMoneyur2 = 1000;
 
 minMoneyu2 = (1000);
 maxMoneyu2 = (5000);
 
valut = "USD";


 minMoneyur3 = 5000;
 
 minMoneyu3 = (5000);
 maxMoneyu3 = (250000);
 
valut = "USD";


 minMoneyur4 = 10000;
 
 minMoneyu4 = (10000);
 maxMoneyu4 = (100000);
 
valut = "USD";




		

	if(tar == 2){
		
var percent 	= [0.018];
		

		minMoneyr = minMoneyur2;
		minMoney = minMoneyu2;
		maxMoney = maxMoneyu2;
	
	}
	if(tar == 3){
		
var percent 	= [0.025];
		

		minMoneyr = minMoneyur3;
		minMoney = minMoneyu3;
		maxMoney = maxMoneyu3;
	
	}
	if(tar == 4){
		
var percent 	= [0.033];
		

		minMoneyr = minMoneyur4;
		minMoney = minMoneyu4;
		maxMoney = maxMoneyu4;
	
	}

	
	
		if(!n){
			document.getElementById("sum").value = minMoneyr; 
		}
		
		if(parseFloat($("#sum").val())<minMoney){
	$("#eror").text("Min: " + minMoney +"");
		}else if(parseFloat($("#sum").val())>maxMoney){
	$("#eror").text("Max: " + maxMoney +"");
		}else if(parseFloat($("#sum").val())<=maxMoney){
	$("#eror").text("");
		}
			


	amount = parseFloat($("#sum").val());
		
			daily = amount * percent;
			daily = daily.toFixed(okrs);
			weekly = daily * 7;
			weekly = weekly.toFixed(okrs);
			mountly = daily * 30;
			mountly = mountly.toFixed(okrs);

			if(amount < minMoney || isNaN(amount) == true){
				$("#daily").text("-");
				$("#weekly").text("-");
				$("#mountly").text("-");
				
			} else {			
				$("#daily").html(daily +'<sub> '+ valut +' </sub>');
				$("#weekly").html(weekly +'<sub> '+ valut +' </sub>');
				$("#mountly").html(mountly +'<sub> '+ valut +' </sub>');
			}

			

	}
	

	
	if($("#sum, #selectid").change){
		calc(false);
	}
	$("#sum").keyup(function(){
		calc(true);
	});
	$("#selectid").click(function(){
		calc(false);
	});
	$("#selectid").change(function(){
		calc(false);
	});
}); 
  </script>



  <style>
    .steps .steps-item {
      text-align: center;
    }
  </style>

  <!-- TradingView Widget BEGIN -->
  <div class="tradingview-widget-container " data-aos="fade-up" style="width: 100%; height: 500px;">
    <iframe scrolling="no" allowtransparency="true" frameborder="0"
      src="https://s.tradingview.com/embed-widget/market-overview/?locale=en#%7B%22colorTheme%22%3A%22dark%22%2C%22dateRange%22%3A%2212m%22%2C%22showChart%22%3Atrue%2C%22largeChartUrl%22%3A%22%22%2C%22isTransparent%22%3Atrue%2C%22width%22%3A%22100%25%22%2C%22height%22%3A500%2C%22plotLineColorGrowing%22%3A%22rgba(65%2C%20224%2C%20136%2C%201)%22%2C%22plotLineColorFalling%22%3A%22rgba(65%2C%20224%2C%20136%2C%201)%22%2C%22gridLineColor%22%3A%22rgba(65%2C%20224%2C%20136%2C%201)%22%2C%22scaleFontColor%22%3A%22rgba(65%2C%20224%2C%20136%2C%201)%22%2C%22belowLineFillColorGrowing%22%3A%22rgba(65%2C%20224%2C%20136%2C%200.12)%22%2C%22belowLineFillColorFalling%22%3A%22rgba(65%2C%20224%2C%20136%2C%200.12)%22%2C%22symbolActiveColor%22%3A%22rgba(65%2C%20224%2C%20136%2C%200.12)%22%2C%22tabs%22%3A%5B%7B%22title%22%3A%22Indices%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22OANDA%3ASPX500USD%22%2C%22d%22%3A%22S%26P%20500%22%7D%2C%7B%22s%22%3A%22OANDA%3ANAS100USD%22%2C%22d%22%3A%22Nasdaq%20100%22%7D%2C%7B%22s%22%3A%22FOREXCOM%3ADJI%22%2C%22d%22%3A%22Dow%2030%22%7D%2C%7B%22s%22%3A%22INDEX%3ANKY%22%2C%22d%22%3A%22Nikkei%20225%22%7D%2C%7B%22s%22%3A%22INDEX%3ADEU30%22%2C%22d%22%3A%22DAX%20Index%22%7D%2C%7B%22s%22%3A%22OANDA%3AUK100GBP%22%2C%22d%22%3A%22FTSE%20100%22%7D%5D%2C%22originalTitle%22%3A%22Indices%22%7D%2C%7B%22title%22%3A%22Commodities%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22CME_MINI%3AES1!%22%2C%22d%22%3A%22E-Mini%20S%26P%22%7D%2C%7B%22s%22%3A%22CME%3A6E1!%22%2C%22d%22%3A%22Euro%22%7D%2C%7B%22s%22%3A%22COMEX%3AGC1!%22%2C%22d%22%3A%22Gold%22%7D%2C%7B%22s%22%3A%22NYMEX%3ACL1!%22%2C%22d%22%3A%22Crude%20Oil%22%7D%2C%7B%22s%22%3A%22NYMEX%3ANG1!%22%2C%22d%22%3A%22Natural%20Gas%22%7D%2C%7B%22s%22%3A%22CBOT%3AZC1!%22%2C%22d%22%3A%22Corn%22%7D%5D%2C%22originalTitle%22%3A%22Commodities%22%7D%2C%7B%22title%22%3A%22Bonds%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22CME%3AGE1!%22%2C%22d%22%3A%22Eurodollar%22%7D%2C%7B%22s%22%3A%22CBOT%3AZB1!%22%2C%22d%22%3A%22T-Bond%22%7D%2C%7B%22s%22%3A%22CBOT%3AUB1!%22%2C%22d%22%3A%22Ultra%20T-Bond%22%7D%2C%7B%22s%22%3A%22EUREX%3AFGBL1!%22%2C%22d%22%3A%22Euro%20Bund%22%7D%2C%7B%22s%22%3A%22EUREX%3AFBTP1!%22%2C%22d%22%3A%22Euro%20BTP%22%7D%2C%7B%22s%22%3A%22EUREX%3AFGBM1!%22%2C%22d%22%3A%22Euro%20BOBL%22%7D%5D%2C%22originalTitle%22%3A%22Bonds%22%7D%2C%7B%22title%22%3A%22Forex%22%2C%22symbols%22%3A%5B%7B%22s%22%3A%22FX%3AEURUSD%22%7D%2C%7B%22s%22%3A%22FX%3AGBPUSD%22%7D%2C%7B%22s%22%3A%22FX%3AUSDJPY%22%7D%2C%7B%22s%22%3A%22FX%3AUSDCHF%22%7D%2C%7B%22s%22%3A%22FX%3AAUDUSD%22%7D%2C%7B%22s%22%3A%22FX%3AUSDCAD%22%7D%5D%2C%22originalTitle%22%3A%22Forex%22%7D%5D%2C%22utm_source%22%3A%22www.foxbit-traders.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22market-overview%22%2C%22page-uri%22%3A%22www.foxbit-traders.com%2F%22%7D"
      style="box-sizing: border-box; display: block; height: calc(468px); width: 100%;"></iframe>
    <div class="tradingview-widget-copyright"><a
        href="https://www.tradingview.com/?utm_source=www.foxbit-traders.com&amp;utm_medium=widget_new&amp;utm_campaign=forex-cross-rates"
        rel="noopener" target="_blank"><span class="blue-text">Market Data</span></a> by TradingView</div>

    <style>
      .tradingview-widget-copyright {
        font-size: 13px !important;
        line-height: 32px !important;
        text-align: center !important;
        vertical-align: middle !important;
        /* @mixin sf-pro-display-font; */
        font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto, Ubuntu, sans-serif !important;
        color: #9db2bd !important;
      }

      .tradingview-widget-copyright .blue-text {
        color: #2962FF !important;
      }

      .tradingview-widget-copyright a {
        text-decoration: none !important;
        color: #9db2bd !important;
      }

      .tradingview-widget-copyright a:visited {
        color: #9db2bd !important;
      }

      .tradingview-widget-copyright a:hover .blue-text {
        color: #1E53E5 !important;
      }

      .tradingview-widget-copyright a:active .blue-text {
        color: #1848CC !important;
      }

      .tradingview-widget-copyright a:visited .blue-text {
        color: #2962FF !important;
      }
    </style>
  </div>
  <!-- TradingView Widget END -->
  <br>


  <!-- ============================================================================================================================ -->
  <div class="tradingview-widget-container__widget swiper-slide" data-aos="fade-down"></div>
  <div style="width: 100%; height: 400px;">
    <style>
      .tradingview-widget-copyright {
        font-size: 13px !important;
        line-height: 32px !important;
        text-align: center !important;
        vertical-align: middle !important;
        /* @mixin sf-pro-display-font; */
        font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto, Ubuntu, sans-serif !important;
        color: #9db2bd !important;
      }

      .tradingview-widget-copyright .blue-text {
        color: #2962FF !important;
      }

      .tradingview-widget-copyright a {
        text-decoration: none !important;
        color: #9db2bd !important;
      }

      .tradingview-widget-copyright a:visited {
        color: #9db2bd !important;
      }

      .tradingview-widget-copyright a:hover .blue-text {
        color: #1E53E5 !important;
      }

      .tradingview-widget-copyright a:active .blue-text {
        color: #1848CC !important;
      }

      .tradingview-widget-copyright a:visited .blue-text {
        color: #2962FF !important;
      }
    </style><iframe scrolling="no" allowtransparency="true" frameborder="0"
      src="https://s.tradingview.com/embed-widget/forex-cross-rates/?locale=en#%7B%22width%22%3A%22100%25%22%2C%22height%22%3A400%2C%22colorTheme%22%3A%22dark%22%2C%22currencies%22%3A%5B%22EUR%22%2C%22USD%22%2C%22JPY%22%2C%22GBP%22%2C%22CHF%22%2C%22AUD%22%2C%22CAD%22%2C%22NZD%22%2C%22CNY%22%5D%2C%22utm_source%22%3A%22www.foxbit-traders.com%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22forex-cross-rates%22%2C%22page-uri%22%3A%22www.foxbit-traders.com%2F%22%7D"
      style="box-sizing: border-box; display: block; height: calc(368px); width: 100%;"></iframe>
  </div>
</article>
</div>

<br>
<section class="funds">
  <div class="container">
    <div class="section-intro">
      <h3 class="title">fxbitozglobal.com TRADERS</h3>
      <div class="section-intro__description">
        <p>The best cryptocurrency developers works in our company. They have a wealth of experience and understanding
          of the crypto market behind them. They brought fxbitozglobal.com to the world level of development</p>
      </div>
    </div>
    <div class="funds__slider swiper-container swiper-no-swiping js-swiper-funds">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="funds-item">
            <div class="funds-item__icon"> <img src="temp/custom/assets/images/funds/1.png" alt="">
            </div>
            <h4 class="funds-item__title">UNIQUE TRADING BOT </h4>
            <div class="funds-item__description">
              <p>fxbitozglobal.com team of professionals has created a unique trading robot that makes profit at any
                stage
                of the market: rise or fall</p>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="funds-item is-active">
            <div class="funds-item__icon"> <img src="temp/custom/assets/images/funds/2.png" alt="">
            </div>
            <h4 class="funds-item__title">STABLE AND AUTOMATED INVESTMENT </h4>
            <div class="funds-item__description">
              <p>The robot is not human-related. And that is why all investments are reliable and completely safe</p>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="funds-item">
            <div class="funds-item__icon"> <img src="temp/custom/assets/images/funds/3.png" alt="">
            </div>
            <h4 class="funds-item__title">THE EXPERTS WILL DO EVERYTHING FOR YOU </h4>
            <div class="funds-item__description">
              <p>The highly professional fxbitozglobal.com team controls all the processes of the trading robot around
                the
                clock. After investing, you will observe the growth of your capital in real time</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="funds__bottom">

      <a class="btn btn--line-primary" href="/register"><span>INVEST WITH US AND GET STABLE INCOME</span></a>
    </div>
  </div>
</section>
<!---->
<section class="company">
  <div class="container container-large">
    <div class="company__block">
      <div class="company__row">
        <div class="company__col">
          <div class="certificate">
            <div class="total-invested">
              <p class="total-invested__title">Days in Work </p>
              <p class="total-invested__value">2077 </p>
            </div>
            <div class="participants">
              <p class="participants__title">Total Members:
              </p>
              <p class="participants__count">89661 </p>
            </div>
            <ul class="totals">
              <li>
                <p class="totals__title">Total Invested </p>
                <p class="totals__value">338407989 <sub>USD</sub>
                </p>
              </li>
              <li>
                <p class="totals__title">Total Paid </p>
                <p class="totals__value">101689885<sub>USD</sub>
                </p>
              </li>
            </ul>
            <img src="temp/custom/assets/images/company/cert.jpg" alt="">
          </div>
          <div class="company-info">
            <table>
              <tbody>
                <tr>
                  <td>
                    <p class="company-info__label">Reg name:
                    </p>
                  </td>
                  <td>fxbitozglobal.com</td>
                </tr n <tr>
                <td>
                  <p class="company-info__label">Number:
                  </p>
                </td>
                <td><a href="#">#13699699</a></td>
                </tr>
                <tr>
                  <td>
                    <p class="company-info__label">Official address:
                    </p>
                  </td>
                  <td>55 3051 N D St San Bernardino, California(CA), 92405</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="company__col">
          <h3 class="company__title">Officially registered <strong>company</strong>
          </h3>
          <p class="company__count"><a href="#">#13699699</a>
          </p>
          <div class="typography">
            <blockquote>OFFICIAL LICENSE</blockquote>
            <p>fxbitozglobal.com is registered and has official permission for investment and trading activities. The
              services of our company are available to every investor from anywhere in the world.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!---->

<!---->
<style>
  .steps .steps-item {
    text-align: center;
  }
</style>
<section class="steps">
  <div class="container">
    <div class="section-intro">
      <h3 class="title">3 STEPS TO START </h3>
    </div>
    <div class="steps__slider swiper-container swiper-no-swiping js-swiper-steps">
      <div class="steps__hearts"> <img src="temp/custom/assets/images/steps/1.png" alt=""><img
          src="temp/custom/assets/images/steps/2.png" alt="">
      </div>
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="steps-item">
            <p class="steps-item__count"><span>#</span>1
            </p>
            <h4 class="steps-item__title">REGISTRATION </h4>
            <div class="steps-item__description">
              <p>Click the Register button. Fill in your details to create a FREE fxbitozglobal.com account in seconds
              </p>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="steps-item">
            <p class="steps-item__count"><span>#</span>2
            </p>
            <h4 class="steps-item__title">CHOOSE INVESTMENT PLAN </h4>
            <div class="steps-item__description">
              <p>We offer a variety of investment plans to suit your financial goals. After reading, make a deposit</p>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="steps-item">
            <p class="steps-item__count"><span>#</span>3
            </p>
            <h4 class="steps-item__title">START EARNING </h4>
            <div class="steps-item__description">
              <p>After making a deposit, watch your capital grow by accumulating daily profit in real time</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!---->

<section class="investment">
  <div class="container">
    <div class="investment__row">
      <div class="investment__col">
        <div class="section-intro">
          <h3 class="title">REFERRAL PROGRAM </h3>
          <div class="section-intro__description">
            <p>Anyone can take part in the affiliate program. It allows you to receive generous rewards by inviting new
              members</p>
          </div>
        </div>
        <ul class="investment-stats">
          <li>
            <p class="title">4 LEVELS OF REFERRAL PROGRAM </p>
            <div class="section-intro__description">
              <p>Get extra profit when people in your structure invite new investors to the company</p>
            </div>
          </li>
          <li>
            <p class="investment-stats__count gradient-text" style="font-size: 75px;">7<sup>%</sup> -
              3<sup>%</sup><br>2<sup>%</sup> - 1<sup>%</sup></p>
          </li>
        </ul>
      </div>
      <div class="investment__col"> <a class="notebook-video" href="#" data-fancybox="data-fancybox"> <span
            class="notebook-video__content"><span class="notebook-video__title">VIDEO PRESENTATION</span><span
              class="notebook-video__icon">
              <svg class="svg-icon">
                <use href="temp/custom/assets/icons/sprite.svg#icon-play"></use>
              </svg></span></span><img src="temp/custom/assets/images/investment/notebook.png" alt=""></a>
      </div>
    </div>
    <div class="investment__slider swiper-container swiper-no-swiping js-swiper-advantages">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="advantages-item">
            <div class="advantages-item__icon" style="width: 100%;">
              <svg class="svg-icon">
                <use href="temp/custom/assets/icons/sprite.svg#icon-002-24-hours"></use>
              </svg>
            </div>
            <div class="advantages-item__description" style="text-align: center;">
              <p>ROBOT TRADING WITHOUT WEEKENDS AND HOLIDAYS</p>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="advantages-item">
            <div class="advantages-item__icon" style="width: 100%;">
              <svg class="svg-icon">
                <use href="temp/custom/assets/icons/sprite.svg#icon-003-transfer"></use>
              </svg>
            </div>
            <div class="advantages-item__description" style="text-align: center;">
              <p>WITHDRAWAL 24/7</p>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="advantages-item">
            <div class="advantages-item__icon" style="width: 100%;">
              <svg class="svg-icon">
                <use href="temp/custom/assets/icons/sprite.svg#icon-001-wallet"></use>
              </svg>
            </div>
            <div class="advantages-item__description" style="text-align: center;">
              <p>BIG NUMBER OF PAYMENT SYSTEMS</p>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="advantages-item">
            <div class="advantages-item__icon" style="width: 100%;">
              <svg class="svg-icon">
                <use href="temp/custom/assets/icons/sprite.svg#icon-004-user"></use>
              </svg>
            </div>
            <div class="advantages-item__description" style="text-align: center;">
              <p>100% ANONYMOUS AND TRANSPARENCY OF THE WORK OF THE ROBOT</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="payments-and-footer-wrapper">
  <div class="payments-and-footer-wrapper__inner" style="padding-top: 70px;">
    <section class="payments" style="margin-bottom: 20px;">
      <div class="container">
        <div class="payments__row">
          <div class="payments__col"> <img src="temp/custom/assets/images/payments/payment.png" alt="">
          </div>
          <div class="payments__col">
            <div class="payments__content">
              <div class="section-intro">
                <h3 class="title">PAYMENT SYSTEMS </h3>
                <div class="section-intro__description">
                  <p>fxbitozglobal.com supports a big number of payment systems</p>
                </div>
              </div>
              <div class="typography">
                <p>Our company does not charge commissions for opening a deposit, as well as withdrawing funds from the
                  platform</p>
              </div>
              <div class="payments__buttons">

                <a class="btn btn--line-primary" href="/register"><span>INVEST</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>


<div id="button-up">
  <i class="fa fa-chevron-up"></i>
</div>
<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min-2.html">
<style>
  #button-up {
    display: none;
    position: fixed;
    right: 20px;
    bottom: 60px;
    color: #000;
    background-color: white;
    text-align: center;
    font-size: 30px;
    padding: 3px 10px 10px 10px;
    transition: .3s;
    border-radius: 50px;
    width: 50px;
    height: 50px;
    z-index: 9999;
  }

  #button-up:hover {
    cursor: pointer;
    background-color: #E8E8E8;
    transition: .3s;
  }
</style>
<style>
  /* Investment Plans Section Styling */
  .deposits {
    padding: 60px 0;
    background-color: #0a1a2a;
  }

  .section-intro {
    text-align: center;
    margin-bottom: 40px;
  }

  .section-intro .title {
    color: #fff;
    font-size: 32px;
    margin-bottom: 15px;
  }

  .section-intro__description p {
    color: #a0a8b0;
    font-size: 16px;
    max-width: 700px;
    margin: 0 auto;
  }

  /* Investment Plans Container */
  .investment-plans-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }

  /* Individual Plan Styling */
  .investment-plan {
    background-color: #11293e;
    border-radius: 10px;
    padding: 25px 20px 20px;
    width: 100%;
    max-width: 400px;
    border: 1px solid #222b37;
    position: relative;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    transition: transform 0.3s ease;
  }

  .investment-plan:hover {
    transform: translateY(-5px);
  }

  /* Plan Label */
  .plan-label {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #c946f8;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    z-index: 2;
  }

  .plan-label.premium {
    background: #814ffb;
  }

  /* Plan Title & Subtitle */
  .plan-title {
    color: #fff;
    font-size: 22px;
    margin-bottom: 5px;
    text-align: left;
    font-weight: bold;
    padding-right: 60px;
  }

  .plan-subtitle {
    color: #a0a8b0;
    font-size: 16px;
    margin-top: 0;
    margin-bottom: 20px;
    text-align: left;
  }

  /* Plan Details Table - No Borders */
  .plan-details table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
  }

  .plan-details table tr td {
    padding: 8px 0;
    color: #fff;
    border: none;
  }

  .plan-details table tr td:first-child {
    color: #a0a8b0;
    font-weight: normal;
  }

  /* Additional Plan Elements */
  .plan-note {
    color: #ff6b6b;
    font-size: 12px;
    margin: 10px 0 15px 0;
    font-style: italic;
  }

  .divider {
    height: 1px;
    background-color: #2a3a4d;
    margin: 15px 0;
  }

  /* Invest Now Button */
  .invest-now-btn {
    display: block;
    text-align: center;
    background: linear-gradient(to right, #ff416c, #ff4b2b);
    color: white;
    padding: 12px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }

  .invest-now-btn:hover {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(255, 75, 43, 0.3);
  }

  /* Responsive Layout */
  @media (min-width: 769px) {

    /* Desktop - Horizontal Layout */
    .investment-plans-container {
      flex-direction: row;
    }

    .investment-plan {
      width: calc(50% - 20px);
    }
  }

  @media (max-width: 768px) {

    /* Mobile - Vertical Layout */
    .deposits {
      padding: 40px 0;
    }

    .section-intro .title {
      font-size: 28px;
    }

    .investment-plans-container {
      flex-direction: column;
      align-items: center;
    }

    .investment-plan {
      width: 100%;
      max-width: 100%;
    }
  }

  /* Very Small Screens */
  @media (max-width: 480px) {
    .plan-title {
      font-size: 20px;
    }

    .plan-subtitle {
      font-size: 14px;
    }

    .plan-details table tr td {
      font-size: 14px;
      padding: 6px 0;
    }
  }
</style>
<script>
  $(document).ready(function() { 
      var button = $('#button-up');	
      $(window).scroll (function () {
        if ($(this).scrollTop () > 300) {
          button.fadeIn();
        } else {
          button.fadeOut();
        }
    });	 
    button.on('click', function(){
    $('body, html').animate({
    scrollTop: 0
    }, 800);
    return false;
    });		 
    });
</script>
<script src="#" async></script>

<div class="payments-and-footer-wrapper">
  <div class="payments-and-footer-wrapper__inner" style="padding: 0;">
    <!---->
    <!-- footer -->
    <!-- this is the begining of the footer section  -->


    <div class="gtranslate_wrapper"></div>
    <script>
      window.gtranslateSettings = {"default_language":"en","wrapper_selector":".gtranslate_wrapper"}
    </script>
    <script src="../../../cdn.gtranslate.net/widgets/latest/float.js" defer></script>

    @include('home.footer');