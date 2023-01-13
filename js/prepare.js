(function () {
  document.addEventListener('DOMContentLoaded', function () {
    // Disable or hide submit button until captcha is ready, actions.js will re-enable it.
    // console.log('tencentcloud_captcha: Disable submit button');
    var btnSubmit = document.getElementById('tencentcloud-captcha').closest('form').querySelector('#edit-submit');
    if (btnSubmit) {
      btnSubmit.setAttribute('disabled', 'disabled')
    }
  }, false);

  var checkReadyState = setInterval(function() {
    if (document.readyState === "complete") {
        clearInterval(checkReadyState);
        // Enable/show submit button after page is ready.
        // console.log('tencentcloud_captcha: Enable submit button');
        var btnSubmit = document.getElementById('tencentcloud-captcha').closest('form').querySelector('#edit-submit');
        if (btnSubmit) {
          btnSubmit.removeAttribute('disabled')
        }
    }
  }, 100);

})();
