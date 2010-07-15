<?php
/**
 * @author     Mike Cochrane <mikec@mikenz.geek.nz>
 * @author     Nick Pope <nick@nickpope.me.uk>
 * @copyright  Copyright © 2010, Mike Cochrane, Nick Pope
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License v2.0
 * @package    Twitter
 */

require_once 'Regex.php';

/**
 * Twitter Extractor Class
 *
 * Parses tweets and extracts URLs, usernames, username/list pairs and
 * hashtags.
 *
 * Originally written by {@link http://github.com/mikenz Mike Cochrane}, this
 * is based on code by {@link http://github.com/mzsanford Matt Sanford} and
 * heavily modified by {@link http://github.com/ngnpope Nick Pope}.
 *
 * @author     Mike Cochrane <mikec@mikenz.geek.nz>
 * @author     Nick Pope <nick@nickpope.me.uk>
 * @copyright  Copyright © 2010, Mike Cochrane, Nick Pope
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License v2.0
 * @package    Twitter
 */
class Twitter_Extractor extends Twitter_Regex {

  /**
   * Provides fluent method chaining.
   *
   * @param  string  $tweet        The tweet to be converted.
   * @param  bool    $full_encode  Whether to encode all special characters.
   *
   * @see  __construct()
   *
   * @return  Twitter_Extractor
   */
  public static function create($tweet) {
    return new self($tweet);
  }

  /**
   * Reads in a tweet to be parsed and extracts elements from it.
   *
   * Extracts various parts of a tweet including URLs, usernames, hashtags...
   *
   * @param  string  $tweet  The tweet to extract.
   */
  public function __construct($tweet) {
    parent::__construct($tweet);
  }

  /**
   * Extracts all parts of a tweet and returns an associative array containing 
   * the extracted elements.
   *
   * @return  array  The elements in the tweet.
   */
  public function extract() {
    return array(
      'hashtags' => $this->extractHashtags(),
      'urls'     => $this->extractURLs(),
      'mentions' => $this->extractMentionedUsernames(),
      'replyto'  => $this->extractRepliedUsernames()
    );
  }

  /**
   * Extracts all the hashtags from the tweet.
   *
   * @return  array  The hashtag elements in the tweet.
   */
  public function extractHashtags() {
    preg_match_all(self::REGEX_HASHTAG, $this->tweet, $matches);
    return $matches[3];
  }

  /**
   * Extracts all the URLs from the tweet.
   *
   * @return  array  The URL elements in the tweet.
   */
  public function extractURLs() {
    preg_match_all(self::$REGEX_VALID_URL, $this->tweet, $matches);
    return $matches[3];
  }

  /**
   * Extract all the usernames from the tweet.
   *
   * A mention is an occurrence of a username anywhere in a tweet.
   *
   * @return  array  The usernames elements in the tweet.
   */
  public function extractMentionedUsernames() {
    preg_match_all(self::REGEX_USERNAME_MENTION, $this->tweet, $matches);
    $usernames = array();
    for ($i = 0; $i < count($matches[2]); $i ++) {
      if (!preg_match('/^[@＠]/', $matches[3][$i])) {
        array_push($usernames, $matches[2][$i]);
      }
    }
    return $usernames;
  }

  /**
   * Extract all the usernames replied to from the tweet.
   *
   * A reply is an occurrence of a username at the beginning of a tweet.
   *
   * @return  array  The usernames replied to in a tweet.
   */
  public function extractRepliedUsernames() {
    preg_match(self::$REGEX_REPLY_USERNAME, $this->tweet, $matches);
    return isset($matches[2]) ? $matches[2] : array();
  }

}
