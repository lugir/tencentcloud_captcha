<?php

namespace Drupal\tencentcloud_captcha\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Tencentcloud Captcha settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'tencentcloud_captcha_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['tencentcloud_captcha.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('tencentcloud_captcha.settings');

    \Drupal::moduleHandler()->loadInclude('captcha', 'inc');

    $form['general'] = [
      '#type' => 'details',
      '#title' => 'General',
      '#open' => TRUE,
    ];

    $form['general']['secret_id'] = [
      '#title' => 'SecretId',
      '#description' => $this->t('Get or create @item from <a href="@url" target="_blank">@name</a>', [
        '@item' => 'SecretId',
        '@url' => 'https://console.cloud.tencent.com/cam/capi',
        '@name' => 'Tencent Cloud',
      ]),
      '#type' => 'textfield',
      '#maxlength' => 40,
      '#required' => TRUE,
      '#default_value' => $config->get('secret_id'),
    ];

    $form['general']['secret_key'] = [
      '#title' => 'SecretKey',
      '#description' => $this->t('Get or create @item from <a href="@url" target="_blank">@name</a>', [
        '@item' => 'SecretKey',
        '@url' => 'https://console.cloud.tencent.com/cam/capi',
        '@name' => 'Tencent Cloud',
      ]),
      '#type' => 'textfield',
      '#maxlength' => 40,
      '#required' => TRUE,
      '#default_value' => $config->get('secret_key'),
    ];

    $form['general']['app_id'] = [
      '#title' => 'CaptchaAppId',
      '#description' => $this->t('Get or create @item from <a href="@url" target="_blank">@name</a>', [
        '@item' => 'CaptchaAppId',
        '@url' => 'https://console.cloud.tencent.com/captcha/graphical',
        '@name' => 'Tencent Cloud Captcha',
      ]),
      '#type' => 'textfield',
      '#maxlength' => 40,
      '#required' => TRUE,
      '#default_value' => $config->get('app_id'),
    ];

    $form['general']['app_secret_key'] = [
      '#title' => 'AppSecretKey',
      '#description' => $this->t('Get or create @item from <a href="@url" target="_blank">@name</a>', [
        '@item' => 'AppSecretKey',
        '@url' => 'https://console.cloud.tencent.com/captcha/graphical',
        '@name' => 'Tencent Cloud Captcha',
      ]),
      '#type' => 'textfield',
      '#maxlength' => 40,
      '#required' => TRUE,
      '#default_value' => $config->get('app_secret_key'),
    ];

    $form['captcha_point'] = [
      '#type' => 'details',
      '#title' => $this->t('Form protection'),
      '#open' => TRUE,
    ];

    $form['captcha_point']['user_login_form'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Login'),
      '#default_value' => captcha_get_form_id_setting('user_login_form')->status(),
    ];

    $form['captcha_point']['user_register_form'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Register'),
      '#default_value' => captcha_get_form_id_setting('user_register_form')->status(),
    ];

    $form['captcha_point']['user_pass'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Forgot password'),
      '#default_value' => captcha_get_form_id_setting('user_pass')->status(),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::moduleHandler()->loadInclude('captcha', 'inc');
    $secret_id = $form_state->getValue('secret_id');
    $secret_key = $form_state->getValue('secret_key');
    $app_id = $form_state->getValue('app_id');
    $app_secret_key = $form_state->getValue('app_secret_key');
    $config = $this->config('tencentcloud_captcha.settings');
    $config
      ->set('secret_id', $secret_id)
      ->set('secret_key', $secret_key)
      ->set('app_id', $app_id)
      ->set('app_secret_key', $app_secret_key)
      ->save();
    parent::submitForm($form, $form_state);

    $user_login_form = captcha_get_form_id_setting('user_login_form');
    $user_login_form->setCaptchaType('tencentcloud_captcha/tencentcloud_captcha');
    $user_login_form->setStatus($form_state->getValue('user_login_form'))->save();

    $user_register_form = captcha_get_form_id_setting('user_register_form');
    $user_register_form->setCaptchaType('tencentcloud_captcha/tencentcloud_captcha');
    $user_register_form->setStatus($form_state->getValue('user_register_form'))->save();

    $user_pass = captcha_get_form_id_setting('user_pass');
    $user_pass->setCaptchaType('tencentcloud_captcha/tencentcloud_captcha');
    $user_pass->setStatus($form_state->getValue('user_pass'))->save();
  }

}
