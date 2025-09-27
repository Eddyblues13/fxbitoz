@include('home.header');

<section class="page-intro page-intro-contacts">
  <div class="container container-large">
    <h1 class="page-intro__title">Our<br> contacts </h1>
  </div>
</section>
<section class="contacts page-section">
  <div class="container">
    <div class="contacts__top">
      <h3 class="contacts__title">Send Message </h3>
      <div class="contacts__description">
        <p>Send us a message and we will reply to you within 24 hours!</p>
      </div>
    </div>
    <div class="contacts__row">
      <div class="contacts__col">
        <div class="contacts-form block-form">

          <form id="" action="https://fxbitozglobal.com/public/i/send.php" method="post">
            <div class="field field--error">
              <label>Your Login</label>
              <input type="text" name="name">
            </div>
            <div class="field">
              <label>E-mail</label>
              <input type="text" name="email">
            </div>
            <div class="field">
              <label>Messages</label>
              <textarea class="js-textarea" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn--primary btn--large">Send </button>
          </form>
        </div>
      </div>
      <div class="contacts__col">
        <ul class="social-links">

          </li>
        </ul>
      </div>
    </div>
  </div>
</section>


<script src="temp/custom/js/jquery.min.js"></script>



@include('home.footer')