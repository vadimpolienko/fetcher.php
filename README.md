# fetcher.php
Buddy Fetcher: Simple RSS fetcher/aggregator (PHP/MySQL).

Project features:
- collecting remote items (news, jobs etc) from a number of external sites
- using standard input RSS-feeds or custom parsing
- items collector can be run as frequently as needed (through scheduled task)
- separate functionality for operations with DB (data access layer)
- filtering items by categories (any number of categories)
- output RSS-feeds (filtered by categories also)
- caching logic for input RSS-feeds, web pages and output RSS-feeds
- mobile version is configured through separate CSS
- classic MVC (Model/View/Controller) implementation

Test scripts are located in local/tests folder.

This product was initially ported from original PHP version using own convertor (written in C# and using ~80 regular expressions).

Working NET version, ported from the same original PHP version with the same convertor (using ~150 regular expressions), can be found at http://github.com/buddylancer/fetcher.net.

Websites powered by Buddy Fetcher:
- 1001 Freelance Projects (http://www.1001freelanceprojects.com)
- 1001 Freelance Projects / Rus (http://www.1001freelanceprojects.ru)
- 1001 Remote Jobs (http://www.1001remotejobs.com)
- 1001 Remote Jobs / Rus (http://www.1001remotejobs.ru)

# Acknowledgments

MagpieRSS: a simple RSS integration tool (http://magpierss.sourceforge.net) /
Author: Kellan Elliott-McCrea <kellan@protest.net> /
Version: 0.72 /
License: GPL

Snoopy: the PHP net client (https://sourceforge.net/projects/snoopy) /
Author: Monte Ohrt <monte@ohrt.com> /
Copyright (c): 1999-2014, all rights reserved /
Version: 2.0.0 /
License: GPLv2
