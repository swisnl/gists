<?php

class SwisDrupalValetDriver extends ValetDriver
{
  /**
   * Determine if the driver serves the request.
   *
   * @param  string  $sitePath
   * @param  string  $siteName
   * @param  string  $uri
   * @return bool
   */
  public function serves($sitePath, $siteName, $uri)
  {
    if (file_exists($sitePath.'/app/core/lib/Drupal.php')) {
      return true;
    }

    return false;
  }

  /**
   * Determine if the incoming request is for a static file.
   *
   * @param  string  $sitePath
   * @param  string  $siteName
   * @param  string  $uri
   * @return string|false
   */
  public function isStaticFile($sitePath, $siteName, $uri)
  {
    if (file_exists($sitePath.'/public_html/'.$uri)) {
      return $sitePath.'/public_html/'.$uri;
    }

    if (file_exists($sitePath.'/public_html/assets/'.$uri)) {
      return $sitePath.'/public_html/assets/'.$uri;
    }

    if (file_exists($sitePath.'/public_html/favicons/'.$uri)) {
      return $sitePath.'/public_html/favicons/'.$uri;
    }

    return false;
  }

  /**
   * Get the fully resolved path to the application's front controller.
   *
   * @param  string  $sitePath
   * @param  string  $siteName
   * @param  string  $uri
   * @return string
   */
  public function frontControllerPath($sitePath, $siteName, $uri)
  {
    $_SERVER['SCRIPT_FILENAME'] = $sitePath.'/index.php';
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    return $sitePath.'/public_html/index.php';
  }
}
