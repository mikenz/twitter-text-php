# Twitter Text (PHP Edition) #

A couple of PHP classes that provide auto=links and extraction of usernames,
lists, hashtags and URLs in a way consistant with the twitter-text-rb and
twitter-text-java projects by Matt Sanford

## Examples ##

### Auto-Linking ###

    $tweet = 'Tweet mentioning @mikenz and referring to his list @mikeNZ/sports and website http://mikenz.geek.nz';

    require_once 'Twitter/Autolink.php';
    $html = Twitter_Autolink::create($tweet)
      ->setNoFollow(false)
      ->setUserClass('person')
      ->addLinks();
    echo $html;

### Extraction ###

    $tweet = 'Tweet mentioning @mikenz and referring to his list @mikeNZ/sports and website http://mikenz.geek.nz';

    require_once 'Twitter/Extractor.php';
    $data = Twitter_Extractor::create($tweet)->extract();
    var_dump($data);

## Tests ##

You'll need the test data from http://github.com/mzsanford/twitter-text-conformance in tests/data/twitter-text-conformance.
It has been added as a git submodule so you should just need to run:

    git submodule init
    git submodule update

As PHP has no native support for YAML you'll need to checkout spyc from svn into tests/spyc:
    svn checkout http://spyc.googlecode.com/svn/trunk/ tests/spyc

In your browser load the runtests.php file.
