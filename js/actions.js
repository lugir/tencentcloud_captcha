/**
 * @file
 */

(function (Drupal) {
  document.addEventListener('DOMContentLoaded', function () {
    // Initial checkpoint.
    let captchaVerified = false;

    let captchaBtn = document.getElementById('tencentcloud-captcha');
    // Hide captcha container or button when there is a submit button (which will be used to trigger the captcha button).
    if (document.getElementById('edit-submit')) {
      let captchaContainer = document.querySelector('details#captcha');
      // Hide captcha container if there is one.
      if (captchaContainer) {
        captchaContainer.style.display = 'none';
      }
      // Hide captcha button if on container.
      else {
        captchaBtn.style.display = 'none';
      }
    }

    let appId = captchaBtn.getAttribute('data-app-id');
    captchaBtn.setAttribute('type', 'button');

    let tencentCloudCaptcha = new TencentCaptcha(appId, function (res) {
      if (res.ret !== 0) {
        return;
      }
      document.getElementById('captcha-ticket').value = res.ticket;
      document.getElementById('captcha-randstr').value = res.randstr;
      captchaBtn.value = Drupal.t('Passed');
      captchaBtn.setAttribute('disabled','disabled');

      // Trigger submit.
      captchaVerified = true;
      captchaBtn.closest('form').querySelector('#edit-submit').click();
    });

    captchaBtn.addEventListener('click', function (event) {
      tencentCloudCaptcha.show();
    });

    // Intercept submit action if the form has a unverified tencentcloud captcha.
    let submitBtn = document.getElementById('edit-submit');
    submitBtn.addEventListener('click', function (event) {
      let formIsValid = event.target.closest('form').checkValidity();
      // Prevent submit and call captcha when form is valid BUT the captcha is not verified.
      if (formIsValid && !captchaVerified) {
        event.preventDefault();
        captchaBtn.click();
      }
      // Else submit form as normal.
    }, false);

  }, false);

})(Drupal);
