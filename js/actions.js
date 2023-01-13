(function (Drupal) {
  document.addEventListener('DOMContentLoaded', function () {
    // Initial checkpoint.
    var captchaVerified = false;

    var button = document.getElementById('tencentcloud-captcha');
    // Hide captcha container or button when there is a submit button (which will be used to trigger the captcha button).
    if (document.getElementById('edit-submit')) {
      var captchaContainer = document.querySelector('details#captcha');
      // Hide captcha container if there is one.
      if (captchaContainer) {
        captchaContainer.style.display = 'none';
      }
      // Hide captcha button if on container.
      else {
        button.style.display = 'none';
      }
    }

    var appId = button.getAttribute('data-app-id');
    button.setAttribute('type', 'button');

    var tencentCloudCaptcha = new TencentCaptcha(appId, function(res) {
      if (res.ret !== 0){
        return ;
      }
      document.getElementById('captcha-ticket').value = res.ticket;
      document.getElementById('captcha-randstr').value = res.randstr;
      button.value = Drupal.t('Passed');
      button.setAttribute('disabled','disabled');

      // Trigger submit.
      captchaVerified = true;
      button.closest('form').querySelector('#edit-submit').click();
    });


    button.addEventListener('click', function (event) {
      tencentCloudCaptcha.show();
    });

    // Intercept submit action if the form has a unverified tencentcloud captcha.
    document.addEventListener('click', function (event) {

      // If the clicked element doesn't have the right selector, bail
      //if (!event.target.matches('#edit-submit')) return;
      formIsValid = event.target.closest('form').checkValidity();
      var button = this.getElementById('edit-submit');
      if (button && formIsValid && !captchaVerified) {
        event.preventDefault();
        button.click();
      }
    }, false);

  }, false);

})(Drupal);
