## Introduction

Integrate [Tencent Cloud Captcha](https://cloud.tencent.com/product/captcha) services with Captcha module to protect Drupal with great captcha experiences.

For **Drupal 8.x** version: Some original works of this module can be found at [Tencent-Cloud-Plugins/tencentcloud-drupal-plugin-captcha](https://github.com/Tencent-Cloud-Plugins/tencentcloud-drupal-plugin-captcha), which might work with Drupal 8 and early versions of Drupal 9.

## Requirements

Following module and package will be included automaticlly when installed with composer.
- [Captcha](https://www.drupal.org/project/captcha) module.
- [tencentcloud/captcha:^3.0](https://github.com/tencentcloud-sdk-php/captcha) package
- Account of [Tencent Cloud Captcha Console](https://console.cloud.tencent.com/captcha/graphical).

## Installation

Install as you would normally install a contributed Drupal module. For further
information, see
[Installing Drupal Modules](https://www.drupal.org/docs/extending-drupal/installing-drupal-modules).

## Configuration
1. Create and get ***SecretId*** and ***SecretKey*** from [Tencent Cloud API](https://console.cloud.tencent.com/cam/capi)
2. Create graphic captcha (图形验证) and get ***CaptchaAppId*** and ***AppSecretKey*** from [Tencent Cloud Captcha Graphic](https://console.cloud.tencent.com/captcha/graphical)
3. Go to Tencent Cloud Captcha config page at */admin/config/people/captcha/tencentcloud_captcha* to fill above info and choose which forms to protect.
4. (Optional) Goto Captcha config page at */admin/config/people/captcha* to implement to other forms.

## Maintainers

- Zhichao Yuan - https://www.drupal.org/u/lugir