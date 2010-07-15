<?php
/**
 *
 */

/**
 *
 */
interface Twitter_Regex {

  /**
   *
   */
  const URL_VALID_PRECEEDING_CHARS = '(?:[^/\"\':!=]|^|\\:)';

  /**
   *
   */
  const URL_VALID_DOMAIN = '(?:[\\.-]|[^\\p{P}\\s])+\\.[a-z]{2,}(?::[0-9]+)?';

  /**
   *
   */
  const URL_VALID_URL_PATH_CHARS = '[a-z0-9!\\*\'\\(\\);:&=\\+\\$/%#\\[\\]\\-_\\.,~@]';

  # Valid end-of-path chracters (so /foo. does not gobble the period).
  # 1. Allow ) for Wikipedia URLs.
  # 2. Allow =&# for empty URL parameters and other URL-join artifacts

  /**
   *
   */
  const URL_VALID_URL_PATH_ENDING_CHARS = '[a-z0-9\\)=#/]';

  /**
   *
   */
  const URL_VALID_URL_QUERY_CHARS = '[a-z0-9!\\*\'\\(\\);:&=\\+\\$/%#\\[\\]\\-_\\.,~]';

  /**
   *
   */
  const URL_VALID_URL_QUERY_ENDING_CHARS = '[a-z0-9_&=#]';

  /**
   *
   */
  const USERNAMES_AND_LISTS = '$([^a-z0-9_]|^)([@|＠])([a-z0-9_]{1,20})(/[a-z][a-z0-9\x80-\xFF-]{0,79})?$i';

  /**
   *
   */
  const HASHTAG = '$(^|[^0-9A-Z&/]+)([#＃]+)([0-9A-Z_]*[A-Z_]+[a-z0-9_üÀ-ÖØ-öø-ÿ]*)$i';

}
